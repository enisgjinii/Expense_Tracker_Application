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

// Handle form submission for updating profile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newEmail = $_POST['new_email'];
    // Add more fields as needed

    // Update the user profile in the database
    $updateSql = "UPDATE users SET email = '$newEmail' WHERE id = $user_id";

    if ($conn->query($updateSql) === TRUE) {
        // Update successful, refresh the user information
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        }
    } else {
        // Handle the case where the update fails
        echo "Error updating profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
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

        .profile-pic {
            display: block;
            margin: 20px auto;
            border-radius: 50%;
            max-width: 100%;
            height: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        button {
            background-color: #1ED2E7;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
        }

        button:hover {
            background-color: #1bbdcf;
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
        <h2>Ndryshoni profilin e përdoruesit</h2>

        <?php if ($user) : ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="new_email">E-mail i ri:</label>
                    <input type="text" id="new_email" name="new_email" value="<?php echo $user['email']; ?>" required>
                </div>
                <button type="submit">Ruaj ndryshimet</button>
            </form>
            <?php if ($user['profile_pic_path']) : ?>
                <img class="profile-pic" src="<?php echo $user['profile_pic_path']; ?>" alt="Profile Picture">
            <?php else : ?>
                <p>Nuk disponohet asnjë fotografi profili.</p>
            <?php endif; ?>

            <!-- Example: Link to view profile -->
            <a href="profile.php">Shiko Profilin</a>
        <?php else : ?>
            <p>Përdoruesi nuk u gjet.</p>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>

</body>

</html>