<?php
include '../Homepage/config.php';
$activeDay = $_POST['activeDay']; // example 07
$activeMonth = $_POST['activeMonth']; // 11
$activeYear = $_POST['activeYear']; // 2023
$timeFrom = $_POST['timeFrom']; // 11
$timeTo = $_POST['timeTo']; // 2023
$eventTitle = $_POST['eventTitle'];
$dateString = $activeYear . '-' . $activeMonth . '-' . $activeDay;
$business_id = strtotime($dateString).strtotime($timeFrom).strtotime($timeTo);
// Insert the date string into the table
$sql = "DELETE FROM business_day WHERE business_day_id = '$business_id'";
mysqli_query($conn, $sql);

if($sql){
	echo 1;
}
?>
