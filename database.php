<?php
// Database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // Your database username (default for XAMPP is 'root')
define('DB_PASS', '');     // Your database password (default for XAMPP is empty)
define('DB_NAME', 'db_store'); // The database name you created


session_start();

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>