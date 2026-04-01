<?php
include("../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = (int)($_POST["id"] ?? 0);
    $name = $conn->real_escape_string(trim($_POST["name"] ?? ''));
    $mobile = $conn->real_escape_string(trim($_POST["mobile"] ?? ''));
    $e_mail = $conn->real_escape_string(trim($_POST["e_mail"] ?? ''));
    $designation_id = isset($_POST["designation_id"]) && $_POST["designation_id"] !== ''
        ? (int)$_POST["designation_id"]
        : null;
    $salary = $conn->real_escape_string(trim($_POST["salary"] ?? '0'));
    $date_of_joining = $conn->real_escape_string(trim($_POST["date_of_joining"] ?? ''));

    $designation_value = ($designation_id !== null) ? $designation_id : "NULL";

    $sql = "INSERT INTO staff (id, name, mobile, e_mail, designation_id, salary, date_of_joining)
            VALUES ($id, '$name', '$mobile', '$e_mail', $designation_value, '$salary', '$date_of_joining')";

    if ($conn->query($sql) === TRUE) {
        header("Location: table.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>