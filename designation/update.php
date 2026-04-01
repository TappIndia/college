<?php
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)($_POST['id'] ?? 0);
    $designation = $conn->real_escape_string(trim($_POST['designation'] ?? ''));

    $sql = "UPDATE designation SET designation = '$designation' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: table.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
