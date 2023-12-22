<?php 
include '../Homepage/config.php';

$vac_trashid = $_POST['vac_trashid'];

//once insert na yung data update the stocks count in inventory
$sql = "UPDATE vaccineinventory SET active = 0 WHERE vacid = $vac_trashid";
//After updating the inventory update the appointment status = 0 
if(mysqli_query($conn, $sql)){
	echo 1;
}

?>