<?php
include '../config.php';
$childid = $_POST['childid'];
$response = array(); // Create an empty array to hold the response data

$select = mysqli_query($conn, "SELECT * FROM childtable a 
    LEFT JOIN child_vaccine_status b ON b.cid = a.cid
    WHERE b.cid = $childid AND recommended_age IN ('1st dose', '2nd dose') AND status = 0 AND dosage_status = 0") or die('query failed');

$on_change_select_child = mysqli_fetch_all($select, MYSQLI_ASSOC);

foreach ($on_change_select_child as $info) {
    // Append each iteration's data to the $response array
    $response = array(
        'child_age' => $info['child_age'],
        'mothername' => $info['mothername'],
        'child_full_name' => $info["child_firstname"]." ".$info['child_lastname']
    );
}



// Send a JSON response back to the client
header('Content-Type: application/json');
echo json_encode($response);
?>
