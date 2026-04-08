<?php
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)($_POST["id"] ?? 0);
    $subject_name = $conn->real_escape_string(trim($_POST["subject_name"] ?? ''));
    $course_id = (int)($_POST["course_id"] ?? 0);
    $teacher_id = isset($_POST["teacher_id"]) && $_POST["teacher_id"] !== '' ? (int)$_POST["teacher_id"] : null;

    $teacher_value = ($teacher_id !== null) ? $teacher_id : "NULL";

    $sql = "INSERT INTO subjects (id, subject_name, course_id, teacher_id) 
            VALUES ($id, '$subject_name', $course_id, $teacher_value)";

    if ($conn->query($sql) === TRUE) {
        header("Location: table.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
