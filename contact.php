<!DOCTYPE html>
<html lang="sq">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Na kontaktoni. Do të donim të dëgjojmë nga ju!">
    <title>Kontaktoni - Aplikacioni Juaj i Shpenzimeve</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <section id="contact">
        <h2>Kontaktoni</h2>
        <p>Na kontaktoni. Do të donim të dëgjojmë nga ju!</p>

        <!-- Formulari i Kontaktit -->
        <form action="submit_contact.php" method="post">
            <label for="name">Emri:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Mesazhi:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit">Dërgo</button>
        </form>

        <!-- Informacioni Shtesë i Kontaktit -->
        <div class="contact-info">
            <h3>Zyra Jonë</h3>
            <p>123 Rruga Kryesore, Qytetvilje</p>
            <p>Shteti</p>

            <h3>Email</h3>
            <p>info@yourexpenseapp.com</p>

            <h3>Telefoni</h3>
            <p>+1 (123) 456-7890</p>
        </div>
    </section>

    <footer>
        <p>&copy; 2023 Kompania Juaj. Të gjitha të drejtat e rezervuara.</p>
    </footer>

    <script src="js/script.js"></script>
</body>

</html>