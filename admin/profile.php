<?php
session_start();
include '../conn.php';
class ProfileUpdater
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function updateUsername($newUsername, $adminId)
    {
        $updateQuery = "UPDATE admins SET username = ? WHERE id = ?";
        $stmt = $this->conn->prepare($updateQuery);
        $stmt->bind_param("si", $newUsername, $adminId);
        if ($stmt->execute()) {
            $_SESSION['admin_username'] = $newUsername;
            return true;
        } else {
            return false;
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = isset($_POST['username']) ? $_POST['username'] : '';
    // Validate and sanitize the input if needed
    // Update the username using the ProfileUpdater class
    $adminId = $_SESSION['admin_id'];
    $profileUpdater = new ProfileUpdater($conn);
    if ($profileUpdater->updateUsername($newUsername, $adminId)) {
        // Username updated successfully
        echo "Username updated successfully!";
        header("Location: profile.php");
        exit();
    } else {
        // Error updating username
        echo "Error updating username: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_admin.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .home {
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h5 {
            color: #333;
        }

        .container {
            max-width: 500px;
            margin: auto;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        .edit_button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.2s ease-in-out;
        }

        .edit_button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <section class="home">
        <h5 class="text">Profili im</h5>
        <hr>
        <div class="text">
            <div class="container">
                <form method="post">
                    <div class="form-group">
                        <label for="username">Emri i përdoruesit:</label>
                        <input type="text" id="username" name="username" value="<?php echo $_SESSION['admin_username']; ?>">
                    </div>
                    <br>
                    <input type="submit" value="Edito" class="edit_button">
                </form>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="../script.js"></script>
</body>

</html>