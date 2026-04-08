<?php
session_start();
// Include database connection
include("../db.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data (with default values)
    $id      = $_POST["id"] ?? 0;
    $name    = $conn->real_escape_string($_POST["name"] ?? '');
    $mobile  = $conn->real_escape_string($_POST["mobile"] ?? '');
    $address = $conn->real_escape_string($_POST["address"] ?? '');
    $gender  = $conn->real_escape_string($_POST["gender"] ?? '');
    $dob     = $conn->real_escape_string($_POST["dob"] ?? '');
    $father  = $conn->real_escape_string($_POST["father"] ?? '');
    $mother  = $conn->real_escape_string($_POST["mother"] ?? '');

    if (empty($mobile)) {
        $_SESSION['message'] = 'Mobile number is required.';
        $_SESSION['message_type'] = 'danger';
        header("Location: add.php");
        exit;
    }

    if (!preg_match('/^\d{10}$/', $mobile)) {
        $_SESSION['message'] = 'Invalid mobile number. It should be exactly 10 digits.';
        $_SESSION['message_type'] = 'danger';
        header("Location: add.php");
        exit;
    }

    if (empty($dob)) {
        $_SESSION['message'] = 'Date of birth is required.';
        $_SESSION['message_type'] = 'danger';
        header("Location: add.php");
        exit;
    }

    $dobDate = DateTime::createFromFormat('Y-m-d', $dob);
    $dobErrors = DateTime::getLastErrors();
    if (!$dobDate || $dobErrors['warning_count'] > 0 || $dobErrors['error_count'] > 0) {
        $_SESSION['message'] = 'Invalid date of birth format. Use YYYY-MM-DD.';
        $_SESSION['message_type'] = 'danger';
        header("Location: add.php");
        exit;
    }

    $today = new DateTime();
    $age = $today->diff($dobDate)->y;

    if ($age < 18) {
        $_SESSION['message'] = 'Student must be at least 18 years old.';
        $_SESSION['message_type'] = 'danger';
        header("Location: add.php");
        exit;
    }

    // SQL insert
    $sql = "INSERT INTO student 
            (id, name, mobile, address, gender, dob, father_name, mother_name) 
            VALUES 
            ($id, '$name', '$mobile', '$address', '$gender', '$dob', '$father', '$mother')";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = 'Student record created successfully.';
        $_SESSION['message_type'] = 'success';
        header("Location: table.php");
        exit;
    } else {
        $_SESSION['message'] = 'Error creating student: ' . $conn->error;
        $_SESSION['message_type'] = 'danger';
        header("Location: table.php");
        exit;
    }
}

// Close connection
$conn->close();
?>