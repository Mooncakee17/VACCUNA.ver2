<?php 
include '../config.php';
$userid = $_SESSION['user_id'];
//Get All Children
$select = mysqli_query($conn, "SELECT a.* FROM childtable a 
LEFT JOIN usertable b ON b.userid = a.userid 
WHERE a.userid = $userid") or die('query failed');
$child_list = mysqli_fetch_all($select, MYSQLI_ASSOC);

	
?>
