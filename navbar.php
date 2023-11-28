<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>


<div class="topnav" id="myTopnav">
    <a href="home.php">Shtëpia</a>
    <a href="budget.php">Bugjeti</a>
    <a href="expenses.php">Shpenzimet</a>
    <a href="#about">Profili</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>
</div>

<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>