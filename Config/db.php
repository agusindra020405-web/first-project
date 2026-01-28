<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";
// code db
try {
    $conn = new PDO(
        "mysql:host=$servername;dbname=$dbname",
        $username,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
