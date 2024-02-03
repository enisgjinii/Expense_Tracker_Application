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
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <section class="home">
        <div class="text">Bugjeti</div>
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
                                    <button type="submit">Delete</button>
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