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
        .edit_button {
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
        .edit_button:hover {
            background-color: #F3F4F6;
            text-decoration: none;
            transition-duration: 0.1s;
        }
        .edit_button:disabled {
            background-color: #FAFBFC;
            border-color: rgba(27, 31, 35, 0.15);
            color: #959DA5;
            cursor: default;
        }
        .edit_button:active {
            background-color: #EDEFF2;
            box-shadow: rgba(225, 228, 232, 0.2) 0 1px 0 inset;
            transition: none 0s;
        }
        .edit_button:focus {
            outline: 1px transparent;
        }
        .edit_button:before {
            display: none;
        }
        .edit_button:-webkit-details-marker {
            display: none;
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
                <form method="post" style="font-size: 20px">
                    <div class="form-group">
                        <label for="username">Emri i përdoruesit:</label>
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