<?php
include '../Homepage/config.php';
$appointment_date = date("Y-m-d");
$guardian_name = $_POST['guardian_name'];
$child_name = $_POST['child_name'];
$contact = $_POST['contact'];
$child_age = $_POST['child_age'];
$email = $_POST['email'];
$appointment_type = $_POST['appointment_type'];
$status_desc = "Walk in / Walkin / Actual";
if($appointment_type == "Consultation"){
	$vaccine_id = 0;
	$hidden_dose = 0;
}else{
	$vaccine_id = $_POST['vaccine_id'];
	$hidden_dose = $_POST['hidden_dose'];
}
	$createAppointment = [
    "INSERT INTO appointmenttable (userid, cid, vacid, appt_date, dose, child_name, guardian_name, contact_number, age, email,appointment_status,for_reason,status_desc) VALUES (0, 0, $vaccine_id, '$appointment_date', $hidden_dose, '$child_name', '$guardian_name', '$contact', '$child_age', '$email',5,'$appointment_type, '$status_desc'')"];

	foreach ($createAppointment as $query) {
	    if (mysqli_query($conn, $query)) {
	    	//Do nothing leave it here. for debugging purpose
	    }
	}



	echo $vaccine_id;

?>