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
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <!-- Add FavIcon -->
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon">
    <style>
        body {
            font-family: 'Neue Haas Grotesk', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f4f4f4;
        }

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

        th,
        td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 5px;
        }

        button.view {
            background-color: #4CAF50;
            color: white;
        }

        button.edit {
            background-color: #2196F3;
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

        #editForm {
            display: none;
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        #editForm input {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            box-sizing: border-box;
        }

        #editForm button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        #editForm button:hover {
            background-color: #45a049;
        }

        input,
        select,
        button {
            width: auto;
            margin-top: 5px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        /* Responsive styles */
        @media screen and (max-width: 600px) {
            .container {
                width: 90%;
            }

            table {
                font-size: 14px;
            }

            button {
                width: 100%;
                margin-bottom: 10px;
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
            <span> Numri total i shpenzimeve : <?php echo $result->num_rows; ?></span>
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
                            <!-- <button class="view" onclick="viewExpense(<?php echo $row['id']; ?>)"><i class="fa fa-eye"></i></button> -->
                            <button class="edit" onclick="editExpense(<?php echo $row['id']; ?>, '<?php echo $row['amount']; ?>', '<?php echo $row['category']; ?>', '<?php echo $row['payment_type']; ?>')"><i class="fi fi-rr-edit"></i>
                            &nbsp Edito</button>
                            <button class="delete" onclick="deleteExpense(<?php echo $row['id']; ?>)"><i class="fi fi-rr-trash"></i> &nbsp Fshij</button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <form id="editForm" style="display: none;" method="post" action="editExpense.php">
            <input type="hidden" id="editExpenseId" name="expenseId">
            <label for="editAmount">Shuma:</label>
            <input type="text" id="editAmount" name="amount"><br><br>

            <!-- Dropdown for Kategoria -->
            <label for="editCategory"> Kategoria: </label><br>
            <select id="editCategory" name="category">
                <?php
                // Retrieve the list of categories from the database
                $categoryResult = $conn->query("SELECT * FROM categories");

                // Loop through the categories and create an option for each one
                while ($categoryRow = $categoryResult->fetch_assoc()) {
                ?>
                    <option value="<?php echo $categoryRow['name']; ?>"><?php echo $categoryRow['name']; ?></option>
                <?php
                }
                ?>
            </select><br><br>

            <!-- Dropdown for Lloji i Pagesës -->
            <label for="editPaymentType">Lloji i Pagesës:</label> <br>
            <select id="editPaymentType" name="paymentType">
                <option value="Para ne duar">Para ne duar</option>
                <option value="Kartë Krediti">Kartë Krediti</option>
                <!-- <option value="debit_card">Kartë Debiti</option> -->
            </select><br>

            <button type="submit">Ruaj ndryshimet</button>
        </form>

        <script>
            // Function to edit expense details
            function editExpense(expenseId, amount, category, paymentType) {
                // Set the values in the form
                document.getElementById('editExpenseId').value = expenseId;
                document.getElementById('editAmount').value = amount;
                document.getElementById('editCategory').value = category;
                document.getElementById('editPaymentType').value = paymentType;

                // Show the edit form
                document.getElementById('editForm').style.display = 'block';
            }
        </script>

        <script>
            // Function to delete expense
            function deleteExpense(expenseId) {
                // Implement the code to delete expense (e.g., using SweetAlert2 for confirmation)
                Swal.fire({
                    title: 'A je i sigurt?',
                    text: 'Ju nuk do të jeni në gjendje ta ktheni këtë!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Po, fshijeni!'
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
    <?php include 'footer.php'; ?>
</body>

</html>