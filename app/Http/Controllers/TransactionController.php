<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Voucher;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|integer',
            'transaction_id' => 'required|unique:transactions,transaction_id'
        ]);

        $transaction = Transaction::create([
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'transaction_id' => $request->transaction_id
        ]);

        if ($transaction->amount >= 1000000) {
            $vouchers = intdiv($transaction->amount, 1000000);
            for ($i = 0; $i < $vouchers; $i++) {
                Voucher::create([
                    'user_id' => $transaction->user_id,
                    'code' => uniqid(),
                    'expires_at' => Carbon::now()->addMonths(3)
                ]);
            }
        }

        return response()->json($transaction, 201);
    }
}
