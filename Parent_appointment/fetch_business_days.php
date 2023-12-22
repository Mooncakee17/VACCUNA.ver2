<?php
include '../config.php';

$select = mysqli_query($conn, "SELECT available_date FROM business_day") or die('query failed');
$business_day = mysqli_fetch_all($select, MYSQLI_ASSOC);

// Create a PHP array to store available dates dito kinukuha yung date na allowed lang.pag wala siya sa table na business_day di siya magiging clickable
$allowedDates = array();

foreach ($business_day as $row) {
    $allowedDates[] = $row['available_date'];
}

// Serialize the PHP array to JSON
$allowedDatesJSON = json_encode($allowedDates);
?>
