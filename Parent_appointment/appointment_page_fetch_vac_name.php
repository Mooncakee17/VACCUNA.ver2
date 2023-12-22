<?php
include '../config.php';
$childid = $_POST['childid'];
$response = array(); // Create an empty array to hold the response data

$select = mysqli_query($conn, "SELECT * FROM childtable a 
    LEFT JOIN child_vaccine_status b ON b.cid = a.cid
    WHERE b.cid = $childid AND recommended_age IN ('1st dose', '2nd dose') AND status = 0 AND dosage_status = 0") or die('query failed');

$get_vac_name = mysqli_fetch_all($select, MYSQLI_ASSOC);

$html = '';

foreach ($get_vac_name as $info) {
    $html.="<option value='{$info['vac_name']}'>{$info['vac_name']}</option>";
}

echo $html;
?>
