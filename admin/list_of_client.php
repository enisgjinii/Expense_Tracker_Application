<?php
session_start();
// Include the connection file
include '../conn.php';

// Check if the user is not logged in
if (empty($_SESSION['admin_username'])) {
    // Redirect to the login page
    header('Location: login.php');
    exit();
}

class UserManagement
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getTotalUsers()
    {
        $sql_count = "SELECT COUNT(*) AS total_records FROM users";
        $result_count = mysqli_query($this->conn, $sql_count);

        if ($result_count) {
            $row_count = mysqli_fetch_assoc($result_count);
            return $row_count['total_records'];
        }

        return 0;
    }

    public function getUserDetails()
    {
        $userDetails = array();

        $sql_users = "SELECT id, email FROM users";
        $result_users = mysqli_query($this->conn, $sql_users);

        while ($row_users = $result_users->fetch_assoc()) {
            $userDetails[] = array(
                'id' => $row_users['id'],
                'email' => $row_users['email'],
            );
        }

        return $userDetails;
    }
}

$userManagement = new UserManagement($conn);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_admin.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .button-delete {
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

        .button-delete:focus:not(:focus-visible):not(.focus-visible) {
            box-shadow: none;
            outline: none;
        }

        .button-delete:hover {
            background-color: #2c974b;
        }

        .button-delete:focus {
            box-shadow: rgba(46, 164, 79, .4) 0 0 0 3px;
            outline: none;
        }

        .button-delete:disabled {
            background-color: #94d3a2;
            border-color: rgba(27, 31, 35, .1);
            color: rgba(255, 255, 255, .8);
            cursor: default;
        }

        .button-delete:active {
            background-color: #298e46;
            box-shadow: rgba(20, 70, 32, .2) 0 1px 0 inset;
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <section class="home">
        <div class="text">Lista e klienteve</div>
        <div class="text">
            <?php
            // Get the total number of users using the class
            $total_records = $userManagement->getTotalUsers();
            ?>
            <br>
            <h6>Numri total i klienteve aktiv:
                <?php echo $total_records; ?>
            </h6>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Action</th> <!-- New column for delete button -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Retrieve user details using the class
                    $userDetails = $userManagement->getUserDetails();

                    foreach ($userDetails as $user) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $user['id']; ?>
                            </td>
                            <td>
                                <?php echo $user['email']; ?>
                            </td>
                            <td>
                                <form action="delete_user.php" method="post">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" class="button-delete">
                                        <i class='bx bx-trash' style="font-size: 20px;"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <script src="../script.js"></script>
</body>

</html>