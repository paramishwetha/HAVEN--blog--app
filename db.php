<?php
// Automatically uses cloud environment variables when live, or falls back to XAMPP defaults
$host   = getenv('DB_HOST')     ?: "localhost";
$user   = getenv('DB_USER')     ?: "root";
$pass   = getenv('DB_PASSWORD') ?: "";
$dbname = getenv('DB_NAME')     ?: "blog_db";
$port   = getenv('DB_PORT')     ?: 3306;

$conn = new mysqli($host, $user, $pass, $dbname, (int)$port);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>