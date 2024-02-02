<?php

class AlertRenderer
{
    public static function displaySuccess($message)
    {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '$message',
                });
            </script>";
    }

    public static function displayError($message)
    {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '$message',
                });
            </script>";
    }
}

class FileUploader
{
    public static function upload($targetDir)
    {
        $targetFile = $targetDir . basename($_FILES["receipt"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["receipt"]["tmp_name"]);
        if ($check !== false) {
            if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
                AlertRenderer::displayError("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
                $uploadOk = 0;
            }
        } else {
            AlertRenderer::displayError("File is not an image.");
            $uploadOk = 0;
        }

        if ($uploadOk == 1 && move_uploaded_file($_FILES["receipt"]["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            AlertRenderer::displayError("Sorry, there was an error uploading your file.");
            return false;
        }
    }
}

class ExpenseManager
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addExpense($amount, $category, $paymentType, $receiptPath)
    {
        $sql = "INSERT INTO expenses (amount, category, payment_type, receipt_path, client_id) VALUES ('$amount', '$category', '$paymentType', '$receiptPath','$_SESSION[user_id]')";

        if ($this->conn->query($sql) === TRUE) {
            AlertRenderer::displaySuccess("Shpenzimet janë shtuar me sukses.");
        } else {
            AlertRenderer::displayError("Shpenzimet nuk mund të shtoheshin. Ju lutemi provoni përsëri.");
        }
    }

    public function addCategory($newCategory)
    {
        $sql = "INSERT INTO categories (name) VALUES ('$newCategory')";

        if ($this->conn->query($sql) === TRUE) {
            AlertRenderer::displaySuccess("Kategoria është krijuar me sukses.");
        } else {
            AlertRenderer::displayError("Kategoria nuk mund të krijohej. Ju lutemi provoni përsëri.");
        }
    }

    public function deleteExpense($expenseIdToDelete)
    {
        $deleteSql = "DELETE FROM expenses WHERE id = ?";
        $deleteStmt = $this->conn->prepare($deleteSql);
        $deleteStmt->bind_param("i", $expenseIdToDelete);

        if ($deleteStmt->execute()) {
            AlertRenderer::displaySuccess("Expense deleted successfully.");
        } else {
            AlertRenderer::displayError("Error deleting expense. Please try again.");
        }
    }

    public function getTotalExpenses()
    {
        $result = $this->conn->query("SELECT SUM(amount) as total FROM expenses");
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }

    public function getTotalIncome()
    {
        $result = $this->conn->query("SELECT SUM(amount) as total FROM income");
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }
}

session_start();

// Include the connection file
include 'conn.php';

// Check if the user is not logged in
if (empty($_SESSION['user_id'])) {
    // Redirect to the login page
    header('Location: login.php');
    exit();
}

$expenseManager = new ExpenseManager($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['amount'], $_POST['category'], $_POST['payment_type'])) {
        $amount = $_POST['amount'];
        $category = $_POST['category'];
        $paymentType = $_POST['payment_type'];

        $targetDir = "uploads/";
        $receiptPath = FileUploader::upload($targetDir);

        if ($receiptPath) {
            $expenseManager->addExpense($amount, $category, $paymentType, $receiptPath);
        }
    } elseif (isset($_POST['new_category'])) {
        $newCategory = $_POST['new_category'];
        $expenseManager->addCategory($newCategory);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_expense'])) {
    $expenseIdToDelete = $_POST['expense_id'];
    $expenseManager->deleteExpense($expenseIdToDelete);
}

$totalIncome = $expenseManager->getTotalIncome();
$totalExpenses = $expenseManager->getTotalExpenses();
$budgetSummary = $totalIncome - $totalExpenses;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_client.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php include 'sidebar.php'; ?>

    <section class="home">
        <div class="text">Analiza Grafike</div>
        <div class="text">
            <div class="container" style="width: 100%;">
                <canvas id="budgetChart"></canvas>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
    <?php include 'footer.php'; ?>
    <script>
        // Chart.js
        var ctx = document.getElementById('budgetChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Income', 'Expenses'],
                datasets: [{
                    label: 'Statistics',
                    data: [<?= $totalIncome; ?>, <?= $totalExpenses; ?>],
                    backgroundColor: ['rgba(75, 192, 192, 0.7)', 'rgba(255, 99, 132, 0.7)'],
                    borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>