<?php
include 'conn.php';

$result = $conn->query("SELECT * FROM categories");

if ($result->num_rows > 0) {
    echo "<h2>Categories</h2>";
    echo "<ul>";

    while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row["name"] . "</li>";
    }

    echo "</ul>";
} else {
    echo "No categories found.";
}

$conn->close();
