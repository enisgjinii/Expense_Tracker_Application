<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regjistruesi i Shpenzimeve - Kryefaqja</title>
    <link href="https://fonts.cdnfonts.com/css/neue-haas-grotesk-display-pro" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .container {
            max-width: 800px;
            margin: 25px auto;
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
        select,
        button {
            margin-top: 5px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        /* file upload button */
        input[type="file"]::file-selector-button {
            border-radius: 4px;
            padding: 0 16px;
            height: 40px;
            cursor: pointer;
            background-color: white;
            border: 1px solid rgba(0, 0, 0, 0.16);
            box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.05);
            margin-right: 16px;
            transition: background-color 200ms;
        }

        /* file upload button hover state */
        input[type="file"]::file-selector-button:hover {
            background-color: #f3f4f6;
        }

        /* file upload button active state */
        input[type="file"]::file-selector-button:active {
            background-color: #e5e7eb;
        }

        /* ------------------------ */
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

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 5px;
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
    include 'conn.php'; // Assuming you have a file for database connection

    // Process expense form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['amount'], $_POST['category'], $_POST['payment_type'])) {
            $amount = $_POST['amount'];
            $category = $_POST['category'];
            $payment_type = $_POST['payment_type'];

            // File upload handling
            $target_dir = "uploads/"; // Create a directory called "uploads" to store the images
            $target_file = $target_dir . basename($_FILES["receipt"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if the image file is a actual image or fake image
            $check = getimagesize($_FILES["receipt"]["tmp_name"]);
            if ($check !== false) {
                // Allow only certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["receipt"]["tmp_name"], $target_file)) {
                    // File uploaded successfully, now insert data into the database
                    $sql = "INSERT INTO expenses (amount, category, payment_type, receipt_path) VALUES ('$amount', '$category', '$payment_type', '$target_file')";

                    if ($conn->query($sql) === TRUE) {
                        // Display success alert using SweetAlert2
                        echo "<script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: 'Shpenzimet janë shtuar me sukses.',
                                });
                             </script>";
                    } else {
                        // Display error alert using SweetAlert2
                        echo "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'Shpenzimet nuk mund të shtoheshin. Ju lutemi provoni përsëri.',
                                });
                             </script>";
                    }
                } else {
                    // Display error alert using SweetAlert2
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Sorry, there was an error uploading your file.',
                            });
                         </script>";
                }
            }
        } elseif (isset($_POST['new_category'])) {
            // Process category form
            $new_category = $_POST['new_category'];

            $sql = "INSERT INTO categories (name) VALUES ('$new_category')";

            if ($conn->query($sql) === TRUE) {
                // Display success alert using SweetAlert2
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Kategoria është krijuar me sukses.',
                        });
                     </script>";
            } else {
                // Display error alert using SweetAlert2
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Kategoria nuk mund të krijohej. Ju lutemi provoni përsëri.',
                        });
                     </script>";
            }
        }
    }
    ?>

    <div class="container">
        <div class="column">
            <h2>Regjistruesi i Shpenzimeve</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <label for="amount">Shuma:</label>
                <input type="number" id="amount" name="amount" required>

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

                <label for="payment_type">Lloji i Pagesës:</label>
                <select id="payment_type" name="payment_type" required>
                    <option value="cash">Gjendje</option>
                    <option value="credit_card">Kartë Krediti</option>
                    <option value="debit_card">Kartë Debiti</option>
                </select>

               
                <label for="receipt">Ngarko faturën (imazh):</label>
                <br><br><br>
                <input type="file" id="receipt" name="receipt" accept="image/*" required>

                <div>
                    <button type="submit">Shto shpenzim</button>
                </div>
            </form>
        </div>

        <div class="column">
            <h2>Krijo Kategori të Re</h2>
            <form method="POST" action="">
                <label for="new_category">Emri i Kategorisë:</label>
                <input type="text" id="new_category" name="new_category" required>
                <div>
                    <button type="submit">Krijo Kategori</button>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="column">
            <?php
            // Display Expenses
            $result = $conn->query("SELECT * FROM expenses");

            if ($result->num_rows > 0) {
                echo "<h2>Shpenzimet</h2>";
                echo "<table>";
                echo "<tr><th>ID</th><th>Shuma</th><th>Kategoria</th><th>Lloji i Pagesës</th><th>Fatura</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["amount"] . "</td><td>" . $row["category"] . "</td><td>" . $row["payment_type"] . "</td><td><a style='border: none;text-decoration: none ; color: black;padding: 5px;border-radius: 5px;
                background-color: white   ;border: 1px solid #ccc;box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);' href='" . $row["receipt_path"] . "' target='_blank'>Shiko Faturën</a></td></tr>";
                }

                echo "</table>";
            } else {
                echo "Asnjë shpenzim nuk u gjet.";
            }

            // Display Categories
            $result = $conn->query("SELECT * FROM categories");

            if ($result->num_rows > 0) {
                echo "<h2>Kategoritë</h2>";
                echo "<table>";
                echo "<tr><th>ID</th><th>Emri</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td></tr>";
                }

                echo "</table>";
            } else {
                echo "Asnjë kategori nuk u gjet.";
            }
            ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>