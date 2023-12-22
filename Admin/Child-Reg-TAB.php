
<?php 
include('../templates/Header.php'); 
if(isset($_GET['id'])){
  $user_id = mysqli_real_escape_string($conn, $_GET['id']);
    if (isset($_POST['submit1'])) {

        $fname = $conn->real_escape_string($_POST['Child_fname']);
        $lname = $conn->real_escape_string($_POST['Child_lname']);
        $mdname = $conn->real_escape_string($_POST['Childmname']);
        $bday = $conn->real_escape_string($_POST['Child_bdate']);
        $mothername = $conn->real_escape_string($_POST['Child_fthrname']);
        $fathername = $conn->real_escape_string($_POST['Child_mthrname']);
        $gender = $conn->real_escape_string($_POST['gender']);
    
        $sql = "INSERT INTO `childtable`(`userid`, `child_firstname`, `child_lastname`, `child_middlename`, `birthdate`, `mothername`, `fathername`,`gender`) 
                VALUES ('$user_id', '$fname', '$lname', '$mdname', '$bday', '$mothername', '$fathername', '$gender')";
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
  } else {
    $message[] = 'User ID not found!';
    exit;
  }




 
?>

<link rel="stylesheet" href="./css/child-reg.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

<body>
<div class="container1">
        <div class="column1">
          <?php include('../templates/Admin-Dash.php'); ?> <!------------call side bar template------------>
        </div>

        <div class="column">
            <div class="dashboard">
                <img src="./images/Immunization Record.png">
            <div class="dashboard-text">
                    
                <h1>IMMUNIZATION RECORDS</h1>
               
            </div>
            </div>
            <form action="" method="post">
           
           <div class="child-reg" >
           <p >REGISTER CHILD</p>
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
           <div class="user-details" >
           
                    <div class="userdetails1">
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
                    <div class="date">
                        <span class="details">Child's Birthdate</span>
                        <input type="date" name="Child_bdate" placeholder="Enter your child's birthdate" required>
                    </div>
                    </div>
                    <div class="userdetails2">
                    <div class="input-box">
                        <span class="details">Child's Father's Name</span>
                        <input type="text" name="Child_fthrname" placeholder="Enter child's father's name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Child's Mother's Name</span>
                        <input type="text" name="Child_mthrname" placeholder="Enter child's mother's name" required>
                    </div>
                    <div class="input-box">
                    <span class="details">Sex</span>
                        <select id="cars" name="gender">
                        
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                    </div>
                    </div>
                    </div>
                    <button type="submit" style="   width: 50%;
                                                    justify-content: center;
                                                    height: 80%;
                                                    margin-left:260px;
                                                    background:#8860D0 ;
                                                    border: none;
                                                    outline: none;
                                                    border: 1px solid #8860D0;
                                                    border-radius: 10px;
                                                    font-size: 14px;
                                                    color: white;
                                                    padding: 10px 20px;
                                                    transition: color 0.3s, border-color 0.3s;" name="submit1"class="btn1">REGISTER</button>
                </div>
            </form>
                     </div>                    
               </div>
        </div>
</div>
           
                    
  
    
   

</body>
</html>