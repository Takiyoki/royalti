<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use Carbon\Carbon;

class VoucherController extends Controller
{
    public function redeem(Request $request)
    {
        $request->validate([
            'code' => 'required|exists:vouchers,code'
        ]);

        $voucher = Voucher::where('code', $request->code)->first();

        if ($voucher->redeemed) {
            return response()->json(['message' => 'Voucher has already been redeemed'], 400);
        }

        if (Carbon::now()->gt($voucher->expires_at)) {
            return response()->json(['message' => 'Voucher has expired'], 400);
        }

        $voucher->update(['redeemed' => true]);

        return response()->json(['message' => 'Voucher redeemed successfully'], 200);
    }
}
