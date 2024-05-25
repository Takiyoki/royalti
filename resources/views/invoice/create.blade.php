<!DOCTYPE html>
<html>
<head>
    <title>Form Transaksi</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">
    <h2>Form Transaksi</h2>
    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    <form method="post" action="{{ route('invoice.store') }}">
        @csrf
        <label>ID Pelanggan:</label>
        <select name="customer_id" required>
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
            @endforeach
        </select>
        <label>Jumlah Pembelanjaan:</label>
        <input type="number" name="amount" required>
        <label>ID Transaksi:</label>
        <input type="text" name="transaction_id" required>
        <input type="submit" value="Submit">
    </form>
</div>
</body>
</html>
