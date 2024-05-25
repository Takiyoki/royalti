<!DOCTYPE html>
<html>
<head>
    <title>Create Transaction</title>
</head>
<body>
    <form method="POST" action="/transaction">
        @csrf
        <input type="number" name="user_id" placeholder="User ID" required>
        <input type="number" name="amount" placeholder="Amount" required>
        <input type="text" name="transaction_id" placeholder="Transaction ID" required>
        <button type="submit">Create Transaction</button>
    </form>
</body>
</html>
