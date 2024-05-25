<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Pelanggan</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container">
    <h2>Form Registrasi Pelanggan</h2>
    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    <form method="post" action="{{ route('customer.store') }}">
        @csrf
        <label>Nama:</label>
        <input type="text" name="name" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <input type="submit" value="Submit">
    </form>
</div>
</body>
</html>
