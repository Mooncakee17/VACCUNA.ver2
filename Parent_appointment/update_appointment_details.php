<?php 
include '../Homepage/config.php';
$appt_id = $_POST['appt_id'];
$child_name = $_POST['child_name'];
$contact = $_POST['contact'];
$child_age = $_POST['child_age'];
$email = $_POST['email'];
$mother_name = $_POST['mother_name'];
$appointment_date = date("Y-m-d",strtotime($_POST['appointment_date'])); 
$appointment_time = $_POST['appointment_time'];




$sql = "UPDATE appointmenttable 
SET 
 child_name = '$child_name', 
 contact_number = '$contact', 
 age = $child_age, 
 email = '$email', 
 guardian_name = '$mother_name', 
 appt_time = '$appointment_time', 
 appt_date = '$appointment_date'
WHERE appt_id = $appt_id";
mysqli_query($conn, $sql);
header('location: ../Parent/Appointment-Page.php');
?>
