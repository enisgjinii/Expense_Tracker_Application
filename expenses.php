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

function deleteExpense($expense_id_to_delete)
{
    global $conn;

    $delete_sql = "DELETE FROM expenses WHERE id = ?";
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_expense'])) {
    $expense_id_to_delete = $_POST['expense_id'];
    deleteExpense($expense_id_to_delete);
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
        <div class="text">Shpenzimet</div>
        <div class="text">
            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'regjistrimiShpenzimeve')">Regjistruesi i Shpenzimeve</button>
                <button class="tablinks" onclick="openCity(event, 'listaShpenzimeve')">Lista e shpenzimeve</button>
            </div>

            <div id="regjistrimiShpenzimeve" class="tabcontent">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                <h5>Regjistruesi i Shpenzimeve</h5>
                <form method="POST" action="" enctype="multipart/form-data" style="display: flex; flex-direction: column;font-size: 20px">
                    <div>
                        <label for="amount">Shuma:</label>
                        <input type="number" id="amount" name="amount" required>
                    </div>
                    <div>
                        <label for="category">Kategoria:</label>
                        <select id="category" name="category" required>
                            <?php
                            // Retrieve the list of categories from the database
                            $sql = "SELECT * FROM categories";
                            $result = $conn->query($sql);

                            // Loop through the categories and create an option for each one
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="payment_type">Lloji i Pagesës:</label>
                        <select id="payment_type" name="payment_type" required>
                            <option value="Para ne duar">Para ne duar</option>
                            <option value="Kartë Krediti ">Kartë Krediti</option>
                            <option value="Kartë Debiti">Kartë Debiti</option>
                        </select>
                    </div>
                    <div>
                        <label for="receipt">Ngarko faturën (imazh):</label>
                        <input type="file" id="receipt" name="receipt" accept="image/*" required>
                    </div>
                    <div>
                        <button type="submit" style="font-size: 20px; padding: 10px; margin-top: 10px; background-color: white;border: 1px solid transparent;">Shto shpenzim</button>
                    </div>
                </form>
            </div>

            <div id="listaShpenzimeve" class="tabcontent">
                <table>
                    <thead>
                        <tr>
                            <th>Kategoria</th>
                            <th>Lloji i Pagesës</th>
                            <th>Shuma</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        $sql = "SELECT * FROM expenses WHERE client_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $_SESSION['user_id']);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {
                            $category = $row['category'];
                            $payment_type = $row['payment_type'];
                            $amount = $row['amount'];
                        ?>
                            <tr>
                                <td><?php echo $category; ?></td>
                                <td><?php echo $payment_type; ?></td>
                                <td><?php echo $amount; ?></td>
                                <td>
                                    <!-- Add the delete button -->
                                    <form method="POST" action="">
                                        <input type="hidden" name="expense_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_expense" style="background-color: #ff4d4d; color: white; border: none; padding: 5px 10px;">Delete</button>
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
            function openCity(evt, cityName) {
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