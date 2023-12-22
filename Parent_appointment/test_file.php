<?php 
include '../Homepage/config.php';

$select = mysqli_query($conn, "SELECT a.* FROM appointmenttable a WHERE a.userid = $userid AND a.appointment_status = 1 ") or die('query failed');
$appointmenttable = mysqli_fetch_all($select, MYSQLI_ASSOC);


$check_count = mysqli_query($conn, "SELECT count(*) as check_count FROM appointmenttable WHERE userid = $userid AND appointment_status = 1") or die('query failed');
$appointment_count = mysqli_fetch_all($check_count, MYSQLI_ASSOC);
foreach($appointment_count as $value){
	$appt_count = $value['check_count'];
}

?>
