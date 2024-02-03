<?php
session_start(); // Start the session
include '../conn.php';
function authenticateAdmin($username, $password)
{
    include '../conn.php';
    $query = "SELECT * FROM admins WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $adminData = mysqli_fetch_assoc($result);
        // Put in session id 
        $_SESSION['admin_id'] = $adminData['id'];
        // Verify the password
        if (password_verify($password, $adminData['password'])) {
            // Set session and cookie for 24 hours (86400 seconds)
            $_SESSION['admin_username'] = $username;
            setcookie('admin_username', $username, time() + 86400, '/');

            return true; // Authentication successful
        }
    }

    return false; // Authentication failed
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (authenticateAdmin($username, $password)) {
        // Redirect to a secure admin dashboard or any other authenticated page
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $loginError = "Kredenciale të pasakta. Ju lutem provoni përsëri.";
    }
}
?>

<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identifikimi i Adminit</title>

    <style>
        /* Style for login.php */

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
        }

        form {
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p.error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>

</head>

<body>
    <form method="post" action="">
        <h2>Identifikimi i Administratorit</h2>
        <label for="username">Emri i përdoruesit:</label>
        <input type="text" name="username" required>
        <label for="password">Fjalëkalimi:</label>
        <input type="password" name="password" required>
        <input type="submit" value="Identifikohu">
        <?php if (isset($loginError)) echo "<p style='color: red;'>$loginError</p>"; ?>
    </form>

</body>

</html>