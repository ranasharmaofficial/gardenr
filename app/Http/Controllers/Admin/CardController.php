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

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class CardController extends Controller
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

            $stock = CardStock::firstOrCreate(
                ['user_id' => $request->user_id],
                ['quantity' => 0]
            );

            $stock->increment('quantity', $request->quantity);

            CardTransaction::create([
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
            'message' => 'Cards issued successfully',
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

            $fromStock = CardStock::where('user_id', $fromUser)->first();

            if (!$fromStock || $fromStock->quantity < $request->quantity) {
                throw new \Exception('Insufficient cards');
            }

            // minus
            $fromStock->decrement('quantity', $request->quantity);

            // plus
            $toStock = CardStock::firstOrCreate(
                ['user_id' => $request->to_user_id],
                ['quantity' => 0]
            );

            $toStock->increment('quantity', $request->quantity);

            CardTransaction::create([
                'from_user_id' => $fromUser,
                'to_user_id' => $request->to_user_id,
                'quantity' => $request->quantity,
                'type' => 'transfer',
                'note' => 'Card transfer'
            ]);
        });

        return back()->with('success', 'Cards transferred successfully');
    }


    /* ===============================
       Admin Dashboard
    =============================== */
    public function index()
    {
        $stocks = CardStock::with('user')->get();
        $transactions = CardTransaction::with(['fromUser', 'toUser'])->latest()->get();

        return view('cards.index', compact('stocks', 'transactions'));
    }
    // public function history($userId)
    // {
    //     $user = User::findOrFail($userId);

    //     $transactions = CardTransaction::with(['fromUser','toUser'])
    //         ->where('from_user_id', $userId)
    //         ->orWhere('to_user_id', $userId)
    //         ->latest()
    //         ->get();

    //     return view('admin.staffs.vivah_mitra.vivahmitra.card-history', compact('user','transactions'));
    // }

    public function history(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        // dd( $user);
        $userStock = CardStock::where('user_id', $userId)->first();

        $totalCards = CardStock::sum('quantity');

        $transactions = CardTransaction::where(function ($q) use ($userId) {
            $q->where('from_user_id', $userId)
                ->orWhere('to_user_id', $userId);
        })
            ->latest()
            ->paginate(10);

        if ($request->ajax()) {
            return view('admin.staffs.vivah_mitra.vivahmitra.history_table', compact('transactions'))->render();
        }

        return view('admin.staffs.vivah_mitra.vivahmitra.card-history', compact(
            'user',
            'transactions',
            'userStock',
            'totalCards',
        ));
    }
}
