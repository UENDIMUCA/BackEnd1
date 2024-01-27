<?php
$host = 'localhost';
$db   = 'project';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

// Database connection using PDO
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>