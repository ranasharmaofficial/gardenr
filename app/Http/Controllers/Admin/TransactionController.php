<?php

namespace App\Http\Controllers\Admin;

use App\Models\Staff;
use Illuminate\Http\Request;

use App\Models\Branch;
use App\Models\User;
use App\Models\UserLogin;
use App\Models\UserType;
use App\Models\District;

use App\Models\UserDetail;
use App\Models\Wallet;
use App\Models\EWallet;
use App\Models\EWalletTransaction;
use App\Models\Transaction;
use App\Models\MasterVivahmitraCode;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class TransactionController extends Controller
{

    public function getUserBank($id)
    {
        $user = User::select(
                    'users.id',
                    'users.first_name',
                    'user_details.bank_name',
                    'user_details.account_number',
                    'user_details.account_number',
                    'user_details.ifsc_code',
                    'user_details.upi_details',
                    'e_wallets.balance as current_balance',
                )
                ->leftJoin('user_details','user_details.user_id','=','users.id')
                ->leftJoin('e_wallets','e_wallets.owner_id','=','users.id')
                ->where('users.id',$id)
                ->first();
        return response()->json($user);
    }

    public function store1(Request $request)
    {
        // dd($request->all());

        // ✅ Validation with image
        $request->validate([
            'user_id'     => 'required|integer|exists:users,id',
            'paying_area' => 'required|string',
            'utr_no'      => 'required|string|max:100',
            'amount'      => 'required|numeric|min:1',
            'screenshot'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        DB::beginTransaction();

        try {

            $wallet = getEWallet('employee', $request->user_id);

            if (!$wallet) {
                return redirect()->back()->with(session()->flash('alert-danger', 'Wallet not found'));
            }

            $amount = $request->amount;

            // ✅ Balance check
            if ($wallet->balance < $amount) {
                return redirect()->back()->with(session()->flash('alert-danger', 'Insufficient wallet balance'));
            }

            /* ==============================
            Screenshot Upload
            ============================== */

            $image_file_name = null;
            $uploadPath = public_path('uploads/screenshot');

            if ($request->hasFile('screenshot')) {
                $image_file_name = 'screenshot' . time() . '.' . $request->screenshot->getClientOriginalExtension();
                $request->screenshot->move($uploadPath, $image_file_name);
                $fileName = $image_file_name;
            }

            /* ==============================
            Debit Wallet
            ============================== */

            debitEWallet(
                $wallet,
                $amount,
                "Amount debited for payment in area: {$request->paying_area}, UTR No: {$request->utr_no}",
            );

            /* ==============================
            Insert Transaction
            ============================== */

            Transaction::create([
                'user_id'     => $request->user_id,
                'paying_area' => $request->paying_area,
                'utr_no'      => $request->utr_no,
                'screenshot'  => $fileName, // ✅ saved file name
                'amount'      => $amount,
                'type'        => 'credit',
                'status'      => 'paid',
                'paid_by'      => session('LoggedUser')->user_id,
            ]);

            DB::commit();

            return redirect()->back()->with(session()->flash('alert-success', 'Payment recorded successfully'));

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    public function storeOld(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|integer|exists:users,id',
            'paying_area' => 'required|string',
            'utr_no'      => 'required|string|max:100',
            'amount'      => 'required|numeric|min:1',
            'screenshot'  => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        DB::beginTransaction();

        try {

            $wallet = getEWallet('employee', $request->user_id);

            if (!$wallet) {
                return response()->json([
                    'status' => false,
                    'message' => 'Wallet not found'
                ]);
            }

            $amount = $request->amount;

            if ($wallet->balance < $amount) {
                return response()->json([
                    'status' => false,
                    'message' => 'Insufficient wallet balance'
                ]);
            }

            /* Screenshot upload */
            $fileName = null;

            if ($request->hasFile('screenshot')) {

                $uploadPath = public_path('uploads/screenshot');

                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                $file = $request->file('screenshot');

                $fileName = 'screenshot_' . time() . '.' . $file->getClientOriginalExtension();

                $file->move($uploadPath, $fileName);
            }

            /* Debit wallet */
            debitEWallet(
                $wallet,
                $amount,
                "Amount debited for payment in area: {$request->paying_area}, UTR No: {$request->utr_no}"
            );

            /* Save transaction */
            $transaction = Transaction::create([
                'user_id'     => $request->user_id,
                'paying_area' => $request->paying_area,
                'utr_no'      => $request->utr_no,
                'screenshot'  => $fileName,
                'amount'      => $amount,
                'type'        => 'credit',
                'status'      => 'paid',
                'paid_by'     => session('LoggedUser')->user_id,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Payment recorded successfully',
                'data' => $transaction
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|integer|exists:users,id',
            'amount'      => 'required|numeric|min:1',
            'paying_area' => 'required|string',
            'utr_no'      => 'required|string|max:100',
            'screenshot'  => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        DB::beginTransaction();

        try {

            $user = User::findOrFail($request->user_id);
            $payAmount = $request->amount; // Admin is paying this amount

            /* ----------------------------------
            Designation Commission Limit
            ---------------------------------- */

            $designationLimit = [
                7  => 1500,
                8  => 2100,
                9  => 5100,
                10 => 8100,
            ];

            $limitAmount = $designationLimit[$user->user_designation_id] ?? 0;

            /* ----------------------------------
            Previous Commission Earned
            ---------------------------------- */

            $totalCommissionPaid = Transaction::where('user_id', $user->id)
                ->sum('commission');

            /* ----------------------------------
            Charges from Pay Amount
            ---------------------------------- */

            $adminCharge  = $payAmount * 0.02;
            $maintenance  = $payAmount * 0.02;

            /* Commission Logic */

            if ($totalCommissionPaid >= $limitAmount) {

                $commission = 0;

            } else {

                $commission = $payAmount * 0.10;

                if (($totalCommissionPaid + $commission) > $limitAmount) {
                    $commission = $limitAmount - $totalCommissionPaid;
                }
            }

            $totalCharges = $adminCharge + $maintenance + $commission;

            $netAmountToUser = $payAmount - $totalCharges;

            if ($netAmountToUser < 0) {
                throw new \Exception("Charges exceed payment amount.");
            }

            /* ----------------------------------
            Admin Wallet Deduction
            ---------------------------------- */

            $adminWallet = getWallet('company', session('LoggedUser')->user_id);

            if (!$adminWallet) {
                return response()->json([
                    'status' => false,
                    'message' => 'Admin wallet not found'
                ]);
            }

            if ($adminWallet->balance < $payAmount) {
                return response()->json([
                    'status' => false,
                    'message' => 'Insufficient admin wallet balance'
                ]);
            }

            debitWallet(
                $adminWallet,
                $payAmount,
                "Payment given to user {$user->id}"
            );

            /* ----------------------------------
            Credit User Wallet (Net Amount)
            ---------------------------------- */

            $userWallet = getEWallet('employee', $user->id);

            debitEWallet(
                $userWallet,
                $payAmount,
                "admin_payout",
                "Received payment after charges"
            );

            /* ----------------------------------
            Screenshot Upload
            ---------------------------------- */

            $fileName = null;

            if ($request->hasFile('screenshot')) {

                $uploadPath = public_path('uploads/screenshot');

                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                $file = $request->file('screenshot');
                $fileName = 'screenshot_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move($uploadPath, $fileName);
            }

            /* ----------------------------------
            Save Transaction
            ---------------------------------- */

            $transaction = Transaction::create([
                'user_id'        => $user->id,
                'paying_area'    => $request->paying_area,
                'utr_no'         => $request->utr_no,
                'screenshot'     => $fileName,
                'amount'         => $payAmount,
                'commission'     => $commission,
                'admin_charge'   => $adminCharge,
                'maintenance'    => $maintenance,
                'total_amount'   => $netAmountToUser,
                'type'           => 'credit',
                'status'         => 'paid',
                'paid_by'        => session('LoggedUser')->user_id,
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Payment processed successfully',
                'data' => [
                    'gross_payment' => $payAmount,
                    'commission'    => $commission,
                    'admin_charge'  => $adminCharge,
                    'maintenance'   => $maintenance,
                    'net_to_user'   => $netAmountToUser
                ]
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }





}
