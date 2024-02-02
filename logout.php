<?php
// Start the session
session_start();

// Clear all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Ensure that the session cookie is deleted
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Regenerate the session ID to prevent session fixation attacks
session_regenerate_id(true);

// Redirect to the login page
header("Location: login.php");
exit();
