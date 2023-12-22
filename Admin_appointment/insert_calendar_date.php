<?php
include '../Homepage/config.php';
$activeDay = $_POST['activeDay']; //  07
$activeMonth = $_POST['activeMonth']; // 11
$activeYear = $_POST['activeYear']; // 2023
$timeFrom = $_POST['timeFrom'];
$timeTo = $_POST['timeTo'];
$eventTitle = $_POST['eventTitle'];
$dateString = $activeYear . '-' . $activeMonth . '-' . $activeDay;
$business_id = strtotime($dateString).strtotime($timeFrom).strtotime($timeTo);

// Insert the date string into the table
$sql = "INSERT INTO business_day (business_day_id,available_date,time_from,time_to,description) 
VALUES ($business_id, '$dateString', '$timeFrom', '$timeTo', '$eventTitle' )";
mysqli_query($conn, $sql);

if($sql){
	echo 1;
}
?>
