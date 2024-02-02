<?php
session_start(); // Start the session

// Check if the admin is authenticated
if (!isset($_SESSION['admin_username']) && !isset($_COOKIE['admin_username'])) {
    header("Location: login.php"); // Redirect to login page if not authenticated
    exit();
}

// You can retrieve additional admin data or perform other tasks related to the admin dashboard here

?>

<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paneli i Adminit</title>

    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #333;
            padding: 15px;
            color: white;
            text-align: center;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            background-color: #555;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 16px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            text-align: left;
        }

        .sidebar a:hover {
            background-color: #4CAF50;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        p.welcome-message {
            text-align: center;
            font-size: 18px;
        }

        a.logout-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #4caf50;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?> <!-- Include the navbar component -->
    <?php include 'sidebar.php'; ?> <!-- Include the sidebar component -->

    <div class="content">
        <!-- Your main content goes here -->
        <h2>Main Content</h2>
        <p>Here you can add the content for managing users, admins, and other functions.</p>
    </div>
</body>
z

</html>