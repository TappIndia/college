<?php
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)($_POST['id'] ?? 0);
    $exam_name = $conn->real_escape_string(trim($_POST['exam_name'] ?? ''));
    $subject_id = (int)($_POST['subject_id'] ?? 0);
    $exam_date = $conn->real_escape_string(trim($_POST['exam_date'] ?? ''));

    $date_value = !empty($exam_date) ? "'$exam_date'" : "NULL";

    $sql = "UPDATE exam SET 
            exam_name = '$exam_name', 
            subject_id = $subject_id, 
            exam_date = $date_value 
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
