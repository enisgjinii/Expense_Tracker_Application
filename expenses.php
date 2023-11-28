<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista e Shpenzimeve</title>
    <link href="https://fonts.cdnfonts.com/css/neue-haas-grotesk-display-pro" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            animation: fadeIn 1s ease-in-out;
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

        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button.view {
            background-color: #4CAF50;
            color: white;
        }

        button.delete {
            background-color: #f44336;
            color: white;
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

    <?php include 'navbar.php'; ?>
    <?php
    include 'conn.php'; // Assuming you have a file for database connection

    // Display Expenses
    $result = $conn->query("SELECT * FROM expenses");

    if ($result->num_rows > 0) {
    ?>
        <div class="container">
            <h2>Lista e Shpenzimeve</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Shuma</th>
                    <th>Kategoria</th>
                    <th>Lloji i Pagesës</th>
                    <th>Veprimet</th>
                </tr>

                <?php
                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row["id"]; ?></td>
                        <td><?php echo $row["amount"]; ?></td>
                        <td><?php echo $row["category"]; ?></td>
                        <td><?php echo $row["payment_type"]; ?></td>
                        <td>
                            <button class="view" onclick="viewExpense(<?php echo $row['id']; ?>)">Shiko</button>
                            <button class="delete" onclick="deleteExpense(<?php echo $row['id']; ?>)">Fshij</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>

        <script>
            // Function to view expense details
            function viewExpense(expenseId) {
                // Implement the code to view expense details (e.g., using SweetAlert2)
                Swal.fire({
                    title: 'Expense Details',
                    html: `<p>Amount: ${amount}</p>
                           <p>Category: ${category}</p>
                           <p>Payment Type: ${paymentType}</p>
                           <p>Receipt Image: <img src="${receiptPath}" alt="Receipt" style="max-width: 100%;"></p>`,
                    confirmButtonText: 'OK',
                });
            }

            // Function to delete expense
            function deleteExpense(expenseId) {
                // Implement the code to delete expense (e.g., using SweetAlert2 for confirmation)
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform the deletion using PHP (server-side)
                        window.location.href = 'deleteExpense.php?id=' + expenseId;
                    }
                });
            }
        </script>
    <?php
    } else {
        echo "<div class='container'>Asnjë shpenzim nuk u gjet.</div>";
    }
    ?>

</body>

</html>