<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'conn.php';

// Check if the form is submitted for email update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateEmail'])) {
    $newEmail = $_POST['newEmail'];
    $userId = $_SESSION['user_id'];

    // Update the user's email in the database
    $updateEmailQuery = "UPDATE users SET email = '$newEmail' WHERE id = $userId";
    if (mysqli_query($conn, $updateEmailQuery)) {
        // Email updated successfully
        echo '<script>alert("Email updated successfully.");</script>';
    } else {
        // Error updating email
        echo '<script>alert("Error updating email. Please try again.");</script>';
    }
}
// Kontrolloj se forma është dorëzuar për përditësimin e fjalëkalimit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updatePassword'])) {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];
    $userId = $_SESSION['user_id'];

    // Kontrolloj nqs fjalëkalimi i vjetër është i saktë
    $checkPasswordQuery = "SELECT password_hash FROM users WHERE id = $userId";
    $result = mysqli_query($conn, $checkPasswordQuery);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $hashedPassword = $row['password_hash'];

        if (password_verify($oldPassword, $hashedPassword)) {
            // Fjalëkalimi i vjetër është i saktë, përditësoj fjalëkalimin
            if ($newPassword == $confirmNewPassword) {
                $hashedNewPassword = password_hash($newPassword, PASSWORD_ARGON2I);
                $updatePasswordQuery = "UPDATE users SET password_hash = '$hashedNewPassword' WHERE id = $userId";
                mysqli_query($conn, $updatePasswordQuery);

                // Fjalëkalimi përditësuar me sukses, njoftim dhe logout
                echo '<script>alert("Fjalëkalimi u përditësua me sukses. Ju lutem dilni dhe hyni me fjalëkalimin e ri.");</script>';
                // Rregullo redirektimin sipas logout ose veprimeve të logout
                header("Location: logout.php");
                exit();
            } else {
                // Fjalëkalimet e reja nuk përputhen
                echo '<script>alert("Fjalëkalimet e reja nuk përputhen. Ju lutem provoni përsëri.");</script>';
            }
        } else {
            // Fjalëkalimi i vjetër është i pasaktë
            echo '<script>alert("Fjalëkalim i pasaktë. Ju lutem provoni përsëri.");</script>';
        }
    } else {
        // Gabim në kontrollin e fjalëkalimit të vjetër
        echo '<script>alert("Gabim në verifikimin e fjalëkalimit të vjetër. Ju lutem provoni përsëri.");</script>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Open Sans', sans-serif;
        }

        .sidenav {
            height: 95%;
            margin: 10px;
            width: 160px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            border: 1px solid lightgrey;
            border-radius: 15px;
            overflow-x: hidden;
            padding-top: 20px;
        }



        .sidenav img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
            margin-bottom: 50px;

        }

        .sidenav a {
            padding: 6px 8px 6px 16px;
            margin-bottom: 25px;
            text-decoration: none;
            text-align: center;
            font-size: 18px;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
            background-color: #1ED2E7;
        }

        #logout {
            padding: 6px 8px 6px 16px;
            margin-bottom: 25px;
            text-decoration: none;
            text-align: center;
            font-size: 18px;
            display: block;
            transition: 0.3s;
            border-radius: 5px;
            margin-left: 5px;
            margin-right: 5px;
            background-color: #1ED2E7;
            cursor: pointer;

        }

        .main {
            margin-left: 160px;
            padding: 0px 10px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }

        /* Create a top navigation bar with a black background color  */
        .topnav {
            border: 1px solid lightgrey;
            height: 50px;
            border-radius: 15px;
            overflow: hidden;

        }

        /* Style the links inside the navigation bar */
        .topnav a {
            float: left;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        /* Change the color of links on hover */
        .topnav a:hover {
            color: black;

        }

        /* Create a right-aligned (split) link inside the navigation bar */
        .topnav a.split {
            float: right;
            background-color: #04AA6D;
            color: white;
        }

        .card-container {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            /* Adjust as needed */
        }

        .card {
            width: 48%;
            /* Adjust as needed */
            box-sizing: border-box;
            border: 1px solid #ddd;
            /* Add border for better visualization */
            margin: 5px;
            text-align: center;
            border-radius: 15px;
            /* Add margin for spacing */
        }

        .container {
            padding: 16px;
        }

        table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        table td,
        table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #1ED2E7;
            color: white;
        }


        .dropdown {
            float: left;
            overflow: hidden;
        }

        .dropdown .dropbtn {
            font-size: 16px;
            border: none;
            outline: none;
            color: black;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }

        .navbar a:hover,
        .dropdown:hover .dropbtn {
            background-color: red;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            background-color: white;
            display: inline-block;
            margin: 5px;
            position: relative;
        }

        .tab button {
            background-color: inherit;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
            border-radius: 5px;
        }

        .tab button:hover {
            background-color: #ddd;
        }

        .tab button.active {
            background-color: #1ED2E7;
            color: white;
            border-radius: 15px;
        }

        #trackingBox {
            position: fixed;
            width: 50px;
            height: 50px;
            background-color: #333;
            color: #fff;
            text-align: center;
            line-height: 50px;
            border-radius: 10px;
            display: none;
            transition: 0.3s;
            pointer-events: none;
            /* Allows clicking through the tracking box */
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin: 5px;
        }

        .tabcontent form {
            max-width: 300px;
            text-align: left;
        }

        .tabcontent label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .tabcontent input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .tabcontent button {
            background-color: #1ED2E7;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .tabcontent button:hover {
            background-color: #1ED2E7;
            opacity: 0.8;
        }

        /* Fade in tabs */
        @-webkit-keyframes fadeEffect {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeEffect {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* CSS */
        .action_buttons {
            background-color: #fff;
            border: 1px solid #d5d9d9;
            border-radius: 8px;
            box-shadow: rgba(213, 217, 217, .5) 0 2px 5px 0;
            box-sizing: border-box;
            color: #0f1111;
            cursor: pointer;
            display: inline-block;
            font-family: "Amazon Ember", sans-serif;
            font-size: 13px;
            line-height: 29px;
            padding: 0 10px 0 11px;
            position: relative;
            text-align: center;
            text-decoration: none;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: middle;
            width: 100px;
        }

        .action_buttons:hover {
            background-color: #f7fafa;
        }

        .action_buttons:focus {
            border-color: #008296;
            box-shadow: rgba(213, 217, 217, .5) 0 2px 5px 0;
            outline: 0;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            border-radius: 15px;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 80%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

        @keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

        /* The Close Button */
        .close {
            color: white;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header {
            padding: 2px 16px;
            background-color: #1ED2E7;
            color: white;
        }

        .modal-body {
            margin-top: 15px;
            margin-bottom: 15px;

            padding: 2px 16px;
        }

        .modal-footer {
            padding: 2px 16px;
            background-color: #1ED2E7;
            color: white;
        }

        #updateCategoryBtn {
            background-color: #1ED2E7;
            color: white;
            border-radius: 5px;
            border: none;
            padding: 5px;
            cursor: pointer;

        }
    </style>
</head>

<body>

    <?php include 'sidebar.php'; ?>

    <div class="main">
        <?php include 'navbar.php'; ?>


        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'Preferencat e profilit')">Preferencat e profilit</button>
            <button class="tablinks" onclick="openTab(event, 'Siguria')">Siguria</button>
        </div>
        <div id="Preferencat e profilit" class="tabcontent">
            <h3>Preferencat e profilit</h3>
            <hr>
            <form method="POST" action="">
                <div class="container">
                    <label for="email"><b>Email:</b></label>
                    <input type="text" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" readonly>

                    <label for="newEmail"><b>Email i ri:</b></label>
                    <input type="text" id="newEmail" name="newEmail" required>

                    <button type="submit" name="updateEmail">Përditëso emailin</button>
                </div>
            </form>
        </div>
        <div id="Siguria" class="tabcontent">
            <h3>Siguria</h3>
            <hr>
            <form method="POST" action="">
                <div class="container">
                    <label for="oldPassword"><b>Fjalëkalimi i vjetër:</b></label>
                    <input type="password" id="oldPassword" name="oldPassword" required>

                    <label for="newPassword"><b>Fjalëkalim i ri:</b></label>
                    <input type="password" id="newPassword" name="newPassword" required>

                    <label for="confirmNewPassword"><b>Konfirmo fjalëkalimin e ri:</b></label>
                    <input type="password" id="confirmNewPassword" name="confirmNewPassword" required>

                    <button type="submit" name="updatePassword">Përditëso fjalëkalimin</button>
                </div>
            </form>
        </div>




        <!-- <?php include 'footer.php' ?> -->
    </div>



    <script>
        function openTab(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }

        function deleteCategory(categoryId) {
            // You can use JavaScript to confirm the deletion
            var confirmDelete = confirm("Are you sure you want to delete this category?");
            if (confirmDelete) {
                // Redirect to delete_category.php or handle deletion via AJAX
                window.location.href = 'delete_category.php?id=' + categoryId;
            }
        }
    </script>
</body>

</html>