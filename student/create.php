<?php
// Include database connection
include("../db.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data (with default values)
    $id      = $_POST["id"] ?? 0;
    $name    = $_POST["name"] ?? '';
    $mobile  = $_POST["mobile"] ?? '';
    $address = $_POST["address"] ?? '';
    $gender  = $_POST["gender"] ?? '';
    $dob     = $_POST["dob"] ?? '';
    $father  = $_POST["father"] ?? '';
    $mother  = $_POST["mother"] ?? '';

    // Your SQL method (corrected formatting)
    $sql = "INSERT INTO student 
            (id, name, mobile, address, gender, dob, father_name, mother_name) 
            VALUES 
            ($id, '$name', '$mobile', '$address', '$gender', '$dob', '$father', '$mother')";

    // Execute query
    if ($conn->query($sql) === TRUE) {

        // Redirect after success (NO echo before this)
        header("Location: table.php");
        exit;

    } else {
        // Show error if query fails
        echo "Error: " . $conn->error;
    }
}

// Close connection
$conn->close();
?>