<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $expenseId = $_GET['id'];

    // Perform the deletion operation
    $sql = "DELETE FROM expenses WHERE id = $expenseId";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the expenses page after successful deletion
        header("Location: expenses.php");
        exit();
    } else {
        // Handle the error as needed
        // You may choose to redirect with an error message or display it on the same page
        echo "Error deleting expense: " . $conn->error;
    }
} else {
    // Handle the case where the request is invalid
    echo "Invalid request";
}

$conn->close();
