<?php
session_start();
include '../conn.php';

if (empty($_SESSION['admin_username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];

    // Perform the deletion
    $sql_delete = "DELETE FROM users WHERE id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $user_id);

    if ($stmt_delete->execute()) {
        echo "User with ID $user_id deleted successfully.";
        header('Location: list_of_client.php');
        exit();
    } else {
        echo "Error deleting user.";
    }

    $stmt_delete->close();
}

$conn->close();
?>