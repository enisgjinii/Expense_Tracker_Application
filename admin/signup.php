<?php
session_start();

function registerAdmin($username, $password, $confirmPassword)
{
    if (empty($username) || empty($password) || empty($confirmPassword)) {
        return "Ju lutem plotësoni të gjitha fushat.";
    } elseif ($password !== $confirmPassword) {
        return "Fjalëkalimet nuk përputhen.";
    } else {
        include '../conn.php';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO admins (username, password) VALUES ('$username', '$hashedPassword')";
        $result = mysqli_query($conn, $query);
        header("Location: login.php");
        exit;
        // return "Admini u regjistrua me sukses!";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];
    $result = registerAdmin($username, $password, $confirmPassword);
    if (strpos($result, "sukses") !== false) {
        $_SESSION['admin_username'] = $username;
        setcookie('admin_username', $username, time() + 86400, '/');
    }
    echo $result;
}
?>
<!DOCTYPE html>
<html lang="sq">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regjistrimi i Adminit</title>

    <style>
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
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .button-4 {
            appearance: none;
            background-color: #FAFBFC;
            border: 1px solid rgba(27, 31, 35, 0.15);
            border-radius: 6px;
            box-shadow: rgba(27, 31, 35, 0.04) 0 1px 0, rgba(255, 255, 255, 0.25) 0 1px 0 inset;
            box-sizing: border-box;
            color: #24292E;
            cursor: pointer;
            display: inline-block;
            font-family: -apple-system, system-ui, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            list-style: none;
            padding: 6px 16px;
            position: relative;
            transition: background-color 0.2s cubic-bezier(0.3, 0, 0.5, 1);
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: middle;
            white-space: nowrap;
            word-wrap: break-word;
        }

        .button-4:hover {
            background-color: #F3F4F6;
            text-decoration: none;
            transition-duration: 0.1s;
        }

        .button-4:disabled {
            background-color: #FAFBFC;
            border-color: rgba(27, 31, 35, 0.15);
            color: #959DA5;
            cursor: default;
        }

        .button-4:active {
            background-color: #EDEFF2;
            box-shadow: rgba(225, 228, 232, 0.2) 0 1px 0 inset;
            transition: none 0s;
        }

        .button-4:focus {
            outline: 1px transparent;
        }

        .button-4:before {
            display: none;
        }

        .button-4:-webkit-details-marker {
            display: none;
        }

        .button-register {
            appearance: none;
            background-color: #2ea44f;
            border: 1px solid rgba(27, 31, 35, .15);
            border-radius: 6px;
            box-shadow: rgba(27, 31, 35, .1) 0 1px 0;
            box-sizing: border-box;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            font-family: -apple-system, system-ui, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
            font-size: 14px;
            font-weight: 600;
            line-height: 20px;
            padding: 6px 16px;
            position: relative;
            text-align: center;
            text-decoration: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: middle;
            white-space: nowrap;
        }

        .button-register:focus:not(:focus-visible):not(.focus-visible) {
            box-shadow: none;
            outline: none;
        }

        .button-register:hover {
            background-color: #2c974b;
        }

        .button-register:focus {
            box-shadow: rgba(46, 164, 79, .4) 0 0 0 3px;
            outline: none;
        }

        .button-register:disabled {
            background-color: #94d3a2;
            border-color: rgba(27, 31, 35, .1);
            color: rgba(255, 255, 255, .8);
            cursor: default;
        }

        .button-register:active {
            background-color: #298e46;
            box-shadow: rgba(20, 70, 32, .2) 0 1px 0 inset;
        }
    </style>
</head>

<body>
    <form method="post" action="">
        <label for="username">Emri i përdoruesit:</label>
        <input type="text" name="username" required>
        <label for="password">Fjalëkalimi:</label>
        <input type="password" name="password" required>
        <label for="confirm_password">Konfirmo Fjalëkalimin:</label>
        <input type="password" name="confirm_password" required>
        <input type="submit" value="Regjistrohu" class="button-register">
        <button class="button-4" role="button" onclick="window.location.href = 'login.php';">Kyqu nese ke llogari aktive</button>

    </form>
</body>

</html>