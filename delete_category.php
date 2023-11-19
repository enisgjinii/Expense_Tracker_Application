<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include database connection code (conn.php)
include 'conn.php';

// Check if the category ID is set in the query string
if (isset($_GET['id'])) {
    $categoryId = mysqli_real_escape_string($conn, $_GET['id']);

    // Delete the category from the database
    $deleteQuery = "DELETE FROM categories WHERE id = $categoryId AND user_id = {$_SESSION['user_id']}";
    mysqli_query($conn, $deleteQuery);

    // Redirect to categories.php after deletion
    header("Location: categories.php");
    exit();
} else {
    // If the category ID is not set, redirect to categories.php
    header("Location: categories.php");
    exit();
}
