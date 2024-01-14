<?php 
include '../Homepage/config.php';

$batch_vaccine_id = $_POST['batch_vaccine_id'];
$batch_no = $_POST['batch_no'];
$batch_vax_exp = $_POST['batch_vax_exp'];
$batch_vaccine_stock = $_POST['batch_vaccine_stock'];



//once insert na yung data update the stocks count in inventory

$sql = "INSERT INTO vaccine_def(vacid, newbatch_no, stocks, expiration_date) 
VALUES($batch_vaccine_id  , $batch_no , $batch_vaccine_stock , '$batch_vax_exp' )";
//After updating the inventory update the appointment status = 0 
if(mysqli_query($conn, $sql)){
	echo 1;
}




?>