<?php
    $host = 'localhost';
    $dbname = 'login';
    $user = 'root';
    $pass = '';

    $connection = new mysqli($host,$user,$pass,$dbname);
    if ($connection->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    } 
?>