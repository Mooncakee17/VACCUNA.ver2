<?php
error_reporting(0);
session_start();
include '../config.php';
$userid = $_SESSION['user_id'];
$cid_session = $_SESSION['cid'] ;
//get birthdate and dosage status
$birthdate = mysqli_query($conn, "SELECT DISTINCT a.birthdate, b.dosage_status FROM childtable a
		LEFT JOIN child_vaccine_status b ON b.cid = a.cid
		WHERE a.cid = $cid_session AND dosage_status = 0 ") or die('query fail71ed');
$birthdate_data = mysqli_fetch_all($birthdate, MYSQLI_ASSOC);

foreach($birthdate_data as $value){
	$birthdate = $value['birthdate'];
	$dosage_status = $value['dosage_status'];
}
//dosage status = 0 meaning hindi pa na tatake kahit kailan
//Compare By birth
if($dosage_status == 0){
	//check if the status of all dosage is 0 if yes get the interval of birthdate from recommended date then check if the current date is greater than reccomended date if yes then the child can take the vaccine.
	$recommended_date = mysqli_query($conn, "
		SELECT DISTINCT
	    a.birthdate AS birthdate,
	    CURDATE() AS `current_date`,
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.birthdate, INTERVAL 1 DAY) THEN '1st dose'
	        ELSE  'No'
	    END AS bcg_recommended,
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.birthdate, INTERVAL 1 DAY)  THEN '1st dose'
	        ELSE 'No'
	    END AS hepb1_recommended, 
	    CASE
	        WHEN CURDATE() >=  DATE_ADD(a.birthdate, INTERVAL 6 WEEK) THEN '1st dose'
	        ELSE 'No'
	    END AS dtap1_recommended,    
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.birthdate, INTERVAL 6 WEEK) THEN '1st dose'
	        ELSE 'No'
	    END AS hib1_recommended, 
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.birthdate, INTERVAL 6 WEEK) THEN '1st dose'
	        ELSE 'No'
	    END AS ipv1_recommended,  
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.birthdate, INTERVAL 6 WEEK) THEN '1st dose'
	        ELSE 'No'
	    END AS pcv1_recommended,   
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.birthdate, INTERVAL 6 WEEK) THEN '1st dose'
	        ELSE 'No'
	    END AS rota1_recommended,
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.birthdate, INTERVAL 9 MONTH) THEN '1st dose'
	        ELSE 'No'
	    END AS mmr_recommended,     
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.birthdate, INTERVAL 6 MONTH)  THEN '1st dose'
	        ELSE 'No'
	    END AS influenza_recommended,
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.birthdate, INTERVAL 12 MONTH) THEN '1st dose'
	        ELSE 'No'
	    END AS hepa1_recommended                            
	FROM childtable a  
		LEFT JOIN child_vaccine_status b ON b.cid = a.cid
		LEFT JOIN vaccineinventory c ON c.vac_name = b.vac_name AND c.active = 1
		WHERE a.cid = $cid_session AND (b.status != 2 OR  b.status != 1)") or die('query faile7d');
	$recommended = mysqli_fetch_all($recommended_date, MYSQLI_ASSOC);
	foreach($recommended as $value){
		$bcg_recommended = $value['bcg_recommended'];
		$hepb1_recommended = $value['hepb1_recommended'];
		$dtap1_recommended = $value['dtap1_recommended'];
		$hib1_recommended = $value['hib1_recommended'];
		$ipv1_recommended = $value['ipv1_recommended'];
		$pcv1_recommended = $value['pcv1_recommended'];
		$rota1_recommended = $value['rota1_recommended'];
		$mmr_recommended = $value['mmr_recommended'];
		$influenza_recommended = $value['influenza_recommended'];
		$hepa1_recommended = $value['hepa1_recommended'];
	}

	//After checking the reccomended date get the value of the table above the yes or no and update the child_vaccine_status table base on the result of table above.
	// Define and execute each UPDATE query
	$updateQueries = [
	    "UPDATE child_vaccine_status SET recommended_age = '$bcg_recommended' WHERE vac_name ='BCG' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$hepb1_recommended' WHERE vac_name ='HepB1' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$dtap1_recommended' WHERE vac_name ='DTaP1' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$hib1_recommended' WHERE vac_name ='HiB1' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$ipv1_recommended' WHERE vac_name ='IPV1' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$pcv1_recommended' WHERE vac_name ='PCV1' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$rota1_recommended' WHERE vac_name ='Rotavirus1' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$mmr_recommended' WHERE vac_name ='MMR' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$influenza_recommended' WHERE vac_name ='Influenza' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$hepa1_recommended' WHERE vac_name ='HepA1' AND cid = $cid_session"
	];

	foreach ($updateQueries as $query) {
	    if (mysqli_query($conn, $query)) {
	    	//Do nothing leave it here. for debugging purpose
	    }
	}
}















//compare by appointment date
$nd_dose = mysqli_query($conn, "SELECT DISTINCT a.appt_date, b.dosage_status, c.vac_name FROM appointmenttable a
		LEFT JOIN child_vaccine_status b ON b.cid = a.cid
		LEFT JOIN vaccineinventory c ON c.vacid = a.vacid AND c.active = 1
		WHERE a.cid = $cid_session AND dosage_status = 1") or die('query fail6ed');
$nd_dose_data = mysqli_fetch_all($nd_dose, MYSQLI_ASSOC);
foreach($nd_dose_data as $value){
	$last_vaccine = $value['appt_date'];
	$vac_name = $value['vac_name'];
	$dosage_status = $value['dosage_status'];
	$currentdate = date("Y-m-d");
}

if($dosage_status == 1){
	//check if the status of all dosage is 0 if yes get the interval of birthdate from recommended date then check if the current date is greater than reccomended date if yes then the child can take the vaccine.
	$recommended_date = mysqli_query($conn, "
		SELECT DISTINCT
	    a.appt_date AS appt_date,
	    CURDATE() AS `current_date`,
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 1 DAY) THEN '2nd dose'			
	        ELSE  'No'
	    END AS bcg_recommended,
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 1 MONTH)  THEN '2nd dose'
	        ELSE 'No'
	    END AS hepb1_recommended, 
	    CASE
	        WHEN CURDATE() >=  DATE_ADD(a.appt_date, INTERVAL 10 WEEK) THEN '2nd dose'
	        ELSE 'No'
	    END AS dtap1_recommended,    
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 10 WEEK) THEN '2nd dose'
	        ELSE 'No'
	    END AS hib1_recommended, 
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 10 WEEK) THEN '2nd dose'
	        ELSE 'No'
	    END AS ipv1_recommended,  
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 10 WEEK) THEN '2nd dose'
	        ELSE 'No'
	    END AS pcv1_recommended,   
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 10 WEEK) THEN '2nd dose'
	        ELSE 'No'
	    END AS rota1_recommended,
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 48 MONTH) THEN '2nd dose'
	        ELSE 'No'
	    END AS mmr_recommended,     
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 4 WEEK)  THEN '2nd dose'
	        ELSE 'No'
	    END AS influenza_recommended,
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 6 MONTH) THEN '2nd dose'
	        ELSE 'No'
	    END AS hepa1_recommended                            
	FROM appointmenttable a  
		LEFT JOIN child_vaccine_status b ON b.cid = a.cid
		WHERE a.cid = $cid_session AND a.dose <> 2") or die('query faile5d');
	$recommended = mysqli_fetch_all($recommended_date, MYSQLI_ASSOC);
	foreach($recommended as $value){
		$bcg_recommended = $value['bcg_recommended'];
		$hepb1_recommended = $value['hepb1_recommended'];
		$dtap1_recommended = $value['dtap1_recommended'];
		$hib1_recommended = $value['hib1_recommended'];
		$ipv1_recommended = $value['ipv1_recommended'];
		$pcv1_recommended = $value['pcv1_recommended'];
		$rota1_recommended = $value['rota1_recommended'];
		$mmr_recommended = $value['mmr_recommended'];
		$influenza_recommended = $value['influenza_recommended'];
		$hepa1_recommended = $value['hepa1_recommended'];
	}

	//After checking the reccomended date get the value of the table above the yes or no and update the child_vaccine_status table base on the result of table above.
	// Define and execute each UPDATE query

	$updateQueries = [
	    "UPDATE child_vaccine_status SET recommended_age = '$hepb1_recommended' WHERE vac_name ='HepB2' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$dtap1_recommended' WHERE vac_name ='DTaP2' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$hib1_recommended' WHERE vac_name ='HiB2' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$ipv1_recommended' WHERE vac_name ='IPV2' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$pcv1_recommended' WHERE vac_name ='PCV2' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$rota1_recommended' WHERE vac_name ='Rotavirus2' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$mmr_recommended' WHERE vac_name ='MMR2' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$influenza_recommended' WHERE vac_name ='Influenza2' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$hepa1_recommended' WHERE vac_name ='HepA2' AND cid = $cid_session"
	];
	
	foreach ($updateQueries as $query) {
	    if (mysqli_query($conn, $query)) {
	    	//Do nothing leave it here. for debugging purpose
	    }
	}


}






//compare by appointment date
$rd_dose = mysqli_query($conn, "SELECT DISTINCT a.appt_date, b.dosage_status, c.vac_name FROM appointmenttable a
		LEFT JOIN child_vaccine_status b ON b.cid = a.cid
		LEFT JOIN vaccineinventory c ON c.vacid = a.vacid AND c.active = 1
		WHERE a.cid = $cid_session AND dosage_status = 2") or die('query faile4d');
$rd_dose_data = mysqli_fetch_all($rd_dose, MYSQLI_ASSOC);
foreach($rd_dose_data as $value){
	$last_vaccine = $value['appt_date'];
	$vac_name = $value['vac_name'];
	$dosage_status = $value['dosage_status'];
	$currentdate = date("Y-m-d");
}

if($dosage_status == 2){
	//check if the status of all dosage is 0 if yes get the interval of birthdate from recommended date then check if the current date is greater than reccomended date if yes then the child can take the vaccine.
	$recommended_date = mysqli_query($conn, "
		SELECT DISTINCT
	    a.appt_date AS appt_date,
	    CURDATE() AS `current_date`,
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 1 DAY) THEN '3rd dose'
	        ELSE  'No'
	    END AS bcg_recommended,
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 6 MONTH)  THEN '3rd dose'
	        ELSE 'No'
	    END AS hepb1_recommended, 
	    CASE
	        WHEN CURDATE() >=  DATE_ADD(a.appt_date, INTERVAL 14 WEEK) THEN '3rd dose'
	        ELSE 'No'
	    END AS dtap1_recommended,    
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 14 WEEK) THEN '3rd dose'
	        ELSE 'No'
	    END AS hib1_recommended, 
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 14 WEEK) THEN '3rd dose'
	        ELSE 'No'
	    END AS ipv1_recommended,  
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 14 WEEK) THEN '3rd dose'
	        ELSE 'No'
	    END AS pcv1_recommended,   
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 14 WEEK) THEN '3rd dose'
	        ELSE 'No'
	    END AS rota1_recommended,
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 48 MONTH) THEN '3rd dose'
	        ELSE 'No'
	    END AS mmr_recommended,     
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 12 MONTH)  THEN '3rd dose'
	        ELSE 'No'
	    END AS influenza_recommended,
	    CASE
	        WHEN CURDATE() >= DATE_ADD(a.appt_date, INTERVAL 6 MONTH) THEN '3rd dose'
	        ELSE 'No'
	    END AS hepa1_recommended                            
	FROM appointmenttable a  
		LEFT JOIN child_vaccine_status b ON b.cid = a.cid
		WHERE a.cid = $cid_session AND b.status != 2") or die('query faile3d');
	$recommended = mysqli_fetch_all($recommended_date, MYSQLI_ASSOC);
	foreach($recommended as $value){
		$bcg_recommended = $value['bcg_recommended'];
		$hepb1_recommended = $value['hepb1_recommended'];
		$dtap1_recommended = $value['dtap1_recommended'];
		$hib1_recommended = $value['hib1_recommended'];
		$ipv1_recommended = $value['ipv1_recommended'];
		$pcv1_recommended = $value['pcv1_recommended'];
		$rota1_recommended = $value['rota1_recommended'];
		$mmr_recommended = $value['mmr_recommended'];
		$influenza_recommended = $value['influenza_recommended'];
		$hepa1_recommended = $value['hepa1_recommended'];
	}

	//After checking the reccomended date get the value of the table above the yes or no and update the child_vaccine_status table base on the result of table above.
	// Define and execute each UPDATE query

	$updateQueries = [
	    "UPDATE child_vaccine_status SET recommended_age = '$hepb1_recommended' WHERE vac_name ='HepB3' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$dtap1_recommended' WHERE vac_name ='DTaP3' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$hib1_recommended' WHERE vac_name ='HiB3' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$pcv1_recommended' WHERE vac_name ='PCV3' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$rota1_recommended' WHERE vac_name ='Rotavirus3' AND cid = $cid_session",
	    "UPDATE child_vaccine_status SET recommended_age = '$ipv1_recommended' WHERE vac_name ='IPV3' AND cid = $cid_session",
	];
	
	foreach ($updateQueries as $query) {
	    if (mysqli_query($conn, $query)) {
	    	//Do nothing leave it here. for debugging purpose
	    }
	}


}


	//using the recommended_age that we update above we get the vaccinename and vaccineid where the recommeded age is Yes
	$vaccines = mysqli_query($conn, "
	SELECT DISTINCT
	    c.vac_name,
	    c.vacid,
	    a.cid,
	    b.dosage_status,
	    b.status,
		b.reco_age,
	    a.mothername,
	    b.recommended_age,

	    CASE
	        WHEN b.status = 0 THEN ''
	        WHEN b.status = 1 THEN 'Waiting For Approval'
	        WHEN b.status = 2 THEN 'disabled'
	        WHEN b.recommended_age = 'No' THEN 'disabled'
	        WHEN b.recommended_age = '' THEN 'disabled'
	    END AS status_display
	FROM
	    childtable a
	LEFT JOIN child_vaccine_status b ON a.cid = b.cid
	LEFT JOIN vaccineinventory c ON b.vac_name = c.vac_name AND c.active = 1
	WHERE
	     a.cid = $cid_session AND c.active = 1
	     ORDER BY 
		    CASE
		        WHEN b.status = 1 THEN 1
		        WHEN b.status = 2 THEN 2
		        WHEN b.recommended_age = 'No' THEN 5
		        WHEN b.recommended_age = '' THEN 5
		    END
	     ASC;
	 ") or die('query failed');
	$vaccine_list = mysqli_fetch_all($vaccines, MYSQLI_ASSOC);
	foreach($vaccine_list as $value){
		$vac_name = $value['vac_name'];
		$vac_id = $value['vacid'];
		$cid = $value['cid'];
		$status = $value['status'];
		$mothername = $value['mothername'];
		$dosage_status = $value['dosage_status'];
	}





//Get the Child Information
$select = mysqli_query($conn, "SELECT * FROM childtable a
	LEFT JOIN usertable b ON a.userid = b.userid WHERE b.userid = '$userid' AND a.cid = $cid_session") or die('query fai32led2');
$child_info = mysqli_fetch_all($select, MYSQLI_ASSOC);

foreach($child_info as $info){
	$cid = $info['cid'];
	$child_lname = $info['child_lastname'];
	$child_fname = $info['child_firstname'];
	$child_mname = $info['child_middlename'];
	$birthdate = $info['birthdate'];
	$child_age = $info['child_age'];
	$child_fullname = $child_lname." ".$child_fname;
	//USERTABLE DATA
	$contact = $info['phonenumber'];
	$email = $info['user_email'];
}
?>
