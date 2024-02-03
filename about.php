<?php
include 'conn.php';

// Fetch company information from the database
$selectQuery = "SELECT * FROM company_info WHERE id = 1"; // Assuming there is only one row in the table
$result = mysqli_query($conn, $selectQuery);
$row = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mësoni më shumë për kompaninë tonë dhe çfarë na bën të veçantë.">
    <title>Rreth Nesh - Aplikacioni Juaj i Shpenzimeve</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <section id="about">
        <h2>Rreth Nesh</h2>
        <p><strong>Emri i Kompanisë:</strong> <?php echo htmlspecialchars($row['company_name']); ?></p>
        <p><strong>Adresa:</strong> <?php echo htmlspecialchars($row['address']); ?></p>
        <p><strong>Numri i Telefonit:</strong> <?php echo htmlspecialchars($row['phone_number']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
        <p><strong>Website:</strong> <a href="<?php echo htmlspecialchars($row['website']); ?>" target="_blank"><?php echo htmlspecialchars($row['website']); ?></a></p>
        <p><strong>Informata mbi ne:</strong> <?php echo htmlspecialchars($row['about_us_text']); ?></p>
    </section>
    <section id="mission">
        <h2>Misioni ynë</h2>
        <?php echo isset($row['mission_text']) ? '<p>' . htmlspecialchars($row['mission_text']) . '</p>' : '<p>No mission text available.</p>'; ?>
    </section>

    <footer>
        <p>&copy; 2023 Expense Tracker. Të gjitha të drejtat e rezervuara.</p>
    </footer>

    <script src="js/script.js"></script>
</body>

</html>