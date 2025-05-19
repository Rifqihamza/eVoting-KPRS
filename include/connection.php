<?php
// Database connection parameters
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'db_evoting';

// Create a new MySQLi connection
$con  = new mysqli($host, $user, $pass, $db);

// Check for connection errors
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
