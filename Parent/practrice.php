

<?php include('../templates/Header.php'); // --- andito yung session code ---

//------------------Eto backend pag yung 'here' button yung pipindutin------------//

 if(isset($_POST['submit'])){

    $fname = $_POST['Child_fname'];
    $lname = $_POST['Child_lname'];
    $fname = $_POST['Child_fname'];
    $mdname = $_POST['Childmname'];
    $bday = $_POST['Child_bdate'];
    $mothername = $_POST['Child_fthrname'];
    $fathername = $_POST['Child_mthrname'];

    $sql = "INSERT INTO `childtable`(`userid`, `child_firstname`, `child_lastname`, `child_middlename`, `birthdate`, `mothername`, `fathername`) 
    VALUES ('$user_id','$fname','$lname','$mdname','$bday','$mothername','$fathername')";
    
     $conn->query($sql) or die ($conn->error);
     if ($sql) {

        $cid_query = $conn->query("SELECT cid FROM `childtable` WHERE child_firstname = '$fname' AND child_lastname = '$lname'");
            if ($cid_query) {
                $row = $cid_query->fetch_assoc();
                $cid = $row['cid'];
                
                $sql = "INSERT INTO `vac_bcg_table`(`cid`) VALUES ('$cid')";
                $result = $conn->query($sql);
        }

        $message[] = 'Registered Successfully!'; 
     }else{
        $message[] = 'registration failed!';
     }
 }

//------------------Eto backend pag yung 'Register' button yung pipindutin------------//

 elseif(isset($_POST['submit2'])){
    $fname = $_POST['Child_fname'];
    $lname = $_POST['Child_lname'];
    $fname = $_POST['Child_fname'];
    $mdname = $_POST['Childmname'];
    $bday = $_POST['Child_bdate'];
    $mothername = $_POST['Child_fthrname'];
    $fathername = $_POST['Child_mthrname'];

    $sql = "INSERT INTO `childtable`(`userid`, `child_firstname`, `child_lastname`, `child_middlename`, `birthdate`, `mothername`, `fathername`) 
    VALUES ('$user_id','$fname','$lname','$mdname','$bday','$mothername','$fathername')";
    
     $conn->query($sql) or die ($conn->error);
     if ($sql) {
        $cid_query = $conn->query("SELECT cid FROM `childtable` WHERE child_firstname = '$fname' AND child_lastname = '$lname'");

          // ----- BCG TABLE QUERY -------//
          if ($cid_query) {
            $row = $cid_query->fetch_assoc();
            $cid = $row['cid'];  
            $bcg = $_POST['BCG'];

            if ($bcg == 0) {
                $sql = "INSERT INTO `vac_bcg_table`(`cid`, `dose1`) VALUES ('$cid', '$bcg')";
            } else { 
                $bcg_dose1_date = $_POST['BCG-dose1-date'];

                if(!empty($bcg_dose1_date)){
                    $sql = "INSERT INTO `vac_bcg_table`(`cid`, `dose1`, `dose1_date`) VALUES ('$cid', '$bcg', '$bcg_dose1_date')";
                    
                }
                else{
                    $sql = "INSERT INTO `vac_bcg_table`(`cid`, `dose1`) VALUES ('$cid', '$bcg')";
                }
                $result = $conn->query($sql);
            }

            $cid_query = $conn->query("SELECT cid FROM `childtable` WHERE child_firstname = '$fname' AND child_lastname = '$lname'");
            if ($cid_query) {  
                $row = $cid_query->fetch_assoc();
                $cid = $row['cid'];
    
                $HEPB1 = $_POST['HepB-dose1'];
                $HEPB2 = $_POST['HepB-dose2'];
              
    
                if ($HEPB1 == 0) {
                    $sql1 = "INSERT INTO `vac_hepb_table`(`cid`, `dose1`) VALUES ('$cid', '$HEPB1')";
                } else { 
                    $HEPB_dose1_date = $_POST['HepB-dose1-date'];
                    $HEPB_dose2_date = $_POST['HepB-dose2-date'];
                    if(!empty($HEPB_dose1_date)|| is_null($HEPB_dose1_date)){
                        $sql1 = "INSERT INTO `vac_hepb_table`(`dose1_date`) VALUES ('$HEPB_dose1_date') 
                        WHERE cid == '$cid', dose1 == '$HEPB1', dose2=='$HEPB2' dose2_date =='$HEPB_dose2_date'";                    
                    }
                    if(!empty($HEPB_dose2_date)|| is_null($HEPB_dose2_date)){
                        $sql1 = "INSERT INTO `vac_hepb_table`(`dose2_date`) VALUES ('$HEPB_dose2_date') 
                        WHERE cid == '$cid', dose1 == '$HEPB1', dose2=='$HEPB2' dose1_date =='$HEPB_dose1_date'";                    
                    }
                    $result = $conn->query($sql1);
                }
               
            }
            $message[] = 'Registered Successfully!'; 
     }else{
        $message[] = 'registration failed!';
     }
 }
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
                    

                    <button type="submit" name="submit2" class="btn">REGISTER</button>

                         <!-----------------------------END OF BCG QUESTION------------------------------->

                         
                    <!-----------------------------HEPB QUESTION------------------------------->
                   
                    <div class="question-option">
                    <h3>Is your child HepB Vaccinated?</h3>
                    <h4>Dose 1</h4>
                        <div class="question">
                            <input type="radio" id="HepB-dose1-check-no" name="HepB-dose1" >
                            <label for="HepB-dose1-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" id="HepB-dose1-check-yes" name="HepB-dose1" >
                            <label for="HepB-dose1-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="HepB-dose1-date" required>
                        </div>
                    
                    <h4>Dose 2</h4>
                    
                        <div class="question">
                            <input type="radio" id="HepB-dose2-check-no" name="HepB-dose2" />
                            <label for="HepB-dose2-check-no">No</label>
                        </div>
                        <div class="question">
                            <input type="radio" id="HepB-dose2-check-yes" name="HepB-dose2" />
                            <label for="HepB-dose2-check-yes">Yes</label>
                        </div>
                        <div class="date">
                            <span class="details">If yes, input vaccination date</span>
                            <input type="date" name="HepB-dose2-date" required>
                        </div>
                    
                    </div>

                         <!-----------------------------END OF HEPB QUESTION------------------------------->
                    
             
</form>
</body>
</html>