<?php
include '../Homepage/config.php';

$vaccine_name = $_POST['vaccine_name'];
if($vaccine_name == 1){
// Fetching vaccine data
$select_vaccine_data = mysqli_query($conn, "SELECT stocks, vac_name, vacid FROM vaccineinventory") or die('query failed');



// Set CSV headers
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="vaccine_data.csv"');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Output the CSV headers
fputcsv($output, array('Vaccine Name', 'Stocks', 'Vaccine Administered', 'Missed Appointments'));

// Loop through the vaccine data
while ($vaccine_count_data = mysqli_fetch_assoc($select_vaccine_data)) {
    // Fetching appointments data for each vaccine
    $select_appointments = mysqli_query($conn, "SELECT  
        SUM(CASE WHEN appointment_status = 2 THEN 1 ELSE 0 END) as vaccine_administer,
        SUM(CASE WHEN appointment_status = 3 THEN 1 ELSE 0 END) as missed_appointment
        FROM appointmenttable WHERE vacid = {$vaccine_count_data['vacid']}") or die('query failed');
    $appointment_data = mysqli_fetch_assoc($select_appointments);

    // Output the CSV data for each vaccine
    fputcsv($output, array(
        $vaccine_count_data['vac_name'],
        $vaccine_count_data['stocks'], // Assuming you have a 'stocks' column in the vaccineinventory table
        empty($appointment_data['vaccine_administer']) ? 0 : $appointment_data['vaccine_administer'],
        empty($appointment_data['missed_appointment']) ? 0 : $appointment_data['missed_appointment']
    ));
}
}
else{

// Fetching vaccine data
$select_vaccine_data = mysqli_query($conn, "SELECT stocks, vac_name, vacid FROM vaccineinventory WHERE vac_name LIKE '%$vaccine_name%'") or die('query failed');



// Set CSV headers
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="vaccine_data.csv"');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Output the CSV headers
fputcsv($output, array('Vaccine Name', 'Stocks', 'Vaccine Administered', 'Missed Appointments'));

// Loop through the vaccine data
while ($vaccine_count_data = mysqli_fetch_assoc($select_vaccine_data)) {
    // Fetching appointments data for each vaccine
    $select_appointments = mysqli_query($conn, "SELECT  
        SUM(CASE WHEN appointment_status = 2 THEN 1 ELSE 0 END) as vaccine_administer,
        SUM(CASE WHEN appointment_status = 3 THEN 1 ELSE 0 END) as missed_appointment
        FROM appointmenttable WHERE vacid = {$vaccine_count_data['vacid']}") or die('query failed');
    $appointment_data = mysqli_fetch_assoc($select_appointments);

    // Output the CSV data for each vaccine
    fputcsv($output, array(
        $vaccine_count_data['vac_name'],
        $vaccine_count_data['stocks'], // Assuming you have a 'stocks' column in the vaccineinventory table
        empty($appointment_data['vaccine_administer']) ? 0 : $appointment_data['vaccine_administer'],
        empty($appointment_data['missed_appointment']) ? 0 : $appointment_data['missed_appointment']
    ));
}


}

// Close the file pointer
fclose($output);
?>
