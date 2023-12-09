<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Eksploroni dhe menaxhoni shpenzimet tuaja me aplikacionin tonë inovativ të shpenzimeve.">
    <title>Expense Tracker - Your Expense App</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <?php include 'navbar.php'; ?>

    <!-- Image Slider -->
    <section id="slider">
        <div class="slider-container">
            <div id="kontenti">
                <header>
                    <img id="slideshow" style="width:250px; object-fit: contain; height: 250px;" />
                </header>
                <br>
                <button onclick="changeImg(-1)">Prapa</button>
                <button onclick="changeImg(1)">Para</button>
            </div>
        </div>
    </section>

    <section id="expense">
        <h2>Expense Tracker</h2>
        <p>Eksploroni dhe menaxhoni shpenzimet tuaja me aplikacionin tonë inovativ të shpenzimeve.</p>

        <!-- Key Features Section -->
        <section id="features">
            <h3>Veçoritë Kryesore</h3>
            <ul>
                <li>Gjurmimi intuitiv i shpenzimeve</li>
                <li>Buxhetimi i personalizuar</li>
                <li>Raporte financiare detajuar</li>
                <li>Vendosja dhe arritja e qëllimeve</li>
            </ul>
        </section>

        <!-- Download Section -->
        <section id="download">
            <h3>Shkarkoni Aplikacionin</h3>
            <p>Merrni kontrollin e financave tuaja. Shkarkoni aplikacionin tonë të shpenzimeve sot!</p>
            <p>Disponueshëm në:</p>
            <ul>
                <li><a href="#">App Store</a></li>
                <li><a href="#">Google Play</a></li>
            </ul>
        </section>

        <!-- Testimonials Section -->
        <section id="testimonials">
            <h3>Çfarë Përdoruesit Thonë</h3>
            <div class="testimonial">
                <p>"Aplikacioni Juaj i Shpenzimeve ka bërë menaxhimin e financave të lehtë. Rekomandohet shumë!"</p>
                <p>- Jane Doe</p>
            </div>
            <div class="testimonial">
                <p>"E dua veçorinë e buxhetimit. Më ka ndihmuar të kursaroj para dhe të arrij qëllimet e mia financiare."</p>
                <p>- John Smith</p>
            </div>
        </section>

        <!-- Additional Sections -->
        <section id="additional-section">
            <h2>Seksione Shtesë</h2>
            <p>Këtu mund të shtoni informacione shtesë për aplikacionin tuaj të shpenzimeve.</p>
            <!-- Add more content as needed -->
        </section>

    </section>

    <footer>
        <p>&copy; 2023 Kompania Juaj. Të gjitha të drejtat e rezervuara.</p>
    </footer>

    <script src="js/script.js"></script>
    <script>
        let i = 0;
        let imgArray = ["assets/logo.png", "assets/jonas-verstuyft-Pp6efQ_ghiA-unsplash.jpg", "assets/logo.png", "assets/logo.png"];
        let slideshow = document.getElementById("slideshow");

        function changeImg(direction) {
            i += direction;

            if (i < 0) {
                i = imgArray.length - 1;
            } else if (i >= imgArray.length) {
                i = 0;
            }

            slideshow.src = imgArray[i];
        }

        // Initial call to display the first image
        document.addEventListener('DOMContentLoaded', function() {
            changeImg(0);
        });
    </script>
</body>

</html>