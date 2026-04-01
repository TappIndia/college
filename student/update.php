<?php
// Include database connection
include("../db.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $id      = (int)($_POST['id'] ?? 0);
    $name    = $_POST['name'] ?? '';
    $mobile  = $_POST['mobile'] ?? '';
    $address = $_POST['address'] ?? '';
    $gender  = $_POST['gender'] ?? '';
    $dob     = $_POST['dob'] ?? '';
    $father  = $_POST['father'] ?? '';
    $mother  = $_POST['mother'] ?? '';

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


   
?>
