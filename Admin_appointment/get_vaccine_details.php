<?php 
include '../Homepage/config.php';
	$update_vaccine = $_POST['update_vaccine'];
    $select = mysqli_query($conn, "SELECT * FROM vaccineinventory WHERE vacid = '$update_vaccine' ORDER BY active DESC, vacid ASC") or die('query failed');
    $vaccine_list = mysqli_fetch_all($select, MYSQLI_ASSOC);



	foreach($vaccine_list as $value){
		 $response = array(
		 	'status' => 'success', 
		 	'vacid' =>  $value['vacid'] , 
		 	'vac_name' => $value['vac_name'],
		 	'vac_desc' => $value['vac_desc'],
		 	'stocks' => $value['stocks'],
		 	'administered' => $value['administered'],
		 	'active' => $value['active']
		 );
	}
	
	// Send a JSON response back to the client
	header('Content-Type: application/json');
	echo json_encode($response);

?>