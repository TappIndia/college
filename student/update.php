<?php
// Include database connection
include("../db.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $id      = (int)($_POST['id'] ?? 0);
    $name    = $conn->real_escape_string(trim($_POST['name'] ?? ''));
    $mobile  = $conn->real_escape_string(trim($_POST['mobile'] ?? ''));
    $address = $conn->real_escape_string(trim($_POST['address'] ?? ''));
    $gender  = $conn->real_escape_string(trim($_POST['gender'] ?? ''));
    $dob     = $conn->real_escape_string(trim($_POST['dob'] ?? ''));
    $father  = $conn->real_escape_string(trim($_POST['father'] ?? ''));
    $mother  = $conn->real_escape_string(trim($_POST['mother'] ?? ''));

    // Update query
    $sql = "UPDATE student SET 
            name = '$name', 
            mobile = '$mobile', 
            address = '$address', 
            gender = '$gender', 
            dob = '$dob', 
            father_name = '$father', 
            mother_name = '$mother' 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect after success
        header("Location: table.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>
