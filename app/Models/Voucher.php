<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherController extends Controller
{
    public function redeem()
    {
        return view('voucher.redeem');
    }

    public function processRedeem(Request $request)
    {
        $request->validate([
            'voucher_code' => 'required|exists:vouchers,voucher_code',
        ]);

        $voucher = Voucher::where('voucher_code', $request->voucher_code)
                          ->where('redeemed', false)
                          ->where('expires_at', '>', now())
                          ->first();

        if ($voucher) {
            $voucher->update([
                'redeemed' => true,
                'redeemed_at' => now(),
            ]);
            return redirect()->route('voucher.redeem')->with('success', 'Voucher berhasil ditukarkan!');
        } else {
            return redirect()->route('voucher.redeem')->with('error', 'Voucher tidak valid atau sudah kedaluwarsa.');
        }
    }
}

