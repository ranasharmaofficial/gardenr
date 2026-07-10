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
use App\Models\CardStock;
use App\Models\CardTransaction;
use App\Models\KitStock;
use App\Models\KitTransaction;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class KitController extends Controller
{

    /* ===============================
       Admin → Issue Cards
    =============================== */
    public function issue(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date'
        ]);

        DB::transaction(function () use ($request) {

            $stock = KitStock::firstOrCreate(
                ['user_id' => $request->user_id],
                ['quantity' => 0]
            );

            $stock->increment('quantity', $request->quantity);

            KitTransaction::create([
                'from_user_id' => null,
                'to_user_id' => $request->user_id,
                'quantity' => $request->quantity,
                'date' => $request->date,
                'type' => 'issue',
                'note' => 'Admin issued cards'
            ]);
        });

        // return back()->with('success','Cards issued successfully');
        return response()->json([
            'status' => true,
            'message' => 'Kits issued successfully',
        ]);
    }


    /* ===============================
       User → Transfer Cards
    =============================== */
    public function transfer(Request $request)
    {
        $request->validate([
            'to_user_id' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $fromUser = auth()->id();

        DB::transaction(function () use ($request, $fromUser) {

            $fromStock = KitStock::where('user_id', $fromUser)->first();

            if (!$fromStock || $fromStock->quantity < $request->quantity) {
                throw new \Exception('Insufficient kits');
            }

            // minus
            $fromStock->decrement('quantity', $request->quantity);

            // plus
            $toStock = KitStock::firstOrCreate(
                ['user_id' => $request->to_user_id],
                ['quantity' => 0]
            );

            $toStock->increment('quantity', $request->quantity);

            KitTransaction::create([
                'from_user_id' => $fromUser,
                'to_user_id' => $request->to_user_id,
                'quantity' => $request->quantity,
                'type' => 'transfer',
                'note' => 'Kit transfer'
            ]);
        });

        return back()->with('success', 'Kits transferred successfully');
    }


    /* ===============================
       Admin Dashboard
    =============================== */
    public function index()
    {
        $stocks = KitStock::with('user')->get();
        $transactions = KitTransaction::with(['fromUser', 'toUser'])->latest()->get();

        return view('kits.index', compact('stocks', 'transactions'));
    }
    // public function history($userId)
    // {
    //     $user = User::findOrFail($userId);

    //     $transactions = KitTransaction::with(['fromUser','toUser'])
    //         ->where('from_user_id', $userId)
    //         ->orWhere('to_user_id', $userId)
    //         ->latest()
    //         ->get();

    //     return view('admin.staffs.vivah_mitra.vivahmitra.kit-history', compact('user','transactions'));
    // }

    public function history(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        // dd( $user);
        $userStock = KitStock::where('user_id', $userId)->first();

        $totalKits = KitStock::sum('quantity');

        $transactions = KitTransaction::where(function ($q) use ($userId) {
            $q->where('from_user_id', $userId)
                ->orWhere('to_user_id', $userId);
        })
            ->latest()
            ->paginate(10);

        if ($request->ajax()) {
            return view('admin.staffs.vivah_mitra.vivahmitra.history_table', compact('transactions'))->render();
        }

        return view('admin.staffs.vivah_mitra.vivahmitra.kit-history', compact(
            'user',
            'transactions',
            'userStock',
            'totalKits',
        ));
    }

   public function kitTransferHistoryDelete($id)
    {
        DB::beginTransaction();

        try {
            $trx = KitTransaction::lockForUpdate()->findOrFail($id);

            $type = strtolower($trx->type);

            // =========================
            // CASE 1: ISSUE (Admin → User)
            // =========================
            if ($type === 'issue') {

                $stock = KitStock::where('user_id', $trx->to_user_id)
                    ->lockForUpdate()
                    ->first();

                if (!$stock) {
                    throw new \Exception('Stock record not found');
                }

                if ($stock->quantity < $trx->quantity) {
                    throw new \Exception('Cannot delete: Stock already used by user');
                }

                // reverse full stock
                $stock->decrement('quantity', $trx->quantity);
            }

            // =========================
            // CASE 2: TRANSFER (User → User)
            // =========================
            elseif ($type === 'transfer') {

                // Receiver stock minus
                $toStock = KitStock::where('user_id', $trx->to_user_id)
                    ->lockForUpdate()
                    ->first();

                if (!$toStock || $toStock->quantity < $trx->quantity) {
                    throw new \Exception('Cannot delete: Receiver already used stock');
                }

                $toStock->decrement('quantity', $trx->quantity);

                // Sender stock add back
                $fromStock = KitStock::firstOrCreate(
                    ['user_id' => $trx->from_user_id],
                    ['quantity' => 0]
                );

                $fromStock->increment('quantity', $trx->quantity);
            }

            else {
                throw new \Exception('Invalid transaction type');
            }

            // =========================
            // Delete transaction
            // =========================
            $trx->delete();

            DB::commit();

            return back()->with('alert-success', 'Transaction deleted & stock updated successfully');

        } catch (\Exception $e) {

            DB::rollBack();

            // Log error (IMPORTANT for production)
            \Log::error('Kit Delete Error', [
                'id' => $id,
                'message' => $e->getMessage()
            ]);

            return back()->with('error', $e->getMessage());
        }
    }

}
