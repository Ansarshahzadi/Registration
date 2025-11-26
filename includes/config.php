<?php
$host = "localhost";     // Host name
$user = "root";          // Database username
$password = "";          // Database password
$database = "school_administrations"; // Database name

// Create connection
$cn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$cn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>