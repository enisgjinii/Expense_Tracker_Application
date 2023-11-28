<?php
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_category = $_POST['new_category'];

    $sql = "INSERT INTO categories (name) VALUES ('$new_category')";

    if ($conn->query($sql) === TRUE) {
        echo "Category created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
