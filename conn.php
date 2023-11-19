<?php
// Database configuration
$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'expense_tracker';

// Create a database connection
$conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
