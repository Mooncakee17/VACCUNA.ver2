<?php 
include '../Homepage/config.php';
    $select = mysqli_query($conn, "SELECT sum(stocks) as stocks, sum(administered) as administered FROM vaccineinventory where active = 1") or die('query failed');
    $vaccine_count = mysqli_fetch_all($select, MYSQLI_ASSOC);
    foreach($vaccine_count as $vax_count){
    	$stocks = $vax_count['stocks'];
    	$administered = $vax_count['administered'];
    }



    $select = mysqli_query($conn, "SELECT  
    SUM(CASE WHEN appointment_status = 2 THEN 1 ELSE 0 END) as vaccine_administer,
    SUM(CASE WHEN appointment_status = 3 THEN 1 ELSE 0 END) as missed_appointment
	FROM appointmenttable;") or die('query failed');
    $appointment_data = mysqli_fetch_all($select, MYSQLI_ASSOC);
    foreach($appointment_data as $appt_data){
    	$missed_appointment = $appt_data['missed_appointment'];
    	$vaccine_administer = $appt_data['vaccine_administer'];
    }




    $select = mysqli_query($conn, "SELECT  
    SUM(CASE WHEN appointment_status = 2 and vacid = 1 THEN 1 ELSE 0 END) as bcg_administered,
    (SUM(CASE WHEN appointment_status = 2 and vacid = 2 THEN 1 ELSE 0 END) +
    SUM(CASE WHEN appointment_status = 2 and vacid = 3 THEN 1 ELSE 0 END) +
    SUM(CASE WHEN appointment_status = 2 and vacid = 4 THEN 1 ELSE 0 END))
     as hepb_administered,
    (SUM(CASE WHEN appointment_status = 2 and vacid = 5 THEN 1 ELSE 0 END) +
    SUM(CASE WHEN appointment_status = 2 and vacid = 6 THEN 1 ELSE 0 END) +
    SUM(CASE WHEN appointment_status = 2 and vacid = 20 THEN 1 ELSE 0 END))
     as dtap_administered,
    (SUM(CASE WHEN appointment_status = 2 and vacid = 7 THEN 1 ELSE 0 END) +
    SUM(CASE WHEN appointment_status = 2 and vacid = 8 THEN 1 ELSE 0 END) +
    SUM(CASE WHEN appointment_status = 2 and vacid = 22 THEN 1 ELSE 0 END))
     as hib_administered,
    (SUM(CASE WHEN appointment_status = 2 and vacid = 9 THEN 1 ELSE 0 END) +
    SUM(CASE WHEN appointment_status = 2 and vacid = 10 THEN 1 ELSE 0 END) +
    SUM(CASE WHEN appointment_status = 2 and vacid = 11 THEN 1 ELSE 0 END))
     as ipv_administered,
    (SUM(CASE WHEN appointment_status = 2 and vacid = 12 THEN 1 ELSE 0 END) +
    SUM(CASE WHEN appointment_status = 2 and vacid = 13 THEN 1 ELSE 0 END) +
    SUM(CASE WHEN appointment_status = 2 and vacid = 23 THEN 1 ELSE 0 END))
     as pcv_administered,
    (SUM(CASE WHEN appointment_status = 2 and vacid = 14 THEN 1 ELSE 0 END) +
    SUM(CASE WHEN appointment_status = 2 and vacid = 15 THEN 1 ELSE 0 END) +
    SUM(CASE WHEN appointment_status = 2 and vacid = 21 THEN 1 ELSE 0 END))
     as rota_administered,
    (SUM(CASE WHEN appointment_status = 2 and vacid = 16 THEN 1 ELSE 0 END) +
    SUM(CASE WHEN appointment_status = 2 and vacid = 24 THEN 1 ELSE 0 END))
     as mmr_administered,  
    (SUM(CASE WHEN appointment_status = 2 and vacid = 17 THEN 1 ELSE 0 END) +
    SUM(CASE WHEN appointment_status = 2 and vacid = 25 THEN 1 ELSE 0 END))
     as flu_administered,   
    (SUM(CASE WHEN appointment_status = 2 and vacid = 18 THEN 1 ELSE 0 END) +
    SUM(CASE WHEN appointment_status = 2 and vacid = 19 THEN 1 ELSE 0 END))
     as hepa_administered             
FROM appointmenttable;
") or die('query failed');
    $graph_data = mysqli_fetch_all($select, MYSQLI_ASSOC);
    foreach($graph_data as $graph){
    	$bcg_administered = $graph['bcg_administered'];
    	$hepb_administered = $graph['hepb_administered'];
    	$dtap_administered = $graph['dtap_administered'];
    	$hib_administered = $graph['hib_administered'];
    	$ipv_administered = $graph['ipv_administered'];
    	$pcv_administered = $graph['pcv_administered'];
    	$rota_administered = $graph['rota_administered'];
    	$mmr_administered = $graph['mmr_administered'];
    	$flu_administered = $graph['flu_administered'];
    	$hepa_administered = $graph['hepa_administered'];

    }


    $select = mysqli_query($conn, "SELECT * FROM vaccineinventory where active = 1") or die('query failed');
    $vaccine_name = mysqli_fetch_all($select, MYSQLI_ASSOC);


?>