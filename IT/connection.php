<?php

// Database configuration
$host = "localhost";
$username = " ";
$password = " ";
$database = "vaccunadb_v1";

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
