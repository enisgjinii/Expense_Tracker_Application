<?php
session_start();

// Include the connection file
include 'conn.php';

// Check if the user is not logged in
if (empty($_SESSION['admin_username'])) {
    // Redirect to the login page
    header('Location: login.php');
    exit();
} else {
    // Redirect to the dashboard
    header('Location: admin_dashboard.php');
    exit();
}


?>