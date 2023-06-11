<?php
// Database credentials
$host = 'localhost';
$dbName = 'cafestuff';
$user = 'root';
$password = '1';

// Create a new MySQLi instance
$mysqli = mysqli_connect($host, $user, $password, $dbName);

// Check the connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
