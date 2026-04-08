<?php
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)($_POST["id"] ?? 0);
    $student_id = (int)($_POST["student_id"] ?? 0);
    $class_id = (int)($_POST["class_id"] ?? 0);
    $admission_date = $conn->real_escape_string(trim($_POST["admission_date"] ?? ''));

    $date_value = !empty($admission_date) ? "'$admission_date'" : "NULL";

    $sql = "INSERT INTO enrollment (id, student_id, class_id, admission_date) 
            VALUES ($id, $student_id, $class_id, $date_value)";

    if ($conn->query($sql) === TRUE) {
        header("Location: table.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
