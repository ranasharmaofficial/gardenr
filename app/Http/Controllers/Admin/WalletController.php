<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MasterFund;
use App\Models\Branch;
use App\Models\BranchWallet;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\EWallet;
use App\Models\EWalletTransaction;
use App\Models\UserType;
use App\Models\User;

class WalletController extends Controller
{


    public function eWallet(Request $request)
    {
        // dd(session('LoggedUser'));
        $companyId = session('LoggedUser')->user_id;
        $companyWallet = getWallet('branch', $companyId);

        if(session('LoggedUser')->user_type_id==1){
            // Get company wallet
            $companyWallet = getEWallet('company', $companyId);
            $wallet = EWallet::where('owner_type', 'company')->where('owner_id', $companyId)->first();
            $transactions = EWalletTransaction::where('wallet_id', $wallet->id)->orderBy('id', 'ASC')->get();
            $totalCredit = EWalletTransaction::where('wallet_id', $wallet->id)->where('type', 'credit')->sum('amount');
            $totalDebit = EWalletTransaction::where('wallet_id', $wallet->id)->where('type', 'debit')->sum('amount');
        }

        if(session('LoggedUser')->user_type_id==2){
            // Get branch manager wallet
            // dd($companyId);
             $companyWallet = getEWallet('branch', $companyId);
            $wallet = EWallet::where('owner_type', 'branch')->where('owner_id', $companyId)->first();
            $transactions = EWalletTransaction::where('wallet_id', $wallet->id)->orderBy('id', 'ASC')->get();
            $totalCredit = EWalletTransaction::where('wallet_id', $wallet->id)->where('type', 'credit')->sum('amount');
            $totalDebit = EWalletTransaction::where('wallet_id', $wallet->id)->where('type', 'debit')->sum('amount');
        }
        // dd($transactions);
        $datas = [
            // 'fund_list' => $fund_list,
            'request' => $request,
            'page_title' => 'e-Wallet',
            'totalCredit' => $totalCredit,
            'totalDebit' =>  $totalDebit,
            'totalFund' => $totalCredit - $totalDebit,
            'companyWallet' => $companyWallet,
            'transactions' => $transactions,
            'user_type_list' =>  UserType::where('status', 1)->whereNotIn('id', [1, 2])->get(),
        ];
        return view('admin.wallet.e_wallet', $datas);
    }

     public function fundWallet(Request $request)
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

        $datas = [
            // 'fund_list' => $fund_list,
            'request' => $request,
            'page_title' => 'Fund Wallet',
            'totalCredit' => $totalCredit,
            'totalDebit' =>  $totalDebit,
            'totalFund' => $totalCredit - $totalDebit,
            'companyWallet' => $companyWallet,
            'transactions' => $transactions,
            'user_type_list' =>  UserType::where('status', 1)->whereNotIn('id', [1, 2])->get(),
        ];
        return view('admin.wallet.fund-wallet', $datas);
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




}
