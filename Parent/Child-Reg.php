<?php
include('../templates/Header.php'); 
include '../Homepage/config.php';
$userid = $_SESSION['user_id'];


if (isset($_POST['submit'])) {

    $fname = $conn->real_escape_string($_POST['Child_fname']);
    $lname = $conn->real_escape_string($_POST['Child_lname']);
    $mdname = $conn->real_escape_string($_POST['Childmname']);
    $bday = $conn->real_escape_string($_POST['Child_bdate']);
    $mothername = $conn->real_escape_string($_POST['Child_fthrname']);
    $fathername = $conn->real_escape_string($_POST['Child_mthrname']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $birthDate = new DateTime($bday);
        $today = new DateTime();
        $diff = $today->diff($birthDate);
        $ageInMonths = $diff->y * 12 + $diff->m;
    $sql = "INSERT INTO `childtable`(`userid`, `child_firstname`, `child_lastname`, `child_middlename`, `birthdate`, `mothername`, `fathername`,`gender`,`child_age`) 
            VALUES ('$user_id', '$fname', '$lname', '$mdname', '$bday', '$mothername', '$fathername', '$gender','$ageInMonths')";
    if ($conn->query($sql) === TRUE) {
        $lastid = $conn->insert_id; // ito yung pag kuha ng id nung bagong insert . ito na pangkuha ng id         
        $cid_query = $conn->query("SELECT cid FROM `childtable` WHERE child_firstname = '$fname' AND child_lastname = '$lname'");
        if ($cid_query) {
            $row = $cid_query->fetch_assoc();
            $cid = $row['cid'];


            $rec_age = array(
                "BCG vaccine should be given shortly after birth",
                "First vaccine Hepatitis B should be given after birth",
                "Second vaccine Hepatitis B should be given 1 month after the first dose was taken",
                "Third vaccine Hepatitis B should be given 6 months after the second dose was taken",
                "First DTaP vaccine should be given 6 weeks after birth",
                "Second DTaP vaccine should be given 10 weeks after the first dose was taken",
                "First HiB vaccine should be given 6 weeks after birth",
                "Second HiB vaccine should be given 10 weeks after the first dose was taken",
                "First IPV vaccine should be given 6 weeks after birth",
                "Second IPV vaccine should be given 10 weeks after the first dose was taken",
                "Third IPV vaccine should be 14 weeks after the second dose was taken",
                "First PCV vaccine should be given 6 weeks after birth",
                "Second PCV vaccine should be given 10 weeks after the first dose was taken",
                "First  Rotavirus vaccine should be given 6 weeks after birth",
                "Second Rotavirus vaccine should be given 10 weeks after the first dose was taken",
                "First MMR vaccine should be given 9 months after birth",
                "First Influenza vaccine should be given 6 months after birth",
                "First Hepa vaccine should be given 12 months after birth",
                "Second Hepa vaccine should be given 6 weeks after the first dose was taken",
                "Third DTaP vaccine should be 14 weeks after the second dose was taken",
                "Third  Rotavirus vaccine should be 14 weeks after the second dose was taken",
                "Third HiB vaccine should be 14 weeks after the second dose was taken",
                "Third PCV vaccine should be 14 weeks after the second dose was taken",
                "Second MMR vaccine should be given 2 years after the first dose was taken",
                "Second Influenza vaccine should be given 4 weeks after the first dose was taken"
            );

             // Get the vaccinelist for child_vaccine_status
             $get_vaccine = mysqli_query($conn, "SELECT vac_name FROM vaccineinventory") or die('query failed');
             $get_vaccine_list = mysqli_fetch_all($get_vaccine, MYSQLI_ASSOC);
             $i = 0; 
             foreach($get_vaccine_list as $value){
                $vaccinename = $value['vac_name'];
                $insert_status = "INSERT INTO child_vaccine_status(cid,vac_name,reco_age) VALUES($lastid,'$vaccinename','$rec_age[$i]')";
                mysqli_query($conn,$insert_status);
                $i++;
             }



            if (mysqli_query($conn,$insert_status)) {
                $message[] = 'Registered Successfully!';
            } else {
                $message[] = 'Registration failed!';
            }
        }
    } else {
        $message[] = 'Registration failed!';
    }
}




 elseif(isset($_POST['submit2'])){
    

    $lname = $_POST['Child_lname'];
    $fname = $_POST['Child_fname'];
    $mdname = $_POST['Childmname'];
    $bday = $_POST['Child_bdate'];
    $mothername = $_POST['Child_mthrname']; 
    $fathername = $_POST['Child_fthrname']; 
    $gender = $_POST['gender']; 
 
    $child_name = $fname.' '.$mdname.' '.$lname;
 
    

    $sql = "INSERT INTO `childtable`(`userid`, `child_firstname`, `child_lastname`, `child_middlename`, `birthdate`, `mothername`, `fathername`, `gender`) 
    VALUES ('$user_id','$fname','$lname','$mdname','$bday','$mothername','$fathername','$gender')";
    $conn->query($sql) or die ($conn->error);
    $lastid = $conn->insert_id; // ito yung pag kuha ng id nung bagong insert . ito na pangkuha ng id 
    //bcg
    $reco_bcg = "BCG vaccine should be given shortly after birth";
    //hepb
    $reco_Hepb1 ="First vaccine Hepatitis B should be given after birth";
    $reco_Hepb2 ="Second vaccine Hepatitis B should be given 1 month after the first dose was taken";
    $reco_Hepb3 ="Third vaccine Hepatitis B should be given 6 months after the second dose was taken";
    //dtap
    $reco_DTaP1 ="First DTaP vaccine should be given 6 weeks after birth";
    $reco_DTaP2 ="Second DTaP vaccine should be given 10 weeks after the first dose was taken";
    $reco_DTaP3 ="Third DTaP vaccine should be 14 weeks after the second dose was taken";
    //hib
    $reco_HiB1 ="First HiB vaccine should be given 6 weeks after birth";
    $reco_HiB2 ="Second HiB vaccine should be given 10 weeks after the first dose was taken";
    $reco_HiB3 ="Third HiB vaccine should be 14 weeks after the second dose was taken";
    //IPV
    $reco_IPV1 ="First IPV vaccine should be given 6 weeks after birth";
    $reco_IPV2 ="Second IPV vaccine should be given 10 weeks after the first dose was taken";
    $reco_IPV3 ="Third IPV vaccine should be 14 weeks after the second dose was taken";
    //PCV
    $reco_PCV1 ="First PCV vaccine should be given 6 weeks after birth";
    $reco_PCV2 ="Second PCV vaccine should be given 10 weeks after the first dose was taken";
    $reco_PCV3 ="Third PCV vaccine should be 14 weeks after the second dose was taken";
    //rota
    $reco_Rota1 ="First  Rotavirus vaccine should be given 6 weeks after birth";
    $reco_Rota2 ="Second Rotavirus vaccine should be given 10 weeks after the first dose was taken";
    $reco_Rota3 ="Third  Rotavirus vaccine should be 14 weeks after the second dose was taken";
    //mmr
    $reco_MMR1 ="First MMR vaccine should be given 9 months after birth";
    $reco_MMR2 ="Second MMR vaccine should be given 2 years after the first dose was taken";
    
    //flu
    $reco_Flu1 ="First Influenza vaccine should be given 6 months after birth";
    $reco_Flu2 ="Second Influenza vaccine should be given 4 weeks after the first dose was taken";
    
    //flu
    $reco_Hepa1 ="First Hepa vaccine should be given 12 months after birth";
    $reco_Hepa2 ="Second Hepa vaccine should be given 6 weeks after the first dose was taken";


    //start query
     if ($sql) {
         // Get the vaccinelist for child_vaccine_status
         $get_vaccine = mysqli_query($conn, "SELECT vac_name FROM vaccineinventory") or die('query failed');
         $get_vaccine_list = mysqli_fetch_all($get_vaccine, MYSQLI_ASSOC);
         foreach($get_vaccine_list as $value){
            $vaccinename = $value['vac_name'];
            $insert_status = "INSERT INTO child_vaccine_status(cid,vac_name) VALUES($lastid,'$vaccinename')";
            mysqli_query($conn,$insert_status);
         }



        $cid_query = $conn->query("SELECT cid FROM `childtable` WHERE child_firstname = '$fname' AND child_lastname = '$lname'");

          // ----- BCG TABLE QUERY -------//
          if ($cid_query) {
            $row = $cid_query->fetch_assoc();
            $cid = $row['cid'];  
            $bcg = $_POST['BCG'];
            
            if ($bcg == 0) {
                $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_bcg' WHERE cid = $lastid AND vac_name = 'BCG'";
                mysqli_query($conn,$update_child_vaccine_status1);                            
            } else { 
                $bcg_dose1_date = $_POST['BCG-dose1-date'];

                if(!empty($bcg_dose1_date)){
                    $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 1 , status = 2 , reco_age = '$reco_bcg' WHERE cid = $lastid AND vac_name = 'BCG'";
                    mysqli_query($conn,$update_child_vaccine_status);
                    //Insert BCG Details to Appointment - for checking of last vaccine date - note appointment status = 2 meaning na take na
                    add_last_vaccine_details($userid, $lastid , 'BCG', $bcg_dose1_date , 1, $child_name  , 2);
                }
            }

            $cid_query = $conn->query("SELECT cid FROM `childtable` WHERE child_firstname = '$fname' AND child_lastname = '$lname'");
            if ($cid_query) {
                $row = $cid_query->fetch_assoc();
                $cid = $row['cid'];
            
                $HEPB1 = $_POST['HepB-dose1'];
                $HEPB2 = $_POST['HepB-dose2'];
                $HEPB3 = $_POST['HepB-dose3'];
              
            
                if ($HEPB1 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_Hepb1' WHERE cid = $lastid AND vac_name = 'HepB1'";
                    mysqli_query($conn,$update_child_vaccine_status1);  
                } else { 
                    $HEPB_dose1_date = $_POST['HepB-dose1-date'];
                    if (!empty($HEPB_dose1_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 1 , status = 2 , reco_age = '$reco_Hepb1'
                        WHERE cid = $lastid AND vac_name = 'HepB1'";
                        mysqli_query($conn,$update_child_vaccine_status);  
                        add_last_vaccine_details($userid, $lastid , 'HepB1', $HEPB_dose1_date , 1, $child_name  , 2);
                        
                    } 
                }
               
                if ($HEPB2 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_Hepb2' WHERE cid = $lastid AND vac_name = 'HepB2'";
                    mysqli_query($conn,$update_child_vaccine_status1);  
                } else {
                    $HEPB_dose2_date = $_POST['HepB-dose2-date'];
                    if (!empty($HEPB_dose1_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 2 , status = 2 , reco_age = '$reco_Hepb2' WHERE cid = $lastid AND vac_name = 'HepB2'";
                        mysqli_query($conn,$update_child_vaccine_status);  
                        add_last_vaccine_details($userid, $lastid , 'HepB2', $HEPB_dose2_date , 2, $child_name  , 2);
                    } 
                }

                if ($HEPB3 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_Hepb3' WHERE cid = $lastid AND vac_name = 'HepB3'";
                    mysqli_query($conn,$update_child_vaccine_status1);  
                } else {
                    $HEPB_dose3_date = $_POST['HepB-dose3-date'];
                    if (!empty($HEPB_dose3_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 3 , status = 2 , reco_age = '$reco_Hepb3'  WHERE cid = $lastid AND vac_name = 'HepB3'";
                        mysqli_query($conn,$update_child_vaccine_status);  
                        add_last_vaccine_details($userid, $lastid , 'HepB3', $HEPB_dose3_date , 3, $child_name  , 2);
                    } 
                }

        
            }
            $cid_query = $conn->query("SELECT cid FROM `childtable` WHERE child_firstname = '$fname' AND child_lastname = '$lname'");
            if ($cid_query) {
                $row = $cid_query->fetch_assoc();
                $cid = $row['cid'];
            
                $DTAP1 = $_POST['DTaP-dose1'];
                $DTAP2 = $_POST['DTaP-dose2'];
                $DTAP3 = $_POST['DTaP-dose3'];
             
                if ($DTAP1 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_DTaP1' WHERE cid = $lastid AND vac_name = 'DTaP1'";
                    mysqli_query($conn,$update_child_vaccine_status1);  
                } else {
                    $DTAP_dose1_date = $_POST['DTaP-dose1-date'];
                    if (!empty($DTAP_dose1_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 1 , status = 2 , reco_age = '$reco_DTaP1'  WHERE cid = $lastid AND vac_name = 'DTaP1'";
                        mysqli_query($conn,$update_child_vaccine_status);  
                        add_last_vaccine_details($userid, $lastid , 'DTaP1', $DTAP_dose1_date , 1, $child_name  , 2);
                    }
                }
               

                if ($DTAP2 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_DTaP2' WHERE cid = $lastid AND vac_name = 'DTaP2'";
                    mysqli_query($conn,$update_child_vaccine_status1);  
                } else {
                    $DTAP_dose2_date = $_POST['DTaP-dose2-date'];
                    if (!empty($DTAP_dose2_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 2 , status = 2 , reco_age = '$reco_DTaP2' WHERE cid = $lastid AND vac_name = 'DTaP2'";
                        mysqli_query($conn,$update_child_vaccine_status);  
                        add_last_vaccine_details($userid, $lastid , 'DTaP2', $DTAP_dose2_date , 2, $child_name  , 2);
                    }
                }

                if ($DTAP3 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_DTaP3' WHERE cid = $lastid AND vac_name = 'DTaP3'";
                    mysqli_query($conn,$update_child_vaccine_status1);  
                } else {

                    $DTAP_dose3_date = $_POST['DTaP-dose3-date'];

                    if (!empty($DTAP_dose3_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 3 , status = 2, reco_age = '$reco_DTaP3' WHERE cid = $lastid AND vac_name = 'DTaP3'"; //Wala sa table
                        mysqli_query($conn,$update_child_vaccine_status);  
                        add_last_vaccine_details($userid, $lastid , 'DTaP2', $DTAP_dose2_date , 2, $child_name  , 2);
                    
                    }
                }
            }
            
            $cid_query = $conn->query("SELECT cid FROM `childtable` WHERE child_firstname = '$fname' AND child_lastname = '$lname'");
            if ($cid_query) {
                $row = $cid_query->fetch_assoc();
                $cid = $row['cid'];
            
                $HIB1 = $_POST['Hib-dose1'];
                $HIB2 = $_POST['Hib-dose2'];
                $HIB3 = $_POST['Hib-dose3'];
             
                if ($HIB1 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_HiB1' WHERE cid = $lastid AND vac_name = 'HiB1'";
                    mysqli_query($conn,$update_child_vaccine_status1);
                } else {
                    $HIB_dose1_date = $_POST['Hib-dose1-date'];
                    if (!empty($HIB_dose1_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 1 , status = 2 , reco_age = '$reco_HiB1'WHERE cid = $lastid AND vac_name = 'HiB1'"; //Wala sa table
                        mysqli_query($conn,$update_child_vaccine_status);  
                        add_last_vaccine_details($userid, $lastid , 'HiB1', $HIB_dose1_date , 1, $child_name  , 2);
                    } 
                }
                if ($HIB2 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_HiB2' WHERE cid = $lastid AND vac_name = 'HiB2'";
                    mysqli_query($conn,$update_child_vaccine_status1);  
                } else {
                    $HIB_dose2_date = $_POST['Hib-dose2-date'];
                    if (!empty($HIB_dose2_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 2 , status = 2 , reco_age = '$reco_HiB2' WHERE cid = $lastid AND vac_name = 'HiB2'"; 
                        mysqli_query($conn,$update_child_vaccine_status);  
                        add_last_vaccine_details($userid, $lastid , 'HiB2', $HIB_dose2_date , 2, $child_name  , 2);
                    }
                }

                if ($HIB3 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_HiB3' WHERE cid = $lastid AND vac_name = 'HiB3'";
                    mysqli_query($conn,$update_child_vaccine_status1);  
                } else {

                    $HIB_dose3_date = $_POST['Hib-dose3-date'];

                    if (!empty($HIB_dose3_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 3 , status = 2 , reco_age = '$reco_HiB3'WHERE cid = $lastid AND vac_name = 'HiB3'"; //Wala sa table
                        mysqli_query($conn,$update_child_vaccine_status);  
                        add_last_vaccine_details($userid, $lastid , 'HiB3', $HIB_dose3_date , 3, $child_name  , 2);
                    } 
                }
            }

            $cid_query = $conn->query("SELECT cid FROM `childtable` WHERE child_firstname = '$fname' AND child_lastname = '$lname'");
            if ($cid_query) {
                $row = $cid_query->fetch_assoc();
                $cid = $row['cid'];
            
                $IPV1 = $_POST['iPV-dose1'];
                $IPV2 = $_POST['iPV-dose2'];
                $IPV3 = $_POST['iPV-dose3'];
             
                if ($IPV1 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_IPV1' WHERE cid = $lastid AND vac_name = 'IPV1'";
                    mysqli_query($conn,$update_child_vaccine_status1);  
                } else {
                    $IPV_dose1_date = $_POST['iPV-dose1-date'];
                    if (!empty($IPV_dose1_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 1 , status = 2 , reco_age = '$reco_IPV1' WHERE cid = $lastid AND vac_name = 'IPV1'"; //Wala sa table
                        mysqli_query($conn,$update_child_vaccine_status);  
                        add_last_vaccine_details($userid, $lastid , 'IPV1', $IPV_dose1_date , 1, $child_name  , 2);
                    } 

                }
               

                if ($IPV2 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_IPV2' WHERE cid = $lastid AND vac_name = 'IPV2'";
                    mysqli_query($conn,$update_child_vaccine_status1);  
                } else {
                    $IPV_dose2_date = $_POST['iPV-dose2-date'];
                    if (!empty($IPV_dose2_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 2 , status = 2  reco_age = '$reco_IPV2' WHERE cid = $lastid AND vac_name = 'IPV2'"; 
                        mysqli_query($conn,$update_child_vaccine_status); 
                        add_last_vaccine_details($userid, $lastid , 'IPV2', $IPV_dose2_date , 2, $child_name  , 2); 
                    } 
                }

                if ($IPV3 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_IPV3' WHERE cid = $lastid AND vac_name = 'IPV3'";
                    mysqli_query($conn,$update_child_vaccine_status1);  
                } else {
                    $IPV_dose3_date = $_POST['iPV-dose3-date'];
                    if (!empty($IPV_dose3_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 3 , status = 2  reco_age = '$reco_IPV3'WHERE cid = $lastid AND vac_name = 'IPV3'"; 
                        mysqli_query($conn,$update_child_vaccine_status);  
                        add_last_vaccine_details($userid, $lastid , 'IPV3', $IPV_dose3_date , 3, $child_name  , 2);
                    }
                }
            }

            $cid_query = $conn->query("SELECT cid FROM `childtable` WHERE child_firstname = '$fname' AND child_lastname = '$lname'");
            if ($cid_query) {
                $row = $cid_query->fetch_assoc();
                $cid = $row['cid'];
            
                $PCV1 = $_POST['PCV-dose1'];
                $PCV2 = $_POST['PCV-dose2'];
                $PCV3 = $_POST['PCV-dose3'];
             
                if ($PCV1 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_PCV1' WHERE cid = $lastid AND vac_name = 'PCV1'";
                    mysqli_query($conn,$update_child_vaccine_status1);  
                } else {
                    $PCV_dose1_date = $_POST['PCV-dose1-date'];
                    if (!empty($PCV_dose1_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 1 , status = 2, reco_age = '$reco_PCV1' WHERE cid = $lastid AND vac_name = 'PCV1'"; 
                        mysqli_query($conn,$update_child_vaccine_status);  
                        add_last_vaccine_details($userid, $lastid , 'PCV1', $PCV_dose1_date , 1, $child_name  , 2);
                    }
                }
               

                if ($PCV2 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_PCV2' WHERE cid = $lastid AND vac_name = 'PCV2'";
                    mysqli_query($conn,$update_child_vaccine_status1);  
                } else {
                    $PCV_dose2_date = $_POST['PCV-dose2-date'];
                    if (!empty($PCV_dose2_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 2 , status = 2,  reco_age = '$reco_PCV2' WHERE cid = $lastid AND vac_name = 'PCV2'";
                        mysqli_query($conn,$update_child_vaccine_status);  
                        add_last_vaccine_details($userid, $lastid , 'PCV2', $PCV_dose2_date , 2, $child_name  , 2);
                    }
                }

                if ($PCV3 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_PCV3' WHERE cid = $lastid AND vac_name = 'PCV3'";
                    mysqli_query($conn,$update_child_vaccine_status1);  
                } else {

                    $PCV_dose3_date = $_POST['PCV-dose3-date'];

                    if (!empty($PCV_dose3_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 3 , status = 2,  reco_age = '$reco_PCV3' WHERE cid = $lastid AND vac_name = 'PCV3'"; 
                        mysqli_query($conn,$update_child_vaccine_status);  
                        add_last_vaccine_details($userid, $lastid , 'PCV3', $PCV_dose3_date , 3, $child_name  , 2);
                    }
                }
            }


            $cid_query = $conn->query("SELECT cid FROM `childtable` WHERE child_firstname = '$fname' AND child_lastname = '$lname'");
            if ($cid_query) {
                $row = $cid_query->fetch_assoc();
                $cid = $row['cid'];
            
                $RTAV1 = $_POST['Rota-dose1'];
                $RTAV2 = $_POST['Rota-dose2'];
                $RTAV3 = $_POST['Rota-dose3'];
             
                if ($RTAV1 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_Rota1' WHERE cid = $lastid AND vac_name = 'Rotavirus1'";
                    mysqli_query($conn,$update_child_vaccine_status1);  
                } else {
                    $RTAV_dose1_date = $_POST['Rota-dose1-date'];
                    if (!empty($RTAV_dose1_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 1 , status = 2, reco_age = '$reco_Rota1' WHERE cid = $lastid AND vac_name = 'Rotavirus1'"; //Wala sa table
                        mysqli_query($conn,$update_child_vaccine_status);  
                        add_last_vaccine_details($userid, $lastid , 'Rotavirus1', $RTAV_dose1_date , 1, $child_name  , 2);
                    } 
                }
               

                if ($RTAV2 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_Rota2' WHERE cid = $lastid AND vac_name = 'Rotavirus2'";
                    mysqli_query($conn,$update_child_vaccine_status1);  
                } else {
                    $RTAV_dose2_date = $_POST['Rota-dose2-date'];
                    if (!empty($RTAV_dose2_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 2 , status = 2, reco_age = '$reco_Rota2' WHERE cid = $lastid AND vac_name = 'Rotavirus2'"; //Wala sa table
                        mysqli_query($conn,$update_child_vaccine_status);  
                        add_last_vaccine_details($userid, $lastid , 'Rotavirus2', $RTAV_dose2_date , 2, $child_name  , 2);
                    } 
                }

                if ($RTAV3 == 0) {
                    $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_Rota3' WHERE cid = $lastid AND vac_name = 'Rotavirus3'";
                    mysqli_query($conn,$update_child_vaccine_status1);  
                } else {

                    $RTAV_dose3_date = $_POST['Rota-dose3-date'];

                    if (!empty($RTAV_dose3_date)) {
                        $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 3 , status = 2, reco_age = '$reco_Rota3' WHERE cid = $lastid AND vac_name = 'Rotavirus3'"; 
                        mysqli_query($conn,$update_child_vaccine_status);  
                        add_last_vaccine_details($userid, $lastid , 'Rotavirus3', $RTAV_dose3_date , 3, $child_name  , 2);
                    } 
                }
            }
            
            $cid_query = $conn->query("SELECT cid FROM `childtable` WHERE child_firstname = '$fname' AND child_lastname = '$lname'");
            if ($cid_query) {
            $row = $cid_query->fetch_assoc();
            $cid = $row['cid'];

            $MM1 = $_POST['MMR-dose1'];
            $MM2 = $_POST['MMR-dose2'];

            if ($MM1 == 0) {
                $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_MMR1' WHERE cid = $lastid AND vac_name = 'MMR'";
                mysqli_query($conn,$update_child_vaccine_status1);  
            } else {
                $MMR_dose1_date = $_POST['MMR-dose1-date'];
                if (!empty($MMR_dose1_date)) {
                    $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 1 , status = 2, reco_age = '$reco_MMR1' WHERE cid = $lastid AND vac_name = 'MMR'"; 
                    mysqli_query($conn,$update_child_vaccine_status);  
                    add_last_vaccine_details($userid, $lastid , 'MMR', $MMR_dose1_date , 1, $child_name  , 2);
                }
            }

            if ($MM2 == 0) {
                $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_MMR2' WHERE cid = $lastid AND vac_name = 'MMR2'";
                mysqli_query($conn,$update_child_vaccine_status1);
            } else {
                $MMR_dose2_date = $_POST['MMR-dose2-date'];
                if (!empty($MMR_dose2_date)) {
                    $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 2 , status = 2,  reco_age = '$reco_MMR2' WHERE cid = $lastid AND vac_name = 'MMR2'"; 
                    mysqli_query($conn,$update_child_vaccine_status);  
                    add_last_vaccine_details($userid, $lastid , 'MMR2', $MMR_dose2_date , 2, $child_name  , 2);
                } 
            }


        }

        $cid_query = $conn->query("SELECT cid FROM `childtable` WHERE child_firstname = '$fname' AND child_lastname = '$lname'");
        if ($cid_query) {
            $row = $cid_query->fetch_assoc();
            $cid = $row['cid'];

            $FLU1 = $_POST['flu-dose1'];
            $FLU2 = $_POST['flu-dose2'];
 

            if ($FLU1 == 0) {
                $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_Flu1' WHERE cid = $lastid AND vac_name = 'Influenza'";
                mysqli_query($conn,$update_child_vaccine_status1);  
            } else {
                $FLU_dose1_date = $_POST['flu-dose1-date'];
                if (!empty($FLU_dose1_date)) {
                    $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 1 , status = 2, reco_age = '$reco_Flu1' WHERE cid = $lastid AND vac_name = 'Influenza'"; //Wala sa table
                    mysqli_query($conn,$update_child_vaccine_status);  
                    add_last_vaccine_details($userid, $lastid , 'Influenza', $FLU_dose1_date , 1, $child_name  , 2);
                
                }
            }

            if ($FLU2 == 0) {
                $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_Flu2' WHERE cid = $lastid AND vac_name = 'Influenza2'";
                mysqli_query($conn,$update_child_vaccine_status1);  
            } else {
                $FLU_dose2_date = $_POST['flu-dose2-date'];
                if (!empty($FLU_dose2_date)) {
                    $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 2 , status = 2,  reco_age = '$reco_Flu2' WHERE cid = $lastid AND vac_name = 'Influenza2'"; //Wala sa table
                    mysqli_query($conn,$update_child_vaccine_status);  
                    add_last_vaccine_details($userid, $lastid , 'Influenza2', $FLU_dose2_date , 2, $child_name  , 2);
           
                }
            }

        }

        $cid_query = $conn->query("SELECT cid FROM `childtable` WHERE child_firstname = '$fname' AND child_lastname = '$lname'");
        if ($cid_query) {
            $row = $cid_query->fetch_assoc();
            $cid = $row['cid'];

            $HEPA1 = $_POST['HepA-dose1'];
            $HEPA2 = $_POST['HepA-dose2'];

            if ($HEPA1 == 0) {
                $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_Hepa1' WHERE cid = $lastid AND vac_name = 'HepA1'";
                mysqli_query($conn,$update_child_vaccine_status1);
            } else {
                $HEPA_dose1_date = $_POST['HepA-dose1-date'];
                if (!empty($HEPA_dose1_date)) {
                    $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 1 , status = 2, reco_age = '$reco_Hepa1' WHERE cid = $lastid AND vac_name = 'HepA1'"; //Wala sa table
                    mysqli_query($conn,$update_child_vaccine_status);  
                    add_last_vaccine_details($userid, $lastid , 'HepA1', $HEPA_dose1_date , 1, $child_name  , 2);
                }
            }

            if ($HEPA2 == 0) {
                $update_child_vaccine_status1 = "UPDATE child_vaccine_status SET reco_age = '$reco_Hepa2' WHERE cid = $lastid AND vac_name = 'HepA2'";
                mysqli_query($conn,$update_child_vaccine_status1);  
            } else {
                $HEPA_dose2_date = $_POST['HepA-dose2-date'];
                if (!empty($HEPA_dose2_date)) {
                    $update_child_vaccine_status = "UPDATE child_vaccine_status SET dosage_status = 2 , status = 2,  reco_age = '$reco_Hepa2' WHERE cid = $lastid AND vac_name = 'HepA2'"; //Wala sa table
                    mysqli_query($conn,$update_child_vaccine_status);  
                    add_last_vaccine_details($userid, $lastid , 'HepA2', $HEPA_dose2_date , 2, $child_name  , 2);
     
                }
            }

        }

            

            $message[] = 'Registered Successfully!'; 
     }else{
        $message[] = 'registration failed!';
     }
 }
 }



 function add_last_vaccine_details($userid, $cid, $vac_name, $appt_date, $dose, $child_name, $appointment_status){
    include '../Homepage/config.php';
    //Get the vaci_id of vac_name for apointment table
    $select_vac_id = mysqli_query($conn, "SELECT vacid FROM vaccineinventory a WHERE a.vac_name = '$vac_name'") or die('query failed');
    $get_vac_id = mysqli_fetch_all($select_vac_id, MYSQLI_ASSOC);
    foreach($get_vac_id as $key => $value){
        $vac_id = $value['vacid'];
    }
    //Get details of userid email and fullname
    $select_user_details = mysqli_query($conn, "SELECT firstname,lastname,user_email,phonenumber 
    FROM usertable a WHERE a.userid = '$userid'") or die('query failed');
    $get_user_details = mysqli_fetch_all($select_user_details, MYSQLI_ASSOC);
    foreach($get_user_details as $key => $value1){
        $guardianname = $value1['firstname'].' '.$value1['lastname'];
        $user_email = $value1['user_email'];
        $phonenumber = $value1['phonenumber'];
    }

    //Insert Data in appointmenttable for checking of last vaccine date
    $sql = "INSERT INTO appointmenttable(userid, cid, vacid, appt_date, dose, child_name, guardian_name, email, contact_number, appointment_status) 
    VALUES ($userid, $cid, $vac_id, '$appt_date', $dose, '$child_name', '$guardianname', '$user_email ', '$phonenumber ',  $appointment_status)";
    mysqli_query($conn, $sql);
 }



?>



<link rel="stylesheet" href="./css/style3.css">
</head>


<body>
    <div class="container1">
    <div class="column1">
            
            <?php include('../templates/Parent-Dash.php'); ?> <!------------call side bar template------------>
          </div>
       
        <div class="column">
            <div class="dashboard">
                <img src="./images/Childs Registration.png">
            <div class="dashboard-text">
                <h1>Child Registration</h1>
            </div>
            </div>
            <div class="container">
            <form action="" method="post">
           
                <h2>REGISTER YOUR CHILD</h2>
                <?php
                  if(isset($message)){
                    foreach($message as $message){
                     echo "<script>
                             swal({
                             title: '$message',
                             html: '$message',
                             icon: 'success',
                             confirmButtonText: 'Okay'
            })
        </script>";
         }
      }
      ?> 
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Child's First Name</span>
                        <input type="text" name="Child_fname" placeholder="Enter your child's first name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Child's Last Name</span>
                        <input type="text" name="Child_lname" placeholder="Enter your child's last name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Child's Middle Name</span>
                        <input type="text" name="Childmname" placeholder="Enter your child's middle name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Sex</span>
                        <select name="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>                   
                    <div class="date">
                        <span class="details">Child's Birthdate</span>
                        <input type="date" name="Child_bdate" placeholder="Enter your child's birthdate" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Child's Father's Name</span>
                        <input type="text" name="Child_fthrname" placeholder="Enter child's father's name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Child's Mother's Name</span>
                        <input type="text" name="Child_mthrname" placeholder="Enter child's mother's name" required>
                    </div>
                </div>


                        <!-----------------------------VACCINE QUESTION------------------------------->
                        <div class="question-box">
                            <p>NOTE: If your child has already received at least one (1) vaccine, please fill out the vaccine form below. 
                               This information will help us keep track of your child's vaccination status and 
                               ensure that they are up to date on all recommended vaccines.</p>

            
                             <h4>If your child has not yet received any vaccines, complete your Registration
                             <button type="submit" name="submit"class="btn1">HERE!</button> </h4>

                     <!-----------------------------BCG QUESTION------------------------------->


                     <div class="question-option">
                        <h3>Is your child BCG Vaccinated?</h3>
                        <h4>Dose 1:</h4>
                           <div class="question">
                             <input type="radio" value="0" name="BCG" >
                             <label >No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="BCG-dose1-check-yes" name="BCG" >
                            <label for="">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="BCG-dose1-date">
                        </div>
                    </div>            
                     <!-----------------------------END OF BCG QUESTION-------punta ka dun sa may issue tignan ko nangyayari navigate mo website------------------------>  
                     
                     
                     <!-----------------------------HEPB QUESTION------------------------------->
                   
                     <div class="question-option">
                    <h3>Is your child HepB Vaccinated?</h3>
                    <h4>Dose 1</h4>
                        <div class="question">
                            <input type="radio" value="0" id="HepB-dose1-check-no" name="HepB-dose1" >
                            <label for="HepB-dose1-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="HepB-dose1-check-yes" name="HepB-dose1" >
                            <label for="HepB-dose1-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="HepB-dose1-date" >
                        </div>
                    
                    <h4>Dose 2</h4>
                    
                        <div class="question">
                            <input type="radio" value="0" id="HepB-dose2-check-no" name="HepB-dose2" />
                            <label for="HepB-dose2-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="HepB-dose2-check-yes" name="HepB-dose2" />
                            <label for="HepB-dose2-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="HepB-dose2-date">
                        </div>

                        <h4>Dose 3</h4>
                
                        <div class="question">
                            <input type="radio"  value="0" id="HepB-dose3-check-no" name="HepB-dose3" />
                            <label for="HepB-dose3-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="HepB-dose3-check-yes" name="HepB-dose3" />
                            <label for="HepB-dose3-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="HepB-dose3-date" >
                        </div>
                     </div>


                         <!-----------------------------END OF HEPB QUESTION------------------------------->

                          <!-----------------------------DTAP QUESTION------------------------------->
                          <div class="question-option">
                    <h3>Is your child DTaP Vaccinated?</h3>
                    <h4>Dose 1</h4>
                        <div class="question">
                            <input type="radio" value="0" id="DTaP-dose1-check-no" name="DTaP-dose1" />
                            <label for="DTaP-dose1-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="DTaP-dose1-check-yes" name="DTaP-dose1" />
                            <label for="DTaP-dose1-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="DTaP-dose1-date">
                        </div>
                    
                    <h4>Dose 2</h4>
                  
                        <div class="question">
                            <input type="radio" value="0" id="DTaP-dose2-check-no" name="DTaP-dose2" />
                            <label for="DTaP-dose2-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="DTaP-dose2-check-yes" name="DTaP-dose2" />
                            <label for="DTaP-dose2-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="DTaP-dose2-date" >
                        </div>
                    
                    <h4>Dose 3</h4>
                    
                        <div class="question">
                            <input type="radio" value="0" id="DTaP-dose3-check-no" name="DTaP-dose3" />
                            <label for="DTaP-dose3-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="DTaP-dose3-check-yes" name="DTaP-dose3" />
                            <label for="DTaP-dose3-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="DTaP-dose3-date" >
                        </div>
                    
                    </div>

                          <!-----------------------------END OF DTAP QUESTION------------------------------->

                            <!---------------------------- HIB QUESTION------------------------------->
                            <div class="question-option">
                    <h3>Is your child Hib Vaccinated?</h3>
                    <h4>Dose 1</h4>
                        <div class="question">
                            <input type="radio" value="0" id="Hib-dose1-check-no" name="Hib-dose1" />
                            <label for="Hib-dose1-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="Hib-dose1-check-yes" name="Hib-dose1" />
                            <label for="Hib-dose1-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="Hib-dose1-date">
                        </div>
                    
                    <h4>Dose 2</h4>
                        <div class="question">
                            <input type="radio" value="0" id="Hib-dose2-check-no" name="Hib-dose2" />
                            <label for="Hib-dose2-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="Hib-dose2-check-yes" name="Hib-dose2" />
                            <label for="Hib-dose2-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="Hib-dose2-date" >
                        </div>
                    
                    <h4>Dose 3</h4>
                        <div class="question">
                            <input type="radio" value="0" id="Hib-dose3-check-no" name="Hib-dose3" />
                            <label for="Hib-dose3-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="Hib-dose3-check-yes" name="Hib-dose3" />
                            <label for="Hib-dose3-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="Hib-dose3-date" >
                        </div>     
                    </div>

                          <!----------------------------EBD OF HIB QUESTION------------------------------->
                        <!---------------------------- IPV QUESTION------------------------------->

                    <div class="question-option">
                        <h3>Is your child iPV Vaccinated?</h3>
                        <h4>Dose 1</h4>
                        <div class="question">
                            <input type="radio" value="0" id="iPV-dose1-check-no" name="iPV-dose1" />
                            <label for="iPV-dose1-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="iPV-dose1-check-yes" name="iPV-dose1" />
                            <label for="iPV-dose1-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="iPV-dose1-date">
                        </div>
                        <h4>Dose 2</h4>
                        <div class="question">
                            <input type="radio" value="0"id="iPV-dose2-check-no" name="iPV-dose2" />
                            <label for="iPV-dose2-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="iPV-dose2-check-yes" name="iPV-dose2" />
                            <label for="iPV-dose2-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="iPV-dose2-date">
                        </div>
                        <h4>Dose 3</h4>
                        <div class="question">
                            <input type="radio" value="0" id="iPV-dose3-check-no" name="iPV-dose3" />
                            <label for="iPV-dose3-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="iPV-dose3-check-yes" name="iPV-dose3" />
                            <label for="iPV-dose3-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="iPV-dose3-date">
                        </div>
                    </div>

                          <!---------------------------- END OF IPV QUESTION------------------------------->                          
                         
                          <!---------------------------- PCV QUESTION------------------------------->

                   
                            <div class="question-option">
                            <h3>Is your child PCV Vaccinated?</h3>
                            <h4>Dose 1</h4>
                            <div class="question">
                                <input type="radio" value="0" id="PCV-dose1-check-no" name="PCV-dose1" />
                                <label for="PCV-dose1-check-no">No</label>
                            </div>
                            <div class="question">
                                <input type="radio" value="1" id="PCV-dose1-check-yes" name="PCV-dose1" />
                                <label for="PCV-dose1-check-yes">Yes</label>
                            </div>
                            <div class="date">
                                <span class="details">If yes, input vaccination date</span>
                                <input type="date" name="PCV-dose1-date">
                            </div>
                            <h4>Dose 2</h4>
                            <div class="question">
                                <input type="radio" value="0" id="PCV-dose2-check-no" name="PCV-dose2" />
                                <label for="PCV-dose2-check-no">No</label>
                            </div>
                            <div class="question">
                                <input type="radio" value="1" id="PCV-dose2-check-yes" name="PCV-dose2" />
                                <label for="PCV-dose2-check-yes">Yes</label>
                            </div>
                            <div class="date">
                                <span class="details">If yes, input vaccination date</span>
                                <input type="date" name="PCV-dose2-date">
                            </div>
                            <h4>Dose 3</h4>
                            <div class="question">
                                <input type="radio" value="0" id="PCV-dose3-check-no" name="PCV-dose3" />
                                <label for="PCV-dose3-check-no">No</label>
                            </div>
                            <div class="question">
                                <input type="radio" value="1" id="PCV-dose3-check-yes" name="PCV-dose3" />
                                <label for="PCV-dose3-check-yes">Yes</label>
                            </div>
                            <div class="date">
                                <span class="details">If yes, input vaccination date</span>
                                <input type="date" name="PCV-dose3-date">
                            </div>
                            </div>


                          <!----------------------------END PCV QUESTION------------------------------->

                          
                          <!---------------------------- ROTAV QUESTION------------------------------->


                            <div class="question-option">                                
                        <h3>Is your child Rotavirus Vaccinated?</h3>
                        <h4>Dose 1</h4>
                        <div class="question">
                            <input type="radio" value="0" id="Rota-dose1-check-no" name="Rota-dose1" />
                            <label for="Rota-dose1check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="Rota-dose1-check-yes" name="Rota-dose1" />
                            <label for="Rota-dose1-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="Rota-dose1-date">
                        </div>

                        <h4>Dose 2</h4>
                        <div class="question">
                            <input type="radio" value="0" id="Rota-dose2-check-no" name="Rota-dose2" />
                            <label for="Rota-dose2-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="Rota-dose2-check-yes" name="Rota-dose2" />
                            <label for="Rota-dose2-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="Rota-dose2-date">
                        </div>

                        <h4>Dose 3</h4>
                        <div class="question">
                            <input type="radio" value="0" id="Rota-dose3-check-no" name="Rota-dose3" />
                            <label for="Rota-dose3-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="Rota-dose3-check-yes" name="Rota-dose3" />
                            <label for="Rota-dose3-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="Rota-dose3-date">
                        </div>
                    </div>

                          <!---------------------------- END OF ROTAV QUESTION------------------------------->
                           <!---------------------------- MMR QUESTION------------------------------->

                        <div class="question-option">
                        <h3>Is your child MMR Vaccinated?</h3>
                        <h4>Dose 1</h4>
                        <div class="question">
                            <input type="radio" value="0" id="MMR-dose1-check-no" name="MMR-dose1" />
                            <label for="MMR-dose1-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="MMR-dose1-check-yes" name="MMR-dose1" />
                            <label for="MMR-dose1-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="MMR-dose1-date">
                        </div>

                        <h4>Dose 2</h4>
                        <div class="question">
                            <input type="radio" value="0" id="MMR-dose2-check-no" name="MMR-dose2" />
                            <label for="MMR-dose2-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="MMR-dose2-check-yes" name="MMR-dose2" />
                            <label for="MMR-dose2-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="MMR-dose2-date">
                        </div>
                    </div>


                     <!----------------------------END OF MMR QUESTION------------------------------->

                     <!----------------------------INFLUENZA QUESTION------------------------------->

                    <div class="question-option">         
                        <h3>Is your child Influenza Vaccinated?</h3>
                        <h4>Dose 1</h4>
                        <div class="question">
                            <input type="radio" value="0" id="flu-dose1-check-no" name="flu-dose1" />
                            <label for="flu-dose1-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="flu-dose1-check-yes" name="flu-dose1" />
                            <label for="flu-dose1-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="flu-dose1-date">
                        </div>
                        
                        <h4>Dose 2</h4>
                        <div class="question">
                            <input type="radio" value="0" id="flu-dose2-check-no" name="flu-dose2" />
                            <label for="flu-dose2-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="flu-dose2-check-yes" name="flu-dose2" />
                            <label for="flu-dose2-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="flu-dose2-date">
                        </div>
                    </div>

                     <!----------------------------END OF INFLUENZA QUESTION------------------------------->
                     <!----------------------------HEP A QUESTION------------------------------->

                        <div class="question-option">
                        <h3>Is your child HepA Vaccinated?</h3>
                        <h4>Dose 1</h4>
                        <div class="question">
                            <input type="radio" value="0" id="HepA-dose1-check-no" name="HepA-dose1" />
                            <label for="HepA-dose1-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="HepA-dose1-check-yes" name="HepA-dose1" />
                            <label for="HepA-dose1-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="HepA-dose1-date">
                        </div>
                        <h4>Dose 2</h4>
                        <div class="question">
                            <input type="radio" value="0"id="HepA-dose2-check-no" name="HepA-dose2" />
                            <label for="HepA-dose2-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" value="1" id="HepA-dose2-check-yes" name="HepA-dose2" />
                            <label for="HepA-dose2-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="HepA-dose2-date">
                        </div>
                    </div>


                        <!----------------------------HEP A QUESTION------------------------------->



                    <button type="submit" name="submit2" class="btn">REGISTER</button>



                   
                    
             
</form>
</body>
</html>
