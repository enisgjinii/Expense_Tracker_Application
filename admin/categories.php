<?php
session_start();
include '../conn.php';

class MenaxheriIKategorive
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function shtoKategori($emriKategorise)
    {
        $insertQuery = "INSERT INTO categories (name) VALUES (?)";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bind_param("s", $emriKategorise);

        return $stmt->execute();
    }

    public function merrKategorite()
    {
        $selectQuery = "SELECT id, name FROM categories";
        $rezultati = $this->conn->query($selectQuery);

        $kategorite = [];
        while ($rreshti = $rezultati->fetch_assoc()) {
            $kategorite[] = $rreshti;
        }

        return $kategorite;
    }
}

$emriKategorise = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emriKategorise = isset($_POST['emri_kategorise']) ? $_POST['emri_kategorise'] : '';

    $menaxheriIKategorive = new MenaxheriIKategorive($conn);

    if ($menaxheriIKategorive->shtoKategori($emriKategorise)) {
        echo "Kategoria u shtua me sukses!";
    } else {
        echo "Gabim në shtimin e kategorisë: " . $conn->error;
    }
}

// Initialize $menaxheriIKategorive outside of the POST condition
$menaxheriIKategorive = new MenaxheriIKategorive($conn);
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
        /* Shtoni stilizimet tuaja CSS ekzistuese këtu */

        /* Stili për konteinerin e formës */
        .form-container {
            max-width: 500px;
            margin: auto;
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Stili për hyrjet e formës */
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

        /* Stili për butonin e paraqitjes */
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

        /* Stili për tabelën */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <section class="home">
        <h5 class="text">Shto kategori të re</h5>
        <hr>
        <div class="text">
            <div class="container form-container">
                <form method="post" style="font-size: 20px">
                    <div class="form-group">
                        <label for="emri_kategorise">Emri i Kategorisë:</label>
                        <input type="text" id="emri_kategorise" name="emri_kategorise" value="<?php echo htmlspecialchars($emriKategorise); ?>" required>
                    </div>
                    <br>
                    <input type="submit" value="Shto Kategorinë" class="edit_button">
                </form>
            </div>
        </div>

        <h5 class="text">Lista e Kategorive</h5>
        <!-- Paraqisni tabelën e Kategorive -->
        <div class="text">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Emri</th>
                </tr>
                <?php
                $kategorite = $menaxheriIKategorive->merrKategorite();
                foreach ($kategorite as $kategoria) {
                    echo "<tr>";
                    echo "<td>" . $kategoria['id'] . "</td>";
                    echo "<td>" . $kategoria['name'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </section>
    <?php include 'footer.php'; ?>
    <script src="../script.js"></script>
</body>


</html>