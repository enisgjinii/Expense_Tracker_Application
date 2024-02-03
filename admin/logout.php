<?php
// Fillo sesionin
session_start();

// Zhduk te gjitha variablat e sesionit
$_SESSION = array();

// Shkatërro sesionin
session_destroy();

// Fshij të gjitha cookies lidhur me sesionin
setcookie("PHPSESSID", "", time() - 3600, "/");
setcookie("username", "", time() - 3600, "/");
setcookie("password", "", time() - 3600, "/");
setcookie("admin_username","", time() - 0, "/");

// Ridrejto tek faqja e login ose ndonjë faqe tjetër pas çlirimit
header("Location: login.php");
exit;
?>
