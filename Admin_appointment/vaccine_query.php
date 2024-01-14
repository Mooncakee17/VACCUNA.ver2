<?php
include '../Homepage/config.php';
?>
<?php
//Gagamiting query
$selectval = mysqli_query($conn, "SELECT * FROM vaccine_def a 
LEFT JOIN vaccineinventory b ON a.vacid = b.vacid
WHERE b.vac_name = '%search_variableo%' AND b.active = '%search_variablev%'") or die ('query failed');


?>
