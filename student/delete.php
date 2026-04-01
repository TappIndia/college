<?php
// Include database connection
include("../db.php");

// Get ID from URL and sanitize
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    // Prepare and execute delete query
    $sql = "DELETE FROM student WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect after success
        header("Location: table.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid ID";
}

// Close connection
$conn->close();
?>
