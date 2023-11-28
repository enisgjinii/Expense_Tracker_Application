<!DOCTYPE html>
<html>

<head>
    <title>Expense Tracker - Home</title>
    <link href="https://fonts.cdnfonts.com/css/neue-haas-grotesk-display-pro" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">

</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>Expense Tracker</h2>
        <form method="POST" action="process_expense.php">
            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" required>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="groceries">Groceries</option>
                <option value="utilities">Utilities</option>
                <option value="rent">Rent</option>
                <!-- Add more options as needed -->
            </select>

            <label for="payment_type">Payment Type:</label>
            <select id="payment_type" name="payment_type" required>
                <option value="cash">Cash</option>
                <option value="credit_card">Credit Card</option>
                <option value="debit_card">Debit Card</option>
                <!-- Add more options as needed -->
            </select>

            <button type="submit">Add Expense</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>