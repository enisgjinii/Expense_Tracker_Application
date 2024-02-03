<?php
session_start();
include '../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate and sanitize the input if needed

    // Update the password in the database
    $adminId = $_SESSION['admin_id']; // Assuming you have an 'admin_id' in your session
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $updateQuery = "UPDATE admins SET password = '$hashedPassword' WHERE id = $adminId";

    if (mysqli_query($conn, $updateQuery)) {
        // Password updated successfully
        echo "Password updated successfully!";
    } else {
        // Error updating password
        echo "Error updating password: " . mysqli_error($conn);
    }
}
