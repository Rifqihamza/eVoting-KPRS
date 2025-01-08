<?php
// Prevent direct access to this file
// defined('BASEPATH') or header("Direct Access Not Allowed");
// if (!defined('BASEPATH')) {
//     header('Location: errorAlert.html');
//     exit();
// }


// Database connection parameters
$host = 'localhost';
$user = 'AdminKPRS2025';
$pass = '@MitraKPRS2025';
$db   = 'evote';

// Create a new MySQLi connection
$con  = new mysqli($host, $user, $pass, $db);

// Check for connection errors
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
