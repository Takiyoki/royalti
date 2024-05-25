<!DOCTYPE html>
<html>
<head>
    <title>Form Penukaran Voucher</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">
    <h2>Form Penukaran Voucher</h2>
    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @elseif (session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif
    <form method="post" action="{{ route('voucher.processRedeem') }}">
        @csrf
        <label>Kode Voucher:</label>
        <input type="text" name="voucher_code" required>
        <input type="submit" value="Submit">
    </form>
</div>
</body>
</html>
