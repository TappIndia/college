<?php
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)($_POST['id'] ?? 0);
    $student_id = (int)($_POST['student_id'] ?? 0);
    $class_id = (int)($_POST['class_id'] ?? 0);
    $admission_date = $conn->real_escape_string(trim($_POST['admission_date'] ?? ''));

    $date_value = !empty($admission_date) ? "'$admission_date'" : "NULL";

    $sql = "UPDATE enrollment SET 
            student_id = $student_id, 
            class_id = $class_id, 
            admission_date = $date_value 
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: table.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
