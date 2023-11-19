<?php
// Include your database connection code here
require_once 'conn.php';

if (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];

    // Perform a database query to fetch category details based on the ID
    // Replace this with your actual database query
    $sql = "SELECT * FROM categories WHERE id = $categoryId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $categoryDetails = mysqli_fetch_assoc($result);

        // Return the category details as JSON
        header('Content-Type: application/json');
        echo json_encode($categoryDetails);
        exit();
    }
}

// Return an error if category details couldn't be fetched
header("HTTP/1.1 500 Internal Server Error");
exit();
?>
