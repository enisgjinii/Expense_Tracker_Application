<?php
include 'conn.php';

$result = $conn->query("SELECT * FROM expenses");

if ($result->num_rows > 0) {
    echo "<h2>Expenses</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Amount</th><th>Category</th><th>Payment Type</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"] . "</td><td>" . $row["amount"] . "</td><td>" . $row["category"] . "</td><td>" . $row["payment_type"] . "</td></tr>";
    }

    echo "</table>";
} else {
    echo "No expenses found.";
}

$conn->close();
