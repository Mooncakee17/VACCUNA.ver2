<?php 
include '../Homepage/config.php';

$vaccine_id = $_POST['vaccine_id'];
$vaccine_name = $_POST['vaccine_name'];
$vaccine_stock = $_POST['vaccine_stock'];
$vaccine_administered = $_POST['vaccine_administered'];
$vaccine_description = $_POST['vaccine_description'];
$vaccine_status = $_POST['vaccine_status'];

//once insert na yung data update the stocks count in inventory
$sql = "UPDATE vaccineinventory 
SET 
vac_name = '$vaccine_name',
vac_desc = '$vaccine_description',
stocks = $vaccine_stock,
administered = $vaccine_administered,
active = $vaccine_status 
WHERE vacid = $vaccine_id";
//After updating the inventory update the appointment status = 0 
if(mysqli_query($conn, $sql)){
	echo 1;
}

?>