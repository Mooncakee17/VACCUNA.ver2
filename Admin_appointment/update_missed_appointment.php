<?php 
include '../Homepage/config.php';

$cid = $_POST['cid'];
$appt_id = $_POST['appt_id'];
$vacid = $_POST['vacid'];
$status_desc = "Missed Appointment, Visitation Failed";
//Get Vaccine_name 
$select = mysqli_query($conn, "SELECT vac_name FROM vaccineinventory WHERE vacid = $vacid ") or die('query failed');
$vaccine_details = mysqli_fetch_all($select, MYSQLI_ASSOC);
foreach($vaccine_details as $value){
	$vaccine_name = $value['vac_name'];
}

$update_child_vaccine_status = "UPDATE child_vaccine_status a SET a.status = 3, a.dosage_status = 0 WHERE a.cid = $cid and a.vac_name = '$vaccine_name' ";
mysqli_query($conn,$update_child_vaccine_status); 

$update_appointmenttable = "UPDATE appointmenttable a SET a.appointment_status = 3, a.status_desc = '$status_desc' WHERE a.cid = $cid and a.vacid = $vacid ";
mysqli_query($conn,$update_appointmenttable); 





echo $vaccine_name;


?>
