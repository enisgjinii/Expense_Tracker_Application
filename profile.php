<?php
// Start the session
session_start();

// Assuming you have a file for database connection
include 'conn.php';

// Assuming you have a user authentication system and retrieve user information
// You might have a $_SESSION or other authentication mechanism
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to the login page if the user is not authenticated
    exit();
}

$user_id = $_SESSION['user_id'];

// Retrieve user profile information from the database
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    // Handle the case where the user is not found
    $user = null;
}
?>

<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://fonts.cdnfonts.com/css/neue-haas-grotesk-display-pro" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #f2f2f2;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            margin: 25px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
        }

        button {
            background-color: #1ED2E7;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 10px;
            text-decoration: none;
        }

        .profile-pic {
            height: 150px;
            width: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container">
        <h2>Profili i perdoruesit</h2>

        <?php if ($user) : ?>
            <b>Adresa e email-it tuaj: </b>
            <p><?php echo $user['email']; ?></p>

            <!-- Display user profile picture -->
            <?php if ($user['profile_pic_path']) : ?>
                <img src="<?php echo $user['profile_pic_path']; ?>" alt="Profile Picture" class="profile-pic">
            <?php else : ?>
                <p>Nuk disponohet asnjë fotografi profili.</p>
            <?php endif; ?>

            <br>
            <br>
            <!-- Example: Link to edit profile -->
            <a class="button" href="edit_profile.php">Redakto profilin</a>
        <?php else : ?>
            <p>Përdoruesi nuk është gjetur.</p>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>