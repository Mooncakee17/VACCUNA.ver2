<?php
include '../Homepage/config.php';
$userid = $_POST['userid'];
$cid = $_POST['cid'];
$appointment_date = date("Y-m-d",strtotime($_POST['appointment_date']));
$appointment_time = $_POST['appointment_time'];
$vaccine_name = $_POST['vaccine_administer'];
$dose = $_POST['dose'];
$child_name = $_POST['child_name'];
$contact = $_POST['contact'];
$child_age = $_POST['child_age'];
$email = $_POST['email'];
$mother_name = $_POST['mother_name'];
$appointment_type = $_POST['appointment_type'];
$status_desc = "For Consultation/ To Visit";

	$createAppointment = [
    "INSERT INTO appointmenttable (userid, cid, appt_time, appt_date, child_name, guardian_name, contact_number, age, email,appointment_status,for_reason, status_desc) 
     VALUES ($userid, $cid, '$appointment_time', '$appointment_date', '$child_name', '$mother_name', '$contact', '$child_age', '$email',1,'$appointment_type', '$status_desc')"
	];

	foreach ($createAppointment as $query) {
	    if (mysqli_query($conn, $query)) {
	    	//Do nothing leave it here. for debugging purpose
	    }
	}



	echo 1;

?>