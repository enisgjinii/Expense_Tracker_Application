<?php
// Include your database connection code here
require_once 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the category ID and updated name from the POST request
    $categoryId = $_POST['categoryId'];
    $updatedName = $_POST['categoryName'];

    // Perform a database query to update the category name
    // Replace this with your actual database update query
    $sql = "UPDATE categories SET name = '$updatedName' WHERE id = $categoryId";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Update successful
        echo json_encode(['status' => 'success']);
        exit();
    } else {
        // Update failed
        echo json_encode(['status' => 'error', 'message' => 'Error updating category']);
        exit();
    }
} else {
    // Invalid request method
    header("HTTP/1.1 400 Bad Request");
    exit();
}
?>
