<?php
include '../config.php';
$userid = $_SESSION['user_id'];
$select = mysqli_query($conn, "SELECT * FROM usertable WHERE userid = $userid") or die('query failed');
$user_details = mysqli_fetch_all($select, MYSQLI_ASSOC);
foreach($user_details as $info){
	$email = $info['user_email'];
	$phonenumber = $info['phonenumber'];
}
?>
