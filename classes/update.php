<?php
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)($_POST['id'] ?? 0);
    $class_name = $conn->real_escape_string(trim($_POST['class_name'] ?? ''));
    $course_id = isset($_POST['course_id']) && $_POST['course_id'] !== '' ? (int)$_POST['course_id'] : null;
    $year = isset($_POST['year']) && $_POST['year'] !== '' ? (int)$_POST['year'] : null;

    $course_value = ($course_id !== null) ? $course_id : "NULL";
    $year_value = ($year !== null) ? $year : "NULL";

    $sql = "UPDATE classes SET 
            class_name = '$class_name', 
            course_id = $course_value, 
            year = $year_value 
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
