<?php
session_start(); // Start the session
include '../conn.php';
// Check if the admin is authenticated
if (!isset($_SESSION['admin_username']) && !isset($_COOKIE['admin_username'])) {
    header("Location: login.php"); // Redirect to login page if not authenticated
    exit();
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
        .flex-container {
            display: flex;
            flex-wrap: wrap;
            font-size: 20px;
            text-align: center;
            margin: 25px;
        }

        .flex-item {
            background-color: #f1f1f1;
            padding: 10px;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
            border: 1px solid #ccc;
            flex: 30.33%;
        }

        /* Responsive layout - makes a one column-layout instead of a three-column layout */
        @media (max-width: 800px) {
            .flex-item {
                flex: 100%;
            }
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <section class="home">
        <h5 class="text">Paneli</h5>
        <div class="flex-container">
            <div class="flex-item">
                <i class='bx bx-user-pin' style="font-size: 50px;"></i>
                <h3 class="text">Përdoruesit</h3>
                <p>
                    <?php
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($conn, $sql);
                    $num_users = mysqli_num_rows($result);
                    echo $num_users;
                    ?>
                </p>
            </div>
            <div class="flex-item">
                <i class='bx bx-bar-chart' style="font-size: 50px;"></i>
                <h3 class="text">Bugjeti Total</h3>
                <p>
                    <?php
                    $sql = "SELECT * FROM income";
                    $result = mysqli_query($conn, $sql);
                    $total_income = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $total_income += $row['amount'];
                    }
                    echo $total_income . ' €';
                    ?>
                </p>
            </div>
            <div class="flex-item">
                <i class='bx bx-grid-alt' style="font-size: 50px;"></i>
                <h3 class="text">Kategorite</h3>
                <p>
                    <?php
                    $sql = "SELECT * FROM categories";
                    $result = mysqli_query($conn, $sql);
                    $num_categories = mysqli_num_rows($result);
                    echo $num_categories;
                    ?>
                </p>
            </div>
        </div>
        <div class="flex-container">
            <div class="flex-item">
                <i class='bx bx-up-arrow' style="font-size: 50px;"></i>
                <h3 class="text">Përdoruesi me të ardhurat më të larta</h3>
                <p>
                    <?php
                    $sql = "SELECT client_id, SUM(amount) AS total_amount
            FROM income
            GROUP BY client_id
            ORDER BY total_amount DESC
            LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $clientId = $row['client_id'];
                        $totalAmount = $row['total_amount'];
                        echo "ID-ja e klientit: $clientId<br>";
                        echo "Shuma totale: $totalAmount €";
                    } else {
                        echo "Gabim në marrjen e të dhënave: " . mysqli_error($conn);
                    }
                    ?>
                </p>
            </div>
            <div class="flex-item">
                <i class='bx bx-money-withdraw' style="font-size: 50px;"></i>
                <h3 class="text">Përdoruesi me shpenzimet me të larta</h3>
                <p>
                    <?php
                    $sql = "SELECT client_id, SUM(amount) AS total_expenses
            FROM expenses
            GROUP BY client_id
            ORDER BY total_expenses DESC
            LIMIT 1";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $clientId = $row['client_id'];
                        $totalExpenses = $row['total_expenses'];

                        echo "ID-ja e klientit: $clientId<br>";
                        echo "Shpenzimet totale: $totalExpenses";
                    } else {
                        echo "Gabim në marrjen e të dhënave: " . mysqli_error($conn);
                    }
                    ?>
                </p>

            </div>
            <div class="flex-item">
                <i class='bx bx-select-multiple' style="font-size: 50px;"></i>
                <h3 class="text">Kategoria me e shfrytezuar</h3>
                <p>
                    <?php
                    $sql = "SELECT category, COUNT(category) AS category_count
            FROM expenses
            GROUP BY category
            ORDER BY category_count DESC
            LIMIT 1";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $categoryId = $row['category'];
                        $categoryCount = $row['category_count'];

                        echo "ID e kategorisë më të përdorur: $categoryId<br>";
                        echo "Numri i përdorimit: $categoryCount";
                    } else {
                        echo "Gabim në marrjen e të dhënave: " . mysqli_error($conn);
                    }
                    ?>
                </p>


            </div>
        </div>
    </section>
    <br><br>
    <?php include 'footer.php'; ?>
    <script src="../script.js"></script>
</body>

</html>