<?php
    // Database configuration
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "college";

    // Create database connection (MySQLi)
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $conn->set_charset("utf8mb4");
?>