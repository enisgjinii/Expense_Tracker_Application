<!DOCTYPE html>
<html>

<head>
    <title>Faqja e Regjistrimit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.cdnfonts.com/css/neue-haas-grotesk-display-pro" rel="stylesheet">
    <style>
        * {
            font-family: 'Neue Haas Grotesk Display Pro', sans-serif;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 400px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
        }

        .container input[type="text"],
        .container input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 10px;
        }

        .container button {
            background-color: #1ED2E7;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
        }

        .container button:hover {
            background-color: #1bbdcf;
        }

        @media (max-width: 600px) {
            .container {
                max-width: none;
            }
        }

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
    </style>
</head>

<body>
    <div class="container">
        <h2>Regjistrohu</h2>
        <form method="POST" action="" enctype="multipart/form-data" onsubmit="return validateForm()">

            <label for="email">Adresa e email-it</label>
            <input type="text" id="email" name="email" placeholder="Shkruani adresen tuaj" required>

            <label for="password">Fjalëkalimi</label>
            <input type="password" id="password" name="password" placeholder="Shkruani fjalëkalimin tuaj" required>

            <label for="profile_pic">Ngarko foton e profilit</label>
            <input type="file" id="profile_pic" name="profile_pic" accept="image/*">

            <button type="submit">Regjistrohu</button>
            <p style="text-align: right; cursor:pointer" type="button" onclick="window.location.href = 'login.php';">Kyçu</p>
        </form>
    </div>

    <script>
        function validateForm() {
            // Validate email
            let emailInput = document.getElementById('email');
            let emailRegex = /[a-zA-Z.-_]+@+[a-z]+\.+[a-z]{2,3}$/;
            if (!emailRegex.test(emailInput.value)) {
                alert('Email i pavlefshëm');
                return false;
            }

            // Validate password
            let passwordInput = document.getElementById('password');
            if (passwordInput.value.length < 6) {
                alert('Fjalëkalimi duhet të jetë të paktën 6 karaktere');
                return false;
            }

            // Validate profile picture (optional)
            let profilePicInput = document.getElementById('profile_pic');
            if (profilePicInput.value) {
                let allowedFormats = ["jpg", "jpeg", "png", "gif"];
                let fileExtension = profilePicInput.value.split('.').pop().toLowerCase();
                if (!allowedFormats.includes(fileExtension)) {
                    alert('Format i pavlefshëm i skedarit. Formate të lejuara: JPG, JPEG, PNG, GIF');
                    return false;
                }
            }

            // Form is valid
            alert('Forma është e vlefshme');
        }
    </script>
</body>

</html>