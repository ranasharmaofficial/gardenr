<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MasterFund;
use App\Models\Branch;
use App\Models\BranchWallet;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\UserType;
use App\Models\User;

class MasterFundController extends Controller
{
    public function index(Request $request){
        $fund_list =  MasterFund::latest()->get();
        // Calculate totals first
        // Remaining balance
        // $totalFund = $totalCredit - $totalDebit;

        $companyId = session('LoggedUser')->user_id;

        // dd(session('LoggedUser')->user_id);

        $companyWallet = getWallet('company', $companyId);

        // Get company wallet
        $wallet = Wallet::where('owner_type', 'company')->where('owner_id', $companyId)->first();
        $transactions = WalletTransaction::where('wallet_id', $wallet->id)->orderBy('id', 'ASC')->get();
        $totalCredit = WalletTransaction::where('wallet_id', $wallet->id)->where('type', 'credit')->sum('amount');
        $totalDebit = WalletTransaction::where('wallet_id', $wallet->id)->where('type', 'debit')->sum('amount');
        // dd($companyWallet);

        $datas = [
            'fund_list' => $fund_list,
            'request' => $request,
            'page_title' => 'Master Fund List',
            'totalCredit' => $totalCredit,
            'totalDebit' =>  $totalDebit,
            'totalFund' => $totalCredit - $totalDebit,
            'companyWallet' => $companyWallet,
            'transactions' => $transactions,
        ];
        return view('admin.master.fund.index', $datas);
    }

    public function store(Request $request)
    {


        $request->validate([
            'name'   => 'required|string|max:255',
            'amount' => 'required|numeric|min:0.01',
            'type'   => 'required|in:credit,debit',
            'status' => 'required|in:0,1',
        ]);

        $companyId = session('LoggedUser')->user_id;

        // Get wallet
        $wallet = getWallet('company', $companyId);

        if ($request->type === 'credit') {

            creditWallet($wallet, $request->amount, "Company Fund Added: {$request->name}");

        } else {

            $done = debitWallet($wallet, $request->amount, "Company Fund Deducted: {$request->name}");

            if (!$done) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient company wallet balance!'
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Fund updated successfully!'
        ]);


    }


    public function edit($id)
    {
        return response()->json(MasterFund::find($id));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'amount' => 'nullable|numeric',
            'type'   => 'required|in:credit,debit',
            'status' => 'required|in:0,1',
        ]);

        $fund = MasterFund::findOrFail($id);

        $fund->update([
            'name'       => $request->name,
            'amount'     => $request->amount,
            'type'       => $request->type,
            'status'     => $request->status,
            'updated_by' => session('LoggedUser')->user_id,
        ]);

        return response()->json(['success' => true, 'message' => 'Fund updated successfully!']);
    }

    public function fundTransferToBranch()
    {
        $datas = [
            'page_title' => 'Fund Transfer To Branch',
            'branch_list' => Branch::where('status', 1)->get(),
            'user_type_list' =>  UserType::where('status', 1)->where('id', 2)->get(),
        ];
        return view('admin.fund.add_fund_transfer_to_branch', $datas);
    }



    public function transferFundtoBranch1(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'amount'    => 'required|numeric|min:1',
            'type'    => 'required|in:credit,debit',
            'added_date'    => 'required|date',
        ]);

        // Check if sufficient funds are available
        $totalCredit = MasterFund::where('type', 'credit')->sum('amount');
        $totalDebit  = MasterFund::where('type', 'debit')->sum('amount');
        $availableFund = $totalCredit - $totalDebit;

        if ($request->amount > $availableFund) {
            return response()->json(['status' => false, 'message' => 'Insufficient funds available!']);
        }
        // Deduct from Master Fund

        $branchWallet = new BranchWallet();
        $branchWallet->company_id = session('LoggedUser')->user_id;
        $branchWallet->branch_id = $request->branch_id;
        $branchWallet->type = $request->type;
        $branchWallet->current_balance = $request->amount;
        $branchWallet->added_date = $request->added_date;
        $branchWallet->remarks = 'Fund transfer from Master Fund';
        $branchWallet->save();

        $branchName = Branch::where('id', $request->branch_id)->pluck('name')->first();

        $branchWallet = new MasterFund();
        $branchWallet->name = 'Fund transfer to '.$branchName.' Branch';;
        $branchWallet->type = 'debit';
        $branchWallet->amount = $request->amount;
        $branchWallet->remarks = 'Fund transfer to '.$branchName.' Branch';
        $branchWallet->save();

        // Here you can also add logic to credit the amount to the branch's fund if needed

        return response()->json(['status' => true, 'message' => 'Fund transferred to branch successfully!']);
    }

    public function transferFundToBranch(Request $request)
    {

        // dd($request->all());
         $request->validate([
            'user_type' => 'required|exists:user_types,id',
            'branch' => 'required|exists:branches,id',
            'user_id' => 'required|exists:users,id',
            'amount'    => 'required|numeric|min:1',
            'type'    => 'required|in:credit,debit',
            'added_date'    => 'required|date',
        ]);

        $amount = $request->amount;

        // Company wallet
        $companyId = session('LoggedUser')->user_id;
        $companyWallet = getWallet('company', $companyId);

        // Branch wallet
        $branchManagerWallet = getWallet('branch', $request->user_id);

        // Check balance
        if ($companyWallet->balance < $amount) {
            return response()->json([
                'status'  => false,
                'message' => 'Insufficient funds available!'
            ]);
        }
        $branchName = Branch::where('id', $request->branch)->pluck('name')->first();
        // Debit company
        debitWallet($companyWallet, $amount, "Transfer to Branch Manager : {$branchName}");

        // Credit branch
        creditWallet($branchManagerWallet, $amount, "Received from Company");

        return response()->json([
            'status'  => true,
            'message' => 'Fund transferred successfully!'
        ]);
    }

    public function fundTransferToEmployee(Request $request)
    {
        // dd(session('LoggedUser'));
        $companyId = session('LoggedUser')->user_id;
        $companyWallet = getWallet('branch', $companyId);

        if(session('LoggedUser')->user_type_id==1){
            // Get company wallet
            $companyWallet = getWallet('company', $companyId);
            $wallet = Wallet::where('owner_type', 'company')->where('owner_id', $companyId)->first();
            $transactions = WalletTransaction::where('wallet_id', $wallet->id)->orderBy('id', 'ASC')->get();
            $totalCredit = WalletTransaction::where('wallet_id', $wallet->id)->where('type', 'credit')->sum('amount');
            $totalDebit = WalletTransaction::where('wallet_id', $wallet->id)->where('type', 'debit')->sum('amount');
        }

        if(session('LoggedUser')->user_type_id==2){
            // Get branch manager wallet
            // dd($companyId);
             $companyWallet = getWallet('branch', $companyId);
            $wallet = Wallet::where('owner_type', 'branch')->where('owner_id', $companyId)->first();
            $transactions = WalletTransaction::where('wallet_id', $wallet->id)->orderBy('id', 'ASC')->get();
            $totalCredit = WalletTransaction::where('wallet_id', $wallet->id)->where('type', 'credit')->sum('amount');
            $totalDebit = WalletTransaction::where('wallet_id', $wallet->id)->where('type', 'debit')->sum('amount');
        }




        // dd($companyWallet);
        $datas = [
            // 'fund_list' => $fund_list,
            'request' => $request,
            'page_title' => 'Fund Transfer To Employee',
            'totalCredit' => $totalCredit,
            'totalDebit' =>  $totalDebit,
            'totalFund' => $totalCredit - $totalDebit,
            'companyWallet' => $companyWallet,
            'transactions' => $transactions,
            'user_type_list' =>  UserType::where('status', 1)->whereNotIn('id', [1, 2])->get(),
        ];
        return view('admin.fund.add_fund_transfer_to_employee', $datas);
    }

    public function transferFundtoEmployee(Request $request)
    {
        // dd($request->all());
        $companyId = loggedCompany();

        if ($companyId==1) {
            return response()->json([
                'status'  => false,
                'message' => 'Only Branch Manager can transfer fund to Employee, Logged in as Admin'
            ]);
        }

        $request->validate([
            'user_type' => 'required|exists:user_types,id',
            'user_designation' => 'required|exists:master_designations,id',
            'user_id' => 'required|exists:users,id',
            'amount'    => 'required|numeric|min:1',
            'type'    => 'required|in:credit,debit',
            'added_date'    => 'required|date',
        ]);

        $amount = $request->amount;

        // Company wallet
        $companyId = session('LoggedUser')->user_id;
        $branchManagerWallet = getWallet('branch', $companyId);

        // employee wallet
        $employeeWallet = getWallet('employee', $request->user_id);

        // Check balance
        if ($branchManagerWallet->balance < $amount) {
            return response()->json([
                'status'  => false,
                'message' => 'Insufficient funds available!'
            ]);
        }
        $employeeName = User::where('id', $request->user_id)->pluck('first_name')->first();
        // Debit company
        debitWallet($branchManagerWallet, $amount, "Transfer to Employee : {$employeeName}");

        // Credit branch
        creditWallet($employeeWallet, $amount, "Received from Branch");

        return response()->json([
            'status'  => true,
            'message' => 'Fund transferred successfully!'
        ]);
    }

    public function transferAdminFundtoEmployee(Request $request)
    {
        // dd($request->all());
        $companyId = loggedCompany();

        // if ($companyId==1) {
        //     return response()->json([
        //         'status'  => false,
        //         'message' => 'Only Branch Manager can transfer fund to Employee, Logged in as Admin'
        //     ]);
        // }

        $request->validate([
            'user_type' => 'required|exists:user_types,id',
            'user_designation' => 'required|exists:master_designations,id',
            'user_id' => 'required|exists:users,id',
            'amount'    => 'required|numeric|min:1',
            'type'    => 'required|in:credit,debit',
            'added_date'    => 'required|date',
        ]);

        $amount = $request->amount;

        // Company wallet
        $companyId = session('LoggedUser')->user_id;
        $branchManagerWallet = getWallet('company', $companyId);

        // employee wallet
        $employeeWallet = getWallet('employee', $request->user_id);

        // Check balance
        if ($branchManagerWallet->balance < $amount) {
            return response()->json([
                'status'  => false,
                'message' => 'Insufficient funds available!'
            ]);
        }
        $employeeName = User::where('id', $request->user_id)->pluck('first_name')->first();
        // Debit company
        debitWallet($branchManagerWallet, $amount, "Transfer to Employee : {$employeeName}");

        // Credit branch
        creditWallet($employeeWallet, $amount, "Received from Branch");

        return response()->json([
            'status'  => true,
            'message' => 'Fund transferred successfully!'
        ]);
    }

    public function fundTransferredList(Request $request)
    {
        $companyId = session('LoggedUser')->user_id;

        $user_type_list =  UserType::where('status', 1)->where('id', '!=', 1)->get();;

        if (session('LoggedUser')->user_type_id == 1) {

            $query = WalletTransaction::select('wallet_transactions.*', 'wallets.balance', 'users.first_name as owner_name', 'users.employee_code as owner_employee_code')
                                            ->join('wallets', 'wallet_transactions.wallet_id', '=', 'wallets.id')
                                            ->leftJoin('users', 'wallets.owner_id', '=', 'users.id');

            if ($request->user_id) {
                $query->where('users.id', $request->user_id);
            }



            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('users.first_name', 'like', "%$search%")
                        ->orWhere('users.last_name', 'like', "%$search%")
                        ->orWhere('users.email', 'like', "%$search%")
                        ->orWhere('users.mobile', 'like', "%$search%");
                });
            }

            $transactions = $query->paginate(20);



        } else {

            $transactions = WalletTransaction::join('e_wallets', 'wallet_transactions.wallet_id', '=', 'e_wallets.id')
                ->where('e_wallets.owner_type', 'branch')
                ->where('e_wallets.owner_id', $companyId)
                ->orderByDesc('wallet_transactions.id')
                ->select('wallet_transactions.*', 'e_wallets.balance')
                ->get();
        }

        // dd($transactions);

        $datas = [
            'transactions' => $transactions,
            'user_type_list' => $user_type_list,
            'page_title' => 'Fund Transferred List',
        ];
        return view('admin.fund.fund_transferred_list', $datas);
    }

    public function fetchFundTransferred(Request $request)
    {
         $query = WalletTransaction::select('wallet_transactions.*', 'wallets.balance', 'users.first_name as owner_name', 'users.employee_code as owner_employee_code')
                                            ->join('wallets', 'wallet_transactions.wallet_id', '=', 'wallets.id')
                                            ->leftJoin('users', 'wallets.owner_id', '=', 'users.id');

            if ($request->user_id) {
                $query->where('users.id', $request->user_id);
            }

            if ($request->type) {
                $query->where('wallet_transactions.type', $request->type);
            }



            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('users.first_name', 'like', "%$search%")
                        ->orWhere('users.last_name', 'like', "%$search%")
                        ->orWhere('users.email', 'like', "%$search%")
                        ->orWhere('users.mobile', 'like', "%$search%");
                });
            }

            $transactions = $query->paginate(20);

        if ($request->ajax()) {
            return view('admin.fund.fund_transferred_list_ajax', compact('transactions'))->render();
        }
    }



}
