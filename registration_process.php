<?php
session_start();
include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    // Insert data into the 'users' table
    $sql = "INSERT INTO users (email, password_hash) VALUES ('$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful
        echo "Regjistrimi u krye me sukses!";
        header("Location: login.php");
    } else {
        // Registration failed
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
