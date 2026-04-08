<?php
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)($_POST['id'] ?? 0);
    $student_id = (int)($_POST['student_id'] ?? 0);
    $exam_id = (int)($_POST['exam_id'] ?? 0);
    $marks_obtained = (int)($_POST['marks_obtained'] ?? 0);
    $max_marks = (int)($_POST['max_marks'] ?? 0);

    $sql = "UPDATE marks SET 
            student_id = $student_id, 
            exam_id = $exam_id, 
            marks_obtained = $marks_obtained, 
            max_marks = $max_marks 
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
