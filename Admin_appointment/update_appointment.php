<?php 
include '../Homepage/config.php';

$cid = $_POST['cid'];
$dose = $_POST['dose'];
$appointment_date = $_POST['appointment_date'];
$userid = $_POST['userid'];
$appt_id = $_POST['appt_id'];
$vacid = $_POST['vacid'];
$vaccine_name = $_POST['vaccine_administer'];
$doctor = $_POST['doctor']; 
$for_reason = $_POST['for_reason']; 
$status_desc = "Completed / Done / Vaccinated";
$status_desc1 = "For Consultation / For Visit";


if($for_reason == "Consultation"){
	$sql = "UPDATE appointmenttable SET appointment_status = 4, vaccine_administer = '$doctor', status_desc = '$status_desc1' WHERE appt_id = '$appt_id'";
	//After updating the inventory update the appointment status = 0 
	if(mysqli_query($conn, $sql)){
		//Success
	}	
}
else{
	//Get the name of administrator 
	$get_admin = mysqli_query($conn, "SELECT concat(firstname,' ',lastname) as admin_administrator FROM usertable WHERE userid = $userid ") or die('query failed');
	$admin_list = mysqli_fetch_all($get_admin, MYSQLI_ASSOC);
	foreach($admin_list as $value){
		$admin = $value['admin_administrator'];
	}





	$select = mysqli_query($conn, "SELECT *  FROM vaccineinventory WHERE vacid = $vacid ") or die('query failed');
	$stock_count = mysqli_fetch_all($select, MYSQLI_ASSOC);
	$date_today = date ('Y-m-d');
	$exp_date = ['exp_date'];
	$batch_no +=1;
	foreach($stock_count as $value){
		$count = $value['stocks'];
		$batch_no = $value['batch_no'];

	}
	
	$new_batch_no = $batch_no +=1;

	if ($count < 1 || $date_today >= $exp_date) {
		$sql1 = "UPDATE vaccineinventory SET stocks = 2, batch_no = $new_batch_no WHERE vacid = $vacid";
		mysqli_query($conn, $sql);
		$result = 'success';
	}


	


	//Get the current count of selected vaccine
	$select = mysqli_query($conn, "SELECT stocks, administered  FROM vaccineinventory WHERE vacid = $vacid ") or die('query failed');
	$stock_count = mysqli_fetch_all($select, MYSQLI_ASSOC);
	foreach($stock_count as $value){
		$count = $value['stocks'];
		$administered = $value['administered'];
	}
	//For stock reduction
	$newcount = $count-=1;
	$newadministered = $administered += 1;

	$result = '';


	$sql = "UPDATE vaccineinventory SET stocks = $newcount, administered = $newadministered WHERE vacid = $vacid";
	//After updating the inventory update the appointment status = 0 
	if(mysqli_query($conn, $sql)){
		$sql = "UPDATE child_vaccine_status SET status = 2 WHERE vac_name = '$vaccine_name' AND cid = '$cid'";
		if(mysqli_query($conn, $sql)){
			$sql = "UPDATE appointmenttable SET appointment_status = 2 , vaccine_administer = '$doctor' , status_desc = '$status_desc' WHERE appt_id = '$appt_id'";
			mysqli_query($conn, $sql);
			$result = 'success';
		}
	}	
}




echo $result;


?>
