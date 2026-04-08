<?php
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)($_POST['id'] ?? 0);
    $subject_name = $conn->real_escape_string(trim($_POST['subject_name'] ?? ''));
    $course_id = (int)($_POST['course_id'] ?? 0);
    $teacher_id = isset($_POST['teacher_id']) && $_POST['teacher_id'] !== '' ? (int)$_POST['teacher_id'] : null;

    $teacher_value = ($teacher_id !== null) ? $teacher_id : "NULL";

    $sql = "UPDATE subjects SET 
            subject_name = '$subject_name', 
            course_id = $course_id, 
            teacher_id = $teacher_value 
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
