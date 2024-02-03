<?php
session_start();
include '../conn.php';

// Fetch contact form submissions
$query = "SELECT * FROM contact_submissions";
$result = mysqli_query($conn, $query);

// Function to delete a submission
function deleteSubmission($conn, $submissionId)
{
    $deleteQuery = "DELETE FROM contact_submissions WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $submissionId);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_submission'])) {
    $submissionIdToDelete = $_POST['submission_id'];

    if (deleteSubmission($conn, $submissionIdToDelete)) {
        echo "Submission deleted successfully!";
        // Optionally, you can redirect the user or perform additional actions.
    } else {
        echo "Error deleting submission: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_admin.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .delete_button {
            appearance: none;
            background-color: #FAFBFC;
            border: 1px solid rgba(27, 31, 35, 0.15);
            border-radius: 6px;
            box-shadow: rgba(27, 31, 35, 0.04) 0 1px 0, rgba(255, 255, 255, 0.25) 0 1px 0 inset;
            box-sizing: border-box;
            color: #24292E;
            cursor: pointer;
            display: inline-block;
            font-family: -apple-system, system-ui, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            list-style: none;
            padding: 6px 16px;
            position: relative;
            transition: background-color 0.2s cubic-bezier(0.3, 0, 0.5, 1);
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: middle;
            white-space: nowrap;
            word-wrap: break-word;
        }

        .delete_button:hover {
            background-color: #F3F4F6;
            text-decoration: none;
            transition-duration: 0.1s;
        }

        .delete_button:disabled {
            background-color: #FAFBFC;
            border-color: rgba(27, 31, 35, 0.15);
            color: #959DA5;
            cursor: default;
        }

        .delete_button:active {
            background-color: #EDEFF2;
            box-shadow: rgba(225, 228, 232, 0.2) 0 1px 0 inset;
            transition: none 0s;
        }

        .delete_button:focus {
            outline: 1px transparent;
        }

        .delete_button:before {
            display: none;
        }

        .delete_button:-webkit-details-marker {
            display: none;
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <section class="home">
        <div class="text">
            <h5>Formularët e Kontaktit</h5>

            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Emri</th>
                    <th>Email</th>
                    <th>Mesazhi</th>
                    <th>Data e dorëzimit</th>
                    <th>Veprim</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['message']}</td>";
                    echo "<td>{$row['submission_date']}</td>";
                    echo "<td>
                            <form method='post'>
                                <input type='hidden' name='submission_id' value='{$row['id']}'>
                                <button class='delete_button' type='submit' name='delete_submission' onclick=\"return confirm('A jeni i sigurtë që dëshironi të fshini këtë regjistrim?')\">Fshij</button>
                            </form>
                        </td>";
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