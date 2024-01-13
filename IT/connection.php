<?php

// Database configuration
$host = "localhost";
<<<<<<< HEAD
$username = " ";
$password = " ";
$database = "vaccunadb_v1";
=======
$username = "root";
$password = "";
$database = "u621398810_Vaccunadb_v1";
>>>>>>> faa3ac918c2adf376f98415b46f075242a025fe6

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
