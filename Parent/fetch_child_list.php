<?php
include '../Homepage/config.php';
$userid = $_SESSION['user_id'];
$select = mysqli_query($conn, "SELECT * FROM childtable WHERE userid = $userid") or die('query failed');
$child_list_dropdown = mysqli_fetch_all($select, MYSQLI_ASSOC);
?>