<?php 
include '../config.php';
$appt_id = $_POST['delete_appointment_id'];
$cid = $_POST['delete_cid'];
$vac_name = $_POST['delete_vac_name'];

//Revert the status from child_vaccine_status table 
$sql = "UPDATE child_vaccine_status
SET 
status = 0,
dosage_status = 0
WHERE cid = $cid AND vac_name = '$vac_name'";
mysqli_query($conn, $sql);

//Now Delete the record in appointmenttable
$sql = "DELETE FROM appointmenttable
WHERE appt_id = $appt_id";
mysqli_query($conn, $sql);
header('location: ../Parent/Appointment-Page.php');
?>
