<?php 
include '../config.php';
$notif_userid = $_POST['notif_userid'];

$sql = "UPDATE usertable SET is_notified = 0 WHERE userid = $notif_userid";
mysqli_query($conn, $sql);
header('location: ../Parent/Appointment-Page.php');

?>
