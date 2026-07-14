<?php


define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');          // Default XAMPP password is empty
define('DB_NAME', 'job_tracker');

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}


mysqli_set_charset($conn, "utf8mb4");
