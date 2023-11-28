<!DOCTYPE html>
<html>

<head>
    <title>Signup Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.cdnfonts.com/css/neue-haas-grotesk-display-pro" rel="stylesheet">
    <style>
        * {
            font-family: 'Neue Haas Grotesk Display Pro', sans-serif;

        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
        }

        .container input[type="text"],
        .container input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 10px;
        }

        .container button {
            background-color: #1ED2E7;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
        }

        .container button:hover {
            background-color: #1bbdcf;
        }

        @media (max-width: 600px) {
            .container {
                max-width: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Regjistrohu</h2>
        <form method="POST" action="">

            <label for="email">Adresa e email-it</label>
            <input type="text" id="email" name="email" placeholder="Shkruani adresen tuaj" required>

            <label for="password">Fjalëkalimi</label>
            <input type="password" id="password" name="password" placeholder="Shkruani fjalëkalimin tuaj" required>

            <button type="submit">Regjistrohu</button>
            <p style="text-align: right;cursor:pointer" type="button" onclick="window.location.href = 'login.php';">Kyçu</p>

        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Hash the password using Argon2
        $hashedPassword = password_hash($password, PASSWORD_ARGON2I);

        // Perform any necessary validation and database operations
        // Replace the following code with your actual logic to handle the signup process

        // Example code to insert the user into a database
        $dbHost = 'localhost';
        $dbUser = 'root';
        $dbPassword = '';
        $dbName = 'expense_tracker';

        $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO users (email, password_hash) VALUES ( '$email', '$hashedPassword')";

        if (mysqli_query($conn, $sql)) {
            echo "<p>Signup successful!</p>";
        } else {
            echo "<p>Error: " . mysqli_error($conn) . "</p>";
        }

        mysqli_close($conn);
    }
    ?>
</body>

</html>