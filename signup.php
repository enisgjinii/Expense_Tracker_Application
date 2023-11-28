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

        input[type="file"]::file-selector-button {
            border-radius: 4px;
            padding: 0 16px;
            height: 40px;
            cursor: pointer;
            background-color: white;
            border: 1px solid rgba(0, 0, 0, 0.16);
            box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.05);
            margin-right: 16px;
            transition: background-color 200ms;
        }

        /* file upload button hover state */
        input[type="file"]::file-selector-button:hover {
            background-color: #f3f4f6;
        }

        /* file upload button active state */
        input[type="file"]::file-selector-button:active {
            background-color: #e5e7eb;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Regjistrohu</h2>
        <form method="POST" action="" enctype="multipart/form-data">

            <label for="email">Adresa e email-it</label>
            <input type="text" id="email" name="email" placeholder="Shkruani adresen tuaj" required>

            <label for="password">Fjalëkalimi</label>
            <input type="password" id="password" name="password" placeholder="Shkruani fjalëkalimin tuaj" required>

            <label for="profile_pic">Ngarko foton e profilit</label>
            <input type="file" id="profile_pic" name="profile_pic" accept="image/*">

            <button type="submit">Regjistrohu</button>
            <p style="text-align: right; cursor:pointer" type="button" onclick="window.location.href = 'login.php';">Kyçu</p>

        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Hash the password using Argon2
        $hashedPassword = password_hash($password, PASSWORD_ARGON2I);

        // Handle file upload
        $targetDirectory = "uploads/uploads_profile_pics/";  // Create a directory named "uploads" to store the uploaded files
        $targetFile = $targetDirectory . basename($_FILES["profile_pic"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }


        // Allow certain file formats
        $allowedFormats = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedFormats)) {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // if everything is ok, try to upload file
            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $targetFile)) {
                echo "The file " . htmlspecialchars(basename($_FILES["profile_pic"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

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

        $profilePicPath = $targetFile; // Set the path to the uploaded profile picture

        $sql = "INSERT INTO users (email, password_hash, profile_pic_path) VALUES ('$email', '$hashedPassword', '$profilePicPath')";

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