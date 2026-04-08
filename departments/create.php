<?php
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)($_POST["id"] ?? 0);
    $dept_name = $conn->real_escape_string(trim($_POST["dept_name"] ?? ''));

    $sql = "INSERT INTO departments (id, dept_name) VALUES ($id, '$dept_name')";

    if ($conn->query($sql) === TRUE) {
        header("Location: table.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
