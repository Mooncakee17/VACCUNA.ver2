
<?php 

include '../Homepage/config.php';
include'../templates/Header.php';

if(isset($_GET['id'])){
  $cid = mysqli_real_escape_string($conn, $_GET['id']);
  $record =  "SELECT * FROM `childtable` WHERE cid = $cid";
  $record_run = mysqli_query($conn, $record);
  if ($record_run) {
    // Fetch all rows from the result set
    while ($row = mysqli_fetch_assoc($record_run)) {
        $rows[] = $row; // Append each row to the $rows array
    }
} else {
    // Handle query execution error
    $error_message = "Error fetching data: " . mysqli_error($conn);
}
} else {
// Handle the case when 'cid' is not set
$error_message = "No CID provided";
}

if (isset($_POST['updateprofile'])) {
    // Your database connection setup here ($conn)

    $update_mothername = mysqli_real_escape_string($conn, $_POST['update_mothername']);
    $update_birthdate = mysqli_real_escape_string($conn, $_POST['update_birthdate']);
    $update_fathername = mysqli_real_escape_string($conn, $_POST['update_fathername']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $update_firstname = mysqli_real_escape_string($conn, $_POST['update_firstname']);
    $update_lastname = mysqli_real_escape_string($conn, $_POST['update_lastname']);

    $update_query = "UPDATE `childtable` SET child_firstname = '$update_firstname', child_lastname = '$update_lastname', gender = '$gender', mothername ='$update_mothername', fathername ='$update_fathername', birthdate = '$update_birthdate' WHERE cid = '$cid'";

    $result = mysqli_query($conn, $update_query);

    if ($result) {
        $message[] = 'Updated successfully!';
        // Redirect to the current page to reload the updated data
        header("Location: " . $_SERVER['REQUEST_URI']);
    } else {
        $message[] = 'Failed to update profile: ' . mysqli_error($conn); // Capture and display MySQL error if any
    }
}
?>
<link rel="stylesheet" href="./css/style5.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="path_to_sweetalert2.js"></script>

<body>
<div class="container1">
        <div class="column1">
          <?php include('../templates/Admin-Dash.php'); ?> <!------------call side bar template------------>
        </div>

        <div class="column">
            <div class="dashboard">
                <img src="./images/Immunization Record.png">
            <div class="dashboard-text">
                    
                <h1>IMMUNIZATION RECORDS </h1>
               
            </div>
            </div>
            <?php
                  if(isset($message)){
                    foreach($message as $message){
                     echo "<script>
                             swal({
                             title: '$message',
                             html: '$message',
                             
                             confirmButtonText: 'Okay'
            })
        </script>";
         }
      }
      ?>
            <form action="" method="post" enctype="multipart/form-data">
            <a href ="Report-Details.php?id=<?= $cid; ?>"  style="margin-bottom: 1100px; padding: 5px 10px;
                                                                margin-left: 100px;
                                                                width: 10%;
                                                                font-size: 16px;
                                                                background-color: #8860D0;
                                                                color: #fff;
                                                                font-family:Poppins;
                                                                border: none;
                                                                border-radius: 10px;
                                                                cursor: pointer;" > <i class="fa fa-step-backward"> Back</i></a>
            
           <div id="Report-Details">
              <div class="ReportDetails-content">
              <?php if(isset($error_message)) { ?>
                        <p><?php echo $error_message; ?></p>
                    <?php } else { ?>
                        <?php if(!empty($rows)) { ?>
                            <?php foreach($rows as $row) { ?>
                    <div class="header">
                        <input type="text" name="update_firstname" value="<?php echo $row['child_firstname']; ?>" class="box">
                        <input type="text" name="update_lastname" value="<?php echo $row['child_lastname']; ?>" class="box">
                        <img src="./images/Baby Profile.png" alt="">
                    </div>
                    <input type="submit" id="editButton" value="Save" name="updateprofile" >
                    
                    <div class="title">
                        <h2>PERSONAL INFORMATION</h2>
                    </div>
                    <?php } ?>
                        <?php } else { ?>
                            <p>No records found</p>
                        <?php } ?>
                    <?php } ?>
                    <div class="editable-info">
                      <p><span class="label">Age</span> <span id="age" contenteditable="false">0</span></p>
                      <p><span class="label">Gender</span> <span id="gender" > <select name="gender" id="gender" >
                                                                                <option><?php echo $row['gender']; ?></option>
                                                                                <option value="Female">Female</option>
                                                                                <option value="Male">Male</option>
                                                                                </select></span></p>
                      <p><span class="label">Birth Date</span> <span id="birthDate" contenteditable="false"><input type="date"name="update_birthdate" value="<?php echo $row['birthdate']; ?>" class="box"></span></p>
                      <p><span class="label">Address</span> <span id="address" contenteditable="false">Santa Mesa, Manila</span></p>
                      <p><span class="label">Mother's Name</span> <span id="mother'sName" contenteditable="false"><input type="text"name="update_mothername" value="<?php echo $row['mothername']; ?>" class="box"></span></p>
                      <p><span class="label">Father's Name</span> <span id="father'sName" contenteditable="false"><input type="text"name="update_fathername" value="<?php echo $row['fathername']; ?>" class="box"></span></p>
                    </div>
                    <a  href="Update-Report-Details.php?id=<?= $row['cid']; ?>" style="margin-top: 10px; text-align:center;" id="editVaccineButton" onclick="enableVaccineEdit()">Edit</a>
                        </form>
                    <div class="title">
                        <h2>VACCINE INFORMATION</h2>
                    </div>
                    
                    <div class="modal-table">
                      <div class="modal-table_section">
                          <table>
                              <thead>
                                  <tr>
                                      <th>VACCINE</th>
                                      <th>STATUS</th>
                                      <th>DATE</th>
                                      <th>ADMINISTRATOR</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>BCG Dose 1</td>
                                      <td>YES</td>
                                      <td>02/03/23</td>
                                      <td>Dr. Marijo Pedian</td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="modal-table">
                      <div class="modal-table_section">
                          <table>
                              <thead>
                                  <tr>
                                      <th>VACCINE</th>
                                      <th>STATUS</th>
                                      <th>DATE</th>
                                      <th>ADMINISTRATOR</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>HepB Dose 1</td>
                                      <td>YES</td>
                                      <td>02/03/23</td>
                                      <td>Dr. Marijo Pedian</td>
                                  </tr>
                                  <tr>
                                      <td>HepB Dose 2</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>HepB Dose 3</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr><tr>
                                      <td>HepB Dose 4</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="modal-table">
                      <div class="modal-table_section">
                          <table>
                              <thead>
                                  <tr>
                                      <th>VACCINE</th>
                                      <th>STATUS</th>
                                      <th>DATE</th>
                                      <th>ADMINISTRATOR</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>DTaP Dose 1</td>
                                      <td>YES</td>
                                      <td>02/03/23</td>
                                      <td>Dr. Marijo Pedian</td>
                                  </tr>
                                  <tr>
                                      <td>DTaP Dose 2</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>DTaP Dose 3</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>DTaP Booster 1</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>DTaP Booster 2</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="modal-table">
                      <div class="modal-table_section">
                          <table>
                              <thead>
                                  <tr>
                                      <th>VACCINE</th>
                                      <th>STATUS</th>
                                      <th>DATE</th>
                                      <th>ADMINISTRATOR</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>Hib Dose 1</td>
                                      <td>YES</td>
                                      <td>02/03/23</td>
                                      <td>Dr. Marijo Pedian</td>
                                  </tr>
                                  <tr>
                                      <td>Hib Dose 2</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>Hib Dose 3</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>Hib Booster</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="modal-table">
                      <div class="modal-table_section">
                          <table>
                              <thead>
                                  <tr>
                                      <th>VACCINE</th>
                                      <th>STATUS</th>
                                      <th>DATE</th>
                                      <th>ADMINISTRATOR</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>iPV Dose1</td>
                                      <td>YES</td>
                                      <td>02/03/23</td>
                                      <td>Dr. Marijo Pedian</td>
                                  </tr>
                                  <tr>
                                      <td>iPV Dose 2</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>iPV Dose 3</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>iPV Booster 1</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>iPV Booster 2</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="modal-table">
                      <div class="modal-table_section">
                          <table>
                              <thead>
                                  <tr>
                                      <th>VACCINE</th>
                                      <th>STATUS</th>
                                      <th>DATE</th>
                                      <th>ADMINISTRATOR</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>PCV Dose 1</td>
                                      <td>YES</td>
                                      <td>02/03/23</td>
                                      <td>Dr. Marijo Pedian</td>
                                  </tr>
                                  <tr>
                                      <td>PCV Dose 2</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>PCV Dose 3</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>PCV Dose 4</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="modal-table">
                      <div class="modal-table_section">
                          <table>
                              <thead>
                                  <tr>
                                      <th>VACCINE</th>
                                      <th>STATUS</th>
                                      <th>DATE</th>
                                      <th>ADMINISTRATOR</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>Rotavirus Dose 1</td>
                                      <td>YES</td>
                                      <td>02/03/23</td>
                                      <td>Dr. Marijo Pedian</td>
                                  </tr>
                                  <tr>
                                      <td>Rotavirus Dose 2</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>Rotavirus Dose 3</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="modal-table">
                      <div class="modal-table_section">
                          <table>
                              <thead>
                                  <tr>
                                      <th>VACCINE</th>
                                      <th>STATUS</th>
                                      <th>DATE</th>
                                      <th>ADMINISTRATOR</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>MMR Dose 1</td>
                                      <td>YES</td>
                                      <td>02/03/23</td>
                                      <td>Dr. Marijo Pedian</td>
                                  </tr>
                                  <tr>
                                      <td>MMR Dose 2</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="modal-table">
                      <div class="modal-table_section">
                          <table>
                              <thead>
                                  <tr>
                                      <th>VACCINE</th>
                                      <th>STATUS</th>
                                      <th>DATE</th>
                                      <th>ADMINISTRATOR</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>Influenza Dose 1</td>
                                      <td>YES</td>
                                      <td>02/03/23</td>
                                      <td>Dr. Marijo Pedian</td>
                                  </tr>
                                  <tr>
                                      <td>Influenza Dose 2</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>Influenza Dose 3</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>Influenza Dose 4</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="modal-table">
                      <div class="modal-table_section">
                          <table>
                              <thead>
                                  <tr>
                                      <th>VACCINE</th>
                                      <th>STATUS</th>
                                      <th>DATE</th>
                                      <th>ADMINISTRATOR</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>HepA Dose 1</td>
                                      <td>YES</td>
                                      <td>02/03/23</td>
                                      <td>Dr. Marijo Pedian</td>
                                  </tr>
                                  <tr>
                                      <td>HepA Dose 2</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>HepA Dose 3</td>
                                      <td>NO</td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                    </div>
                    
              </div>
          </div>                 
</div>
</div>
</div>
           
             
  
    
   

</body>
</html>