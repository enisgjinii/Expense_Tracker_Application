<?php
session_start(); // Start the session
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
    <script src="../script.js"></script>
</body>

</html>