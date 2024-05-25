<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Voucher;
use App\Models\Customer;

class InvoiceController extends Controller
{
    public function create()
    {
        $customers = Customer::all();
        return view('invoice.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0',
            'transaction_id' => 'required|unique:invoices',
        ]);

        $invoice = Invoice::create($request->all());

        // Generate voucher if applicable
        $voucher_amount = floor($request->amount / 1000000) * 10000;
        if ($voucher_amount > 0) {
            $voucher_code = strtoupper(bin2hex(random_bytes(5)));
            $expires_at = now()->addMonths(3);
            Voucher::create([
                'voucher_code' => $voucher_code,
                'customer_id' => $request->customer_id,
                'amount' => $voucher_amount,
                'expires_at' => $expires_at,
            ]);
        }

        return redirect()->route('invoice.create')->with('success', 'Transaksi berhasil dicatat!');
    }
}
