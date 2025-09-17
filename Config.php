<?php
// Database connection settings
$host = "localhost";   // Database host
$db   = "patanjali";   // Database name
$user = "root";        // Database user (XAMPP default)
$pass = "";            // Database password (XAMPP default is blank)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
