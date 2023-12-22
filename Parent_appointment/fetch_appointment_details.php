<<?php
include '../config.php';
$appt_id = $_POST['appt_id'];

$select = mysqli_query($conn, "SELECT a.*,b.vac_name FROM appointmenttable a 
	LEFT JOIN vaccineinventory b ON b.vacid = a.vacid AND b.active = 1 WHERE a.appt_id = $appt_id ") or die('query failed');
$fetch_appointment_details = mysqli_fetch_all($select, MYSQLI_ASSOC);
foreach($fetch_appointment_details as $value){
	 $response = array(
	 	'status' => 'success', 
	 	'appt_id' =>  $value['appt_id'] , 
	 	'userid' => $value['userid'],
	 	'vacid' => $value['vacid'], 
	 	'appt_time' => $value['appt_time'],
	 	'appt_date' => $value['appt_date'],
	 	'dose' => $value['dose'],
	 	'child_name' => $value['child_name'],
	 	'guardian_name' => $value['guardian_name'],
	 	'contact_number' => $value['contact_number'],
	 	'age' => $value['age'],
	 	'email' => $value['email'],
	 	'vac_name' => $value['vac_name'],
	 	'cid' => $value['cid']
	 );
}

// Send a JSON response back to the client
header('Content-Type: application/json');
echo json_encode($response);


?>
