<?php 
include '../Homepage/config.php';
    $select = mysqli_query($conn, "SELECT * FROM vaccineinventory ORDER BY active DESC, vacid ASC") or die('query failed');
    $vaccine_list = mysqli_fetch_all($select, MYSQLI_ASSOC);
?>