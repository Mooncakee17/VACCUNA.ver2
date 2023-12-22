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
$status_desc = "Waiting For Approval";

	//Get the id of vaccine administer
	$vaccines = mysqli_query($conn, "
		SELECT * from vaccineinventory a
		WHERE a.vac_name = '$vaccine_name' AND a.active = 1 ") or die('query failed');
	$vaccine_list = mysqli_fetch_all($vaccines, MYSQLI_ASSOC);
	foreach($vaccine_list as $value){
		$vacid = $value['vacid'];
	}


	//Get status detail of child
	$child_vaccine_status = mysqli_query($conn, "
		SELECT * from child_vaccine_status a
		WHERE a.cid = $cid ") or die('query failed');
	$child_vaccine_status_list = mysqli_fetch_all($child_vaccine_status, MYSQLI_ASSOC);
	foreach($child_vaccine_status_list as $value){
		$dosage_status = $value['dosage_status'];
		$new_dosage_status = $dosage_status+=1;
	}




	$createAppointment = [
    "INSERT INTO appointmenttable (userid, cid, vacid, appt_time, appt_date, dose, child_name, guardian_name, contact_number, age, email,appointment_status,for_reason, status_desc) VALUES ($userid, $cid, $vacid, '$appointment_time', '$appointment_date', $dose, '$child_name', '$mother_name', '$contact', '$child_age', '$email',1,'$appointment_type','$status_desc')",
    "UPDATE child_vaccine_status SET status = 1, dosage_status = $new_dosage_status  WHERE cid = $cid and vac_name = '$vaccine_name' ",
	];

	foreach ($createAppointment as $query) {
	    if (mysqli_query($conn, $query)) {
	    	//Do nothing leave it here. for debugging purpose
	    }
	}



	echo 1;

?>
