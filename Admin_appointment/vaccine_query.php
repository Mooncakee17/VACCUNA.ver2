<?php
include '../Homepage/config.php';
?>
<?php
$select = mysqli_query($conn, "SELECT * FROM vaccineinventory a
LEFT JOIN vaccine_def b ON 
a.vacid = b.vacid ORDER BY active ASC") or die('query failed');
$newvac = mysqli_fetch_all($select, MYSQLI_ASSOC);


//Eto yung sa gagamitin mong query sa php file 
$selectval = mysqli_query($conn, "SELECT * FROM vaccineinventory a LEFT JOIN vaccine_def b ON a.vacid = b.vacid 
WHERE CONCAT(batch_no, vac_name) LIKE '%searchData%' ORDER BY active ASC") or die ('query failed');
?>
