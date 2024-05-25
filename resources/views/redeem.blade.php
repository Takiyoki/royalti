<!DOCTYPE html>
<html>
<head>
    <title>Redeem Voucher</title>
</head>
<body>
    <form method="POST" action="/redeem">
        @csrf
        <input type="text" name="code" placeholder="Voucher Code" required>
        <button type="submit">Redeem</button>
    </form>
</body>
</html>
