<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regjistruesi i Shpenzimeve - Buxheti</title>
    <link href="https://fonts.cdnfonts.com/css/neue-haas-grotesk-display-pro" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Budget.php */
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }

        label {
            margin-top: 10px;
        }

        input,
        button {
            margin-top: 5px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        /* Responsive layout */
        @media (max-width: 768px) {
            .container {
                max-width: 100%;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <?php
    include 'navbar.php';
    include 'conn.php';

    // Function to calculate total expenses
    function getTotalExpenses($conn)
    {
        $result = $conn->query("SELECT SUM(amount) as total FROM expenses");
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }

    // Function to calculate total income
    function getTotalIncome($conn)
    {
        $result = $conn->query("SELECT SUM(amount) as total FROM income");
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }

    // Process income form
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['income_amount'])) {
        $income_amount = $_POST['income_amount'];
        $sql = "INSERT INTO income (amount) VALUES ('$income_amount')";

        if ($conn->query($sql) === TRUE) {
            // echo "Income added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <div class="container">
        <h2>Regjistruesi i Buxhetit</h2>
        <div>
            <form method="POST" action="">
                <label for="income_amount">Totali i Te Ardhurave:</label>
                <input type="number" id="income_amount" name="income_amount" required>
                <div>
                    <button type="submit">Shto te ardhura</button>
                </div>
            </form>
        </div>

        <div>
            <h2>Shpenzimet</h2>
            <?php
            // Display Expenses
            $result = $conn->query("SELECT * FROM expenses");

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>ID</th><th>Shuma</th><th>Kategoria</th><th>Lloji i Pagesës</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["amount"] . "</td><td>" . $row["category"] . "</td><td>" . $row["payment_type"] . "</td></tr>";
                }

                echo "</table>";
            } else {
                echo "Asnjë shpenzim nuk u gjet.";
            }
            ?>
        </div>

        <div>
            <h2>Te Ardhurat</h2>
            <?php
            // Display Income
            $result = $conn->query("SELECT * FROM income");

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>ID</th><th>Shuma</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["amount"] . "</td></tr>";
                }

                echo "</table>";
            } else {
                echo "Asnjë te ardhur nuk u gjet.";
            }
            ?>
        </div>

        <div>
            <h2>Buxheti</h2>
            <?php
            $totalIncome = getTotalIncome($conn);
            $totalExpenses = getTotalExpenses($conn);
            $budgetSummary = $totalIncome - $totalExpenses;

            echo "<p>Totali i Te Ardhurave: $totalIncome</p>";
            echo "<p>Totali i Shpenzimeve: $totalExpenses</p>";
            echo "<p>Përmbledhja e buxhetit: $budgetSummary</p>";
            ?>
        </div>
        <div class="container">
            <canvas id="budgetChart"></canvas>
        </div>

    </div>

    <?php include 'footer.php'; ?>
    <script>
        // Chart.js
        var ctx = document.getElementById('budgetChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Të ardhurat', 'Shpenzimet'],
                datasets: [{
                    label: 'Statistikat',
                    data: [<?php echo $totalIncome; ?>, <?php echo $totalExpenses; ?>],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(255, 99, 132, 0.7)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
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