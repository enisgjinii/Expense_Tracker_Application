<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
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
                margin: 0 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Idenfitikohu</h2>
        <form method="POST" action="">
            <label for="email">Adresa e email-it</label>
            <input type="text" id="email" name="email" placeholder="Shkruani adresen tuaj" required>

            <label for="password">Fjalëkalimi</label>
            <input type="password" id="password" name="password" placeholder="Shkruani fjalëkalimin tuaj" required>

            <button type="submit">Kyçu</button>
            <p style="text-align: right;cursor:pointer" type="button" onclick="window.location.href = 'signup.php';">Regjistrohu</p>

        </form>
    </div>

    <?php
    session_start(); // Start the session

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the values from the form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check the credentials against the database
        // Replace the following code with your actual MySQL code to validate the login
        $dbHost = 'localhost';
        $dbUser = 'root';
        $dbPassword = '';
        $dbName = 'expense_tracker';

        $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password_hash'];

            // Verify the password using password_verify()
            if (password_verify($password, $hashedPassword)) {
                // User authenticated successfully

                // Set session variables
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $email;
                $_SESSION['login_time'] = time(); // Set the login time

                // Redirect to the home page or perform any necessary actions
                header("Location: home.php");
                exit();
            } else {
                // Invalid password
                echo "<p>Invalid password</p>";
            }
        } else {
            // User not found
            echo "<p>Invalid email</p>";
        }

        mysqli_close($conn);
    }
    ?>

</body>

</html>