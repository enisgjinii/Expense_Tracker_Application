<!-- navbar.php -->
<div class="navbar">
    <h2>Paneli i Adminit</h2>
    <?php
    if (isset($_SESSION['admin_username'])) {
        echo "<p class='welcome-message'>Mirësevini, {$_SESSION['admin_username']}!</p>";
    } elseif (isset($_COOKIE['admin_username'])) {
        echo "<p class='welcome-message'>Mirësevini, {$_COOKIE['admin_username']}!</p>";
    }
    ?>
    <a href="logout.php" class="logout-link">Ç'identifikohu</a>
</div>