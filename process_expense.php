<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $payment_type = $_POST['payment_type'];

    $sql = "INSERT INTO expenses (amount, category, payment_type) VALUES ('$amount', '$category', '$payment_type')";

    if ($conn->query($sql) === TRUE) {
        echo "Expense added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
