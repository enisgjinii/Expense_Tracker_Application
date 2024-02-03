<?php
session_start();
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // Validate and sanitize the input if needed

    $insertQuery = "INSERT INTO contact_submissions (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        header("Location: contact.php");
        exit();
    } else {
        echo "Error submitting contact form: " . $conn->error;
    }
}
