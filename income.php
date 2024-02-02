<?php
session_start();

// Include the connection file
include 'conn.php';

// Check if the user is not logged in
if (empty($_SESSION['user_id'])) {
    // Redirect to the login page
    header('Location: login.php');
    exit();
}
function displaySuccessAlert($message)
{
    echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '$message',
            });
         </script>";
}

function displayErrorAlert($message)
{
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '$message',
            });
         </script>";
}

function uploadFile($target_dir)
{
    $target_file = $target_dir . basename($_FILES["receipt"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["receipt"]["tmp_name"]);
    if ($check !== false) {
        if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
            displayErrorAlert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            $uploadOk = 0;
        }
    } else {
        displayErrorAlert("File is not an image.");
        $uploadOk = 0;
    }

    if ($uploadOk == 1 && move_uploaded_file($_FILES["receipt"]["tmp_name"], $target_file)) {
        return $target_file;
    } else {
        displayErrorAlert("Sorry, there was an error uploading your file.");
        return false;
    }
}

function addExpense($amount, $category, $payment_type, $receipt_path)
{
    global $conn;

    $sql = "INSERT INTO expenses (amount, category, payment_type, receipt_path, client_id) VALUES ('$amount', '$category', '$payment_type', '$receipt_path','$_SESSION[user_id]')";

    if ($conn->query($sql) === TRUE) {
        displaySuccessAlert("Shpenzimet janë shtuar me sukses.");
    } else {
        displayErrorAlert("Shpenzimet nuk mund të shtoheshin. Ju lutemi provoni përsëri.");
    }
}

function addCategory($new_category)
{
    global $conn;

    $sql = "INSERT INTO categories (name) VALUES ('$new_category')";

    if ($conn->query($sql) === TRUE) {
        displaySuccessAlert("Kategoria është krijuar me sukses.");
    } else {
        displayErrorAlert("Kategoria nuk mund të krijohej. Ju lutemi provoni përsëri.");
    }
}

function deleteIncome($expense_id_to_delete)
{
    global $conn;

    $delete_sql = "DELETE FROM income WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("i", $expense_id_to_delete);

    if ($delete_stmt->execute()) {
        displaySuccessAlert("Expense deleted successfully.");
    } else {
        displayErrorAlert("Error deleting expense. Please try again.");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['amount'], $_POST['category'], $_POST['payment_type'])) {
        $amount = $_POST['amount'];
        $category = $_POST['category'];
        $payment_type = $_POST['payment_type'];

        $target_dir = "uploads/";
        $receipt_path = uploadFile($target_dir);

        if ($receipt_path) {
            addExpense($amount, $category, $payment_type, $receipt_path);
        }
    } elseif (isset($_POST['new_category'])) {
        $new_category = $_POST['new_category'];
        addCategory($new_category);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_income'])) {
    $expense_id_to_delete = $_POST['income_id'];
    deleteIncome($expense_id_to_delete);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['income_amount'])) {
    $income_amount = $_POST['income_amount'];
    $sql = "INSERT INTO income (amount, client_id) VALUES ('$income_amount','$_SESSION[user_id]')";

    if ($conn->query($sql) === TRUE) {
        header("Location: income.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_client.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <section class="home">
        <div class="text">Të ardhurat</div>
        <div class="text">
            <div class="tab">
                <button class="tablinks" onclick="tabsStates(event, 'regjistrimiTeArdhurave')">Regjistruesi i të ardhurave</button>
                <button class="tablinks" onclick="tabsStates(event, 'listaTeArdhurave')">Lista e të ardhurave</button>
            </div>

            <div id="regjistrimiTeArdhurave" class="tabcontent">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                <h5>Regjistruesi i të ardhurave</h5>
                <div>
                    <form method="POST" action="" style="font-size: 20px;">
                        <div>
                            <label for="income_amount">Totali i Te Ardhurave:</label>
                            <input type="number" id="income_amount" name="income_amount" required>
                        </div>
                        <div>
                            <button type="submit" style="font-size: 20px; padding: 10px; margin-top: 10px; background-color: white;border: 1px solid transparent;">Shto te ardhura</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="listaTeArdhurave" class="tabcontent">
                <?php

                $sql = "SELECT * FROM income WHERE client_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $_SESSION['user_id']);
                $stmt->execute();
                $result = $stmt->get_result();

                // Sum 
                $sql_amount = "SELECT SUM(amount) AS total FROM income WHERE client_id = ?";
                $stmt_amount = $conn->prepare($sql_amount);
                $stmt_amount->bind_param("i", $_SESSION['user_id']);
                $stmt_amount->execute();
                $result_amount = $stmt_amount->get_result();

                ?>
                <br>
                <h6>Totali i Te Ardhurave: <?php echo $result_amount->fetch_assoc()['total']; ?></h6>
                <br>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Totali</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php



                        while ($row = $result->fetch_assoc()) {
                            $id = $row['id'];
                            $amount = $row['amount'];
                        ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $amount; ?></td>
                                <td>
                                    <!-- Add the delete button -->
                                    <form method="POST" action="">
                                        <input type="hidden" name="income_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_income" style="background-color: #ff4d4d; color: white; border: none; padding: 5px 10px;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>


        </div>



        <script>
            function tabsStates(evt, cityName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }
        </script>
    </section>

    <script src="script.js"></script>

</body>

</html>