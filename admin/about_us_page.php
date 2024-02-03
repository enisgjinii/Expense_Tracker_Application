<?php
session_start();
include '../conn.php';

class CompanyInfoUpdater
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function updateCompanyInfo($companyName, $address, $phoneNumber, $email, $website, $aboutUsText)
    {
        $updateQuery = "UPDATE company_info SET company_name = ?, address = ?, phone_number = ?, email = ?, website = ?, about_us_text = ? WHERE id = 1"; // Assuming there is only one row in the table
        $stmt = $this->conn->prepare($updateQuery);
        $stmt->bind_param("ssssss", $companyName, $address, $phoneNumber, $email, $website, $aboutUsText);

        return $stmt->execute();
    }
}

$companyName = $address = $phoneNumber = $email = $website = $aboutUsText = ''; // Initialize variables

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $companyName = isset($_POST['company_name']) ? $_POST['company_name'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $phoneNumber = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $website = isset($_POST['website']) ? $_POST['website'] : '';
    $aboutUsText = isset($_POST['about_us_text']) ? $_POST['about_us_text'] : '';

    $companyInfoUpdater = new CompanyInfoUpdater($conn);

    if ($companyInfoUpdater->updateCompanyInfo($companyName, $address, $phoneNumber, $email, $website, $aboutUsText)) {
        echo "Company information updated successfully!";
        // Optionally, you can redirect the user to the about_us.php page.
    } else {
        echo "Error updating company information: " . $conn->error;
    }
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
        /* Add your existing CSS styles here */

        /* Style for form container */
        .form-container {
            max-width: 500px;
            margin: auto;
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Style for form inputs */
        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 5px;
        }

        textarea {
            resize: vertical;
        }

        /* Style for submit button */
        .edit_button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .edit_button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <section class="home">
        <h5 class="text">Edito faqen për informatat e kompanisë</h5>
        <hr>
        <div class="text">
            <div class="container form-container">
                <form method="post" style="font-size: 20px">
                    <div class="form-group">
                        <label for="company_name">Emri i Kompanisë:</label>
                        <input type="text" id="company_name" name="company_name" value="<?php echo htmlspecialchars($companyName); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Adresa:</label>
                        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="phone_number">Numri i Telefonit:</label>
                        <input type="text" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($phoneNumber); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="website">Website:</label>
                        <input type="text" id="website" name="website" value="<?php echo htmlspecialchars($website); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="about_us_text">Informata mbi ne:</label>
                        <textarea id="about_us_text" name="about_us_text" rows="6"><?php echo htmlspecialchars($aboutUsText); ?></textarea>
                    </div>
                    <br>
                    <input type="submit" value="Edito" class="edit_button">
                </form>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="../script.js"></script>
</body>

</html>