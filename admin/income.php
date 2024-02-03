<?php
session_start();
// Include the connection file
include '../conn.php';

class IncomeManagement
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getUserIncome()
    {
        $sql = "SELECT client_id, SUM(amount) AS total_income
                FROM income
                GROUP BY client_id";
        $result = mysqli_query($this->conn, $sql);

        $userIncome = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $userIncome[] = $row;
        }

        return $userIncome;
    }

    public function getUserExpenses()
    {
        $sql = "SELECT client_id, SUM(amount) AS total_expense
                FROM expenses
                GROUP BY client_id";
        $result = mysqli_query($this->conn, $sql);

        $userExpenses = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $userExpenses[] = $row;
        }

        return $userExpenses;
    }
}

// Instantiate the class
$incomeManagement = new IncomeManagement($conn);

// Fetch user income and expenses data
$userIncome = $incomeManagement->getUserIncome();
$userExpenses = $incomeManagement->getUserExpenses();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_admin.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <style>
        /* Add your existing styles here */

        .pdf-button {
            appearance: none;
            background-color: #007bff;
            border: none;
            border-radius: 6px;
            color: #fff;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            padding: 6px 16px;
            margin: 10px 0;
            display: inline-block;
        }

        .pdf-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <section class="home">
        <div class="text">Lista e të ardhurave dhe shpenzimeve</div>
        <div class="text">
            <button class="pdf-button" onclick="generatePDF()">Eksporto në PDF</button>
            <table>
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Total Income</th>
                        <th>Total Expense</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($userIncome as $income): ?>
                        <?php
                        // Find the corresponding expense for the client
                        $matchingExpense = array_values(array_filter($userExpenses, function ($expense) use ($income) {
                            return $expense['client_id'] == $income['client_id'];
                        }));

                        $totalExpense = !empty($matchingExpense) ? $matchingExpense[0]['total_expense'] : 0;
                        ?>
                        <tr>
                            <td>
                                <?php echo $income['client_id']; ?>
                            </td>
                            <td>
                                <?php echo $income['total_income']; ?>
                            </td>
                            <td>
                                <?php echo $totalExpense; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <script src="../script.js"></script>
    <script>
        function generatePDF() {
            var element = document.querySelector('table');
            var opt = {
                margin: 10,
                filename: 'Raporti <?php echo date('Y-m-d') ?>.pdf', // Specify your custom filename here
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            html2pdf(element, opt);
        }
    </script>

</body>

</html>