<?php session_start(); ?>
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

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
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
    </style>
</head>

<body>

    <div class="sidenav">
        <img src="assets/logo.png" alt="">
        <a href="#about">Paneli</a>
        <a href="#services">Transaksionet</a>
        <a href="#clients">Kategoritë</a>
        <a href="#clients">Buxheti</a>
        <a href="#clients">Raportet</a>
        <a href="#clients">Cilësimet</a>
        <a href="#clients">Profili</a>
        <br>
        <br><br>
        <a id="logout" href="logout.php">Dilni</a>
    </div>

    <!-- Make a navbar -->


    <div class="main">
        <div class="topnav">
            <a href="#home">Home
            </a>
            <a href="#news">News</a>
            <a href="#contact">Contact</a>
            <div class="dropdown">
                <button class="dropbtn">Dropdown
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                </div>
            </div>
            <a href="#about" class="split"><?php
                                            echo $_SESSION['email'] ?></a>
        </div>
        <div class="card-container">
            <div class="card">
                <div class="container">

                    <p>Balanci</p>
                    <h2><b>535.84 €</b></h2>
                </div>
            </div>

            <div class="card">
                <div class="container">

                    <p>Shpenzimet</p>
                    <h2><b>6516.50 €</b></h2>
                </div>
            </div>
        </div>

        <table id="customers">
            <tr>
                <th>Company</th>
                <th>Contact</th>
                <th>Country</th>
            </tr>
            <tr>
                <td>Alfreds Futterkiste</td>
                <td>Maria Anders</td>
                <td>Germany</td>
            </tr>
            <tr>
                <td>Berglunds snabbköp</td>
                <td>Christina Berglund</td>
                <td>Sweden</td>
            </tr>
            <tr>
                <td>Centro comercial Moctezuma</td>
                <td>Francisco Chang</td>
                <td>Mexico</td>
            </tr>
            <tr>
                <td>Ernst Handel</td>
                <td>Roland Mendel</td>
                <td>Austria</td>
            </tr>
            <tr>
                <td>Island Trading</td>
                <td>Helen Bennett</td>
                <td>UK</td>
            </tr>
            <tr>
                <td>Königlich Essen</td>
                <td>Philip Cramer</td>
                <td>Germany</td>
            </tr>
            <tr>
                <td>Laughing Bacchus Winecellars</td>
                <td>Yoshi Tannamuri</td>
                <td>Canada</td>
            </tr>
            <tr>
                <td>Magazzini Alimentari Riuniti</td>
                <td>Giovanni Rovelli</td>
                <td>Italy</td>
            </tr>
            <tr>
                <td>North/South</td>
                <td>Simon Crowther</td>
                <td>UK</td>
            </tr>
            <tr>
                <td>Paris spécialités</td>
                <td>Marie Bertrand</td>
                <td>France</td>
            </tr>
        </table>

        <footer>
            <div class="footer-content">
                <p>&copy; 2023 Your Website Name. All Rights Reserved.</p>
                <ul class="footer-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </footer>
    </div>



</body>

</html>