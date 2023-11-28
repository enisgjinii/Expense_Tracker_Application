<?php
include 'conn.php'; // Assuming you have a file for database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $expenseId = mysqli_real_escape_string($conn, $_POST['expenseId']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $paymentType = mysqli_real_escape_string($conn, $_POST['paymentType']);

    // Update the database
    $updateQuery = "UPDATE expenses SET amount='$amount', category='$category', payment_type='$paymentType' WHERE id='$expenseId'";

    if ($conn->query($updateQuery) === TRUE) {
        // Redirect to the page where you display the expenses
        header("Location: expenses.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
