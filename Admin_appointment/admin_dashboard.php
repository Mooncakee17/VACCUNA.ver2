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








    //GET childregistered count
    $select = mysqli_query($conn, "SELECT count(*) AS childregistered FROM childtable;") or die('query failed');
    $child_registered = mysqli_fetch_all($select, MYSQLI_ASSOC);
    foreach($child_registered as $value){
    	$registered_count = $value['childregistered'];
    }




    //GET partially and unvaccinated child
    $select = mysqli_query($conn, "SELECT
                    SUM(unvaccinated_count) AS total_unvaccinated_count,
                    SUM(partially_vaccinated_count) AS total_partially_vaccinated_count
                FROM (
                    SELECT
                        CASE WHEN COUNT(*) = 26 THEN 1 ELSE 0 END AS unvaccinated_count,
                        CASE WHEN COUNT(*) < 26 THEN 1 ELSE 0 END AS partially_vaccinated_count
                    FROM childtable a
                    LEFT JOIN child_vaccine_status b ON a.cid = b.cid
                    WHERE vac_name IN (
                        'BCG', 'HepB1', 'HepB2', 'HepB3', 'DTaP1', 'DTaP2', 'HiB1', 'HiB2', 'IPV1', 'IPV2', 'IPV3',
                        'PCV1', 'PCV2', 'Rotavirus1', 'Rotavirus2', 'MMR', 'Influenza', 'HepA1', 'HepA2', 'DTaP3',
                        'Rotavirus3', 'HiB3', 'PCV3', 'MMR2', 'Influenza2'
                    ) AND b.status = 0
                    GROUP BY b.cid
                ) AS subquery;") or die('query failed');
    $unvaccine_and_partial = mysqli_fetch_all($select, MYSQLI_ASSOC);
    foreach($unvaccine_and_partial as $value){
    	$partially_vaccinated_count = $value['total_partially_vaccinated_count'];
        $unvaccinated_count = $value['total_unvaccinated_count'];
    }    



    //GET fully vaccinated count

    //GET childregistered count
    $select = mysqli_query($conn, "SELECT
                        cid,
                        SUM(bcg) AS total_bcg,
                        SUM(hepb) AS total_hepb,
                        SUM(dtap) AS total_dtap,
                        SUM(hepa) AS total_hepa,
                        SUM(hib) AS total_hib,
                        SUM(influenza) AS total_influenza,
                        SUM(ipv) AS total_ipv,
                        SUM(mmr) AS total_mmr,
                        SUM(pcv) AS total_pcv,
                        SUM(rota) AS total_rota
                    FROM (
                        SELECT
                            a.cid,
                            CASE WHEN a.vacid = 1 AND appointment_status = 2 THEN 1 ELSE 0 END AS bcg,
                            CASE WHEN a.vacid IN (2, 3, 4) AND appointment_status = 2 THEN 1 ELSE 0 END AS hepb,
                            CASE WHEN a.vacid IN (5, 6, 20) AND appointment_status = 2 THEN 1 ELSE 0 END AS dtap,
                            CASE WHEN a.vacid IN (18, 19) AND appointment_status = 2 THEN 1 ELSE 0 END AS hepa,
                            CASE WHEN a.vacid IN (7, 8, 22) AND appointment_status = 2 THEN 1 ELSE 0 END AS hib,
                            CASE WHEN a.vacid IN (17, 25) AND appointment_status = 2 THEN 1 ELSE 0 END AS influenza,
                            CASE WHEN a.vacid IN (9, 10, 11) AND appointment_status = 2 THEN 1 ELSE 0 END AS ipv,
                            CASE WHEN a.vacid IN (15, 24) AND appointment_status = 2 THEN 1 ELSE 0 END AS mmr,
                            CASE WHEN a.vacid IN (12, 13, 23) AND appointment_status = 2 THEN 1 ELSE 0 END AS pcv,
                            CASE WHEN a.vacid IN (14, 15, 21) AND appointment_status = 2 THEN 1 ELSE 0 END AS rota
                        FROM appointmenttable a
                        LEFT JOIN childtable b ON a.cid = b.cid
                        WHERE a.appointment_status = 2
                    ) AS subquery
                    GROUP BY cid;
                    ") or die('query failed');
    $fully_vaccinated = mysqli_fetch_all($select, MYSQLI_ASSOC);
    $bcg = 0;
    $hepb = 0;
    $dtap = 0;
    $hepa = 0;
    $hib = 0;
    $influenza = 0;
    $ipv = 0;
    $mmr = 0;
    $pcv = 0;
    $rota = 0;
    //note count ng bcg para maging fully vaccinated ang cid is = 1, 
    /*
    1 BCG 1
    2,3,4 HEPB = 3
    5,6,20 DTAP = 3
    18,19 HEPA = 2
    7,8,22 HiB = 3
    17,25 Influenza =2 
    9,10,11 IPV = 3
    15,24 MMR = 2
    12,13,23 PCV =3 
    14,15,21 ROTA = 3
    */
    foreach($fully_vaccinated as $value){
    	if($value['total_bcg'] == 1){
            $bcg += 1;
        }
    	if($value['total_hepb'] == 3){
            $hepb += 1;
        }
    	if($value['total_dtap'] == 3){
            $dtap += 1;
        }
        if($value['total_hepa'] == 2){
            $hepa += 1;
        }
        if($value['total_hib'] == 3){
            $hib += 1;
        }
        if($value['total_influenza'] == 2){
            $influenza += 1;
        }
        if($value['total_ipv'] == 3){
            $ipv += 1;
        }
        if($value['total_mmr'] == 2){
            $mmr += 1;
        }       
        if($value['total_pcv'] == 3){
            $pcv += 1;
        }    
        if($value['total_rota'] == 3){
            $rota += 1;
        }    
    }


    $vaccinated_count = $bcg + $hepb + $dtap + $hepa + $hib + $influenza + $ipv + $mmr + $pcv + $rota;

    //echo $vaccinated_count;
   
    // GET Appointmen today
    //GET TODAY
    $date_today = date('Y-m-d');
    $select = mysqli_query($conn, "SELECT a.* FROM appointmenttable a 
    LEFT JOIN childtable b ON a.cid = b.cid WHERE appointment_status = 1 AND appt_date = '$date_today'") or die('query failed');
    $appointment_today = mysqli_fetch_all($select, MYSQLI_ASSOC);
    foreach($appointment_today as $value){
    	$child_name = $value['child_name'];
        $appt_time = $value['appt_time'];
        $appt_date = $value['appt_date'];
        $admin = $value['appt_date'];
        $appt_today_html = '';
        $appt_today_html.= "<tr>";
        $appt_today_html.= "<td>".$child_name ."</td>";
        $appt_today_html.= "<td>".$appt_date ."</td>";
        $appt_today_html.= "<td>".$appt_time ."</td>";
        $appt_today_html.= "</tr>";
     
    }





    $bcg_count = 0;
    $hepb1_count = $hepb2_count = $hepb3_count = 0;
    $dtap1_count = $dtap2_count = $dtap3_count = 0;
    $hepa1_count = $hepa2_count = 0;
    $hib1_count = $hib2_count = $hib3_count = 0;
    $influenza1_count = $influenza2_count = 0;
    $ipv1_count = $ipv2_count = $ipv3_count = 0;
    $mmr1_count = $mmr2_count = 0;
    $pcv1_count = $pcv2_count = $pvc3_count = 0;
    $rota1_count = $rota2_count = $rota3_count = 0;

    $select = mysqli_query($conn, "SELECT vacid,stocks,vac_name FROM vaccineinventory where active = 1") or die('query failed');
    $per_vaccine_stock = mysqli_fetch_all($select, MYSQLI_ASSOC);
    $row_count =  mysqli_num_rows($select);
    foreach($per_vaccine_stock  as $value) {
        if($value['vacid'] == 1){
            $bcg_count = $value['stocks'];
        }
        if($value['vacid'] == 2){
            $hepb1_count = $value['stocks'];
        }
        if($value['vacid'] == 3){
            $hepb2_count = $value['stocks'];
        }
        if($value['vacid'] == 4){
            $hepb3_count = $value['stocks'];
        }
        if($value['vacid'] == 5){
            $dtap1_count = $value['stocks'];
        }
        if($value['vacid'] == 6){
            $dtap2_count = $value['stocks'];
        }
        if($value['vacid'] == 20){
            $dtap3_count = $value['stocks'];
        }
        if($value['vacid'] == 18){
            $hepa1_count = $value['stocks'];
        }
        if($value['vacid'] == 19){
            $hepa2_count = $value['stocks'];
        }
        if($value['vacid'] == 7){
            $hib1_count = $value['stocks'];
        }
        if($value['vacid'] == 8){
            $hib2_count = $value['stocks'];
        }
        if($value['vacid'] == 22){
            $hib3_count = $value['stocks'];
        }
        if($value['vacid'] == 17){
            $influenza1_count = $value['stocks'];
        }
        if($value['vacid'] == 25){
            $influenza2_count = $value['stocks'];
        }
        if($value['vacid'] == 9){
            $ipv1_count = $value['stocks'];
        }
        if($value['vacid'] == 10){
            $ipv2_count = $value['stocks'];
        }
        if($value['vacid'] == 11){
            $ipv3_count = $value['stocks'];
        }
        if($value['vacid'] == 15){
            $mmr1_count = $value['stocks'];
        }
        if($value['vacid'] == 24){
            $mmr2_count = $value['stocks'];
        }
        if($value['vacid'] == 12){
            $pcv1_count = $value['stocks'];
        }
        if($value['vacid'] == 13){
            $pcv2_count = $value['stocks'];
        }
        if($value['vacid'] == 23){
            $pcv3_count = $value['stocks'];
        }
        if($value['vacid'] == 14){
            $rota1_count = $value['stocks'];
        }
        if($value['vacid'] == 15){
            $rota2_count = $value['stocks'];
        }
        if($value['vacid'] == 21){
            $rota3_count = $value['stocks'];
        }
    }


   $bcg_total =  $bcg_count ;
   $hepb_total =  $hepb1_count + $hepb2_count + $hepb3_count;
   $dtap_total =  $dtap1_count + $dtap2_count + $dtap3_count;
   $hepa_total =  $hepa1_count + $hepa2_count;
   $hib_total =  $hib1_count + $hib2_count + $hib3_count;
   $influenza_total =  $influenza1_count + $influenza2_count;
   $ipv_total =  $ipv1_count + $ipv2_count + $ipv3_count;
   $mmr_total =  $mmr1_count + $mmr2_count ;
   $pcv_total =  $pcv1_count + $pcv2_count + $pvc3_count;
   $rota_total =  $rota1_count + $rota2_count + $rota3_count;

?>