<?php
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)($_POST['id'] ?? 0);
    $course_name = $conn->real_escape_string(trim($_POST['course_name'] ?? ''));
    $dept_id = isset($_POST['dept_id']) && $_POST['dept_id'] !== '' ? (int)$_POST['dept_id'] : null;
    $duration = isset($_POST['duration']) && $_POST['duration'] !== '' ? (int)$_POST['duration'] : null;

    $dept_value = ($dept_id !== null) ? $dept_id : "NULL";
    $duration_value = ($duration !== null) ? $duration : "NULL";

    $sql = "UPDATE courses SET 
            course_name = '$course_name', 
            dept_id = $dept_value, 
            duration = $duration_value 
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
