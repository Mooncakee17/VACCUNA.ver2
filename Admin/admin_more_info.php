
<?php 
include('../templates/Header.php'); 
if(isset($_GET['id'])){
  $cid = $_GET['id'];
  $record =  "SELECT * FROM `childtable` a
  LEFT JOIN usertable b ON a.userid = b.userid WHERE a.cid = $cid";
  $record_run = mysqli_query($conn, $record);
  $row = mysqli_fetch_all($record_run,MYSQLI_ASSOC);
  foreach($row as $value){
    $name = $value['child_firstname'].' '.$value['child_lastname'];
    $child_age = $value['child_age'];
    $gender = $value['gender'];
    $birthdate = $value['birthdate'];
    $mothername = $value['mothername'];
    $fathername = $value['fathername'];
    $phonenumber = $value['phonenumber'];
  }
}
?>
<link rel="stylesheet" href="../Admin/css/style5.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

<body>
<div class="container1">
        <div class="column1">
          <?php include('../templates/Admin-Dash.php'); ?> <!------------call side bar template------------>
        </div>

        <div class="column">           
           <div id="Report-Details">
              <div class="ReportDetails-content">
                    <div class="header">
                        <h2><?php echo  $name ; ?></h2>
                        <img src="./images/Baby Profile.png" alt="">
                    </div>
                    <button id="editButton" onclick="enableEdit()">Edit</button>
                    <button id="saveButton" onclick="saveChanges()" style="display: none;">Save</button>
                    <div class="title">
                        <h2>PERSONAL INFORMATION</h2>
                    </div>
                    <div class="editable-info">
                      <p><span class="label">Age</span> <span id="age" contenteditable="false"><?php echo  $child_age ; ?></span></p>
                      <p><span class="label">Gender</span> <span id="gender" contenteditable="false"><?php echo  $gender ; ?></span></p>
                      <p><span class="label">Birth Date</span> <span id="birthDate" contenteditable="false"><?php echo  $birthdate ; ?></span></p>
                      <p><span class="label">Mother's Name</span> <span id="mother'sName" contenteditable="false"><?php echo  $mothername ; ?></span></p>
                      <p><span class="label">Father's Name</span> <span id="father'sName" contenteditable="false"><?php echo  $fathername ; ?></span></p>
                      <p><span class="label">Contact Number</span> <span id="contactNumber" contenteditable="false"><?= $phonenumber; ?></span></p>
                    </div>
                    <button id="editVaccineButton" onclick="enableVaccineEdit()">Edit</button>
                    <button id="saveVaccineButton" onclick="saveVaccineChanges()" style="display: none;">Save</button>
        <?php 
            //get child vaccine record
            $bcg = mysqli_query($conn, "SELECT  DISTINCT    
            CASE
            WHEN a.status = 2 AND c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is null THEN 'NO'
            WHEN a.status = 0 AND c.appt_date is null THEN 'NO'
            WHEN a.status = 1 AND c.appt_date is null THEN 'NO'
            END AS vaccine_status,
            a.vac_name,
            c.vaccine_administer,
            c.appt_date
            FROM child_vaccine_status a 
            LEFT JOIN vaccineinventory b ON a.vac_name = b.vac_name AND b.active = 1
            LEFT JOIN appointmenttable c ON c.vacid = b.vacid AND c.cid = '$cid' AND c.appt_date is not null
            WHERE a.cid = '$cid' AND b.vac_name = 'BCG'
            ORDER BY 
            CASE
            WHEN a.status = 2 AND c.appt_date is not null AND c.vaccine_administer is not null THEN 0
            WHEN a.status = 0 AND c.appt_date is not null AND c.vaccine_administer is not null THEN 2
            WHEN a.status = 1 AND c.appt_date is not null AND c.vaccine_administer is not null THEN 1
            END DESC") or die('query failed');
            $bcg_record = mysqli_fetch_all($bcg, MYSQLI_ASSOC);  
        ?>           


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
                                  <?php foreach($bcg_record as $value){?>
                                  <tr>
                                      <th><?= $value['vac_name'] ?></th>
                                      <th><?= $value['vaccine_status'] ?></th>
                                      <th><?= $value['appt_date'] ?></th>
                                      <th><?= $value['vaccine_administer'] ?></th>
                                  </tr>
                                  <?php }?>
                              </tbody>
                          </table>
                      </div>
                    </div>



        <?php 
            //get child vaccine record
            $bcg = mysqli_query($conn, "SELECT DISTINCT     
            CASE
            WHEN a.status = 2 AND c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is null THEN 'NO'
            WHEN a.status = 0 AND c.appt_date is null THEN 'NO'
            WHEN a.status = 1 AND c.appt_date is null THEN 'NO'
            END AS vaccine_status,
            a.vac_name,
            c.vaccine_administer,
            c.appt_date
            FROM child_vaccine_status a 
            LEFT JOIN vaccineinventory b ON a.vac_name = b.vac_name 
            LEFT JOIN appointmenttable c ON c.vacid = b.vacid AND c.cid = '$cid' AND c.appt_date is not null
            WHERE a.cid = '$cid' AND b.vac_name like '%HepB%'
            ORDER BY 
            vac_name asc") or die('query failed');
            $hepb_record = mysqli_fetch_all($bcg, MYSQLI_ASSOC);  
        ?>   
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
                                  <?php foreach($hepb_record as $value){?>
                                  <tr>
                                      <th><?= $value['vac_name'] ?></th>
                                      <th><?= $value['vaccine_status'] ?></th>
                                      <th><?= $value['appt_date'] ?></th>
                                      <th><?= $value['vaccine_administer'] ?></th>
                                  </tr>
                                  <?php }?>
                              </tbody>
                          </table>
                      </div>
                    </div>


        <?php 
            //get child vaccine record
            $bcg = mysqli_query($conn, "SELECT DISTINCT     
            CASE
            WHEN a.status = 2 AND c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is null THEN 'NO'
            WHEN a.status = 0 AND c.appt_date is null THEN 'NO'
            WHEN a.status = 1 AND c.appt_date is null THEN 'NO'
            END AS vaccine_status,
            a.vac_name,
            c.vaccine_administer,
            c.appt_date
            FROM child_vaccine_status a 
            LEFT JOIN vaccineinventory b ON a.vac_name = b.vac_name 
            LEFT JOIN appointmenttable c ON c.vacid = b.vacid AND c.cid = '$cid' AND c.appt_date is not null
            WHERE a.cid = '$cid' AND b.vac_name like '%DTaP%'
            ORDER BY 
            vac_name asc") or die('query failed');
            $dtap_record = mysqli_fetch_all($bcg, MYSQLI_ASSOC);  
        ?>  

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
                                  <?php foreach($dtap_record as $value){?>
                                  <tr>
                                      <th><?= $value['vac_name'] ?></th>
                                      <th><?= $value['vaccine_status'] ?></th>
                                      <th><?= $value['appt_date'] ?></th>
                                      <th><?= $value['vaccine_administer'] ?></th>
                                  </tr>
                                  <?php }?>
                              </tbody>
                          </table>
                      </div>
                    </div>

        <?php 
            //get child vaccine record
            $bcg = mysqli_query($conn, "SELECT DISTINCT     
            CASE
            WHEN a.status = 2 AND c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is null THEN 'NO'
            WHEN a.status = 0 AND c.appt_date is null THEN 'NO'
            WHEN a.status = 1 AND c.appt_date is null THEN 'NO'
            END AS vaccine_status,
            a.vac_name,
            c.vaccine_administer,
            c.appt_date
            FROM child_vaccine_status a 
            LEFT JOIN vaccineinventory b ON a.vac_name = b.vac_name 
            LEFT JOIN appointmenttable c ON c.vacid = b.vacid AND c.cid = '$cid' AND c.appt_date is not null
            WHERE a.cid = '$cid' AND b.vac_name like '%HiB%'
            ORDER BY 
            vac_name asc") or die('query failed');
            $hib_record = mysqli_fetch_all($bcg, MYSQLI_ASSOC);  
        ?>  

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
                                  <?php foreach($hib_record as $value){?>
                                  <tr>
                                      <th><?= $value['vac_name'] ?></th>
                                      <th><?= $value['vaccine_status'] ?></th>
                                      <th><?= $value['appt_date'] ?></th>
                                      <th><?= $value['vaccine_administer'] ?></th>
                                  </tr>
                                  <?php }?>
                              </tbody>
                          </table>
                      </div>
                    </div>



        <?php 
            //get child vaccine record
            $bcg = mysqli_query($conn, "SELECT DISTINCT     
            CASE
            WHEN a.status = 2 AND c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is null THEN 'NO'
            WHEN a.status = 0 AND c.appt_date is null THEN 'NO'
            WHEN a.status = 1 AND c.appt_date is null THEN 'NO'
            END AS vaccine_status,
            a.vac_name,
            c.vaccine_administer,
            c.appt_date
            FROM child_vaccine_status a 
            LEFT JOIN vaccineinventory b ON a.vac_name = b.vac_name 
            LEFT JOIN appointmenttable c ON c.vacid = b.vacid AND c.cid = '$cid' AND c.appt_date is not null
            WHERE a.cid = '$cid' AND b.vac_name like '%IPV%'
            ORDER BY 
            vac_name asc") or die('query failed');
            $hib_record = mysqli_fetch_all($bcg, MYSQLI_ASSOC);  
        ?>  

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
                                  <?php foreach($hib_record as $value){?>
                                  <tr>
                                      <th><?= $value['vac_name'] ?></th>
                                      <th><?= $value['vaccine_status'] ?></th>
                                      <th><?= $value['appt_date'] ?></th>
                                      <th><?= $value['vaccine_administer'] ?></th>
                                  </tr>
                                  <?php }?>
                              </tbody>
                          </table>
                      </div>
                    </div>


        <?php 
            //get child vaccine record
            $bcg = mysqli_query($conn, "SELECT DISTINCT     
            CASE
            WHEN a.status = 2 AND c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is null THEN 'NO'
            WHEN a.status = 0 AND c.appt_date is null THEN 'NO'
            WHEN a.status = 1 AND c.appt_date is null THEN 'NO'
            END AS vaccine_status,
            a.vac_name,
            c.vaccine_administer,
            c.appt_date
            FROM child_vaccine_status a 
            LEFT JOIN vaccineinventory b ON a.vac_name = b.vac_name 
            LEFT JOIN appointmenttable c ON c.vacid = b.vacid AND c.cid = '$cid' AND c.appt_date is not null
            WHERE a.cid = '$cid' AND b.vac_name like '%PCV%'
            ORDER BY 
            vac_name asc") or die('query failed');
            $pcv_record = mysqli_fetch_all($bcg, MYSQLI_ASSOC);  
        ?>  
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
                                  <?php foreach($pcv_record as $value){?>
                                  <tr>
                                      <th><?= $value['vac_name'] ?></th>
                                      <th><?= $value['vaccine_status'] ?></th>
                                      <th><?= $value['appt_date'] ?></th>
                                      <th><?= $value['vaccine_administer'] ?></th>
                                  </tr>
                                  <?php }?>
                              </tbody>
                          </table>
                      </div>
                    </div>


        <?php 
            //get child vaccine record
            $bcg = mysqli_query($conn, "SELECT DISTINCT     
            CASE
            WHEN a.status = 2 AND c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is null THEN 'NO'
            WHEN a.status = 0 AND c.appt_date is null THEN 'NO'
            WHEN a.status = 1 AND c.appt_date is null THEN 'NO'
            END AS vaccine_status,
            a.vac_name,
            c.vaccine_administer,
            c.appt_date
            FROM child_vaccine_status a 
            LEFT JOIN vaccineinventory b ON a.vac_name = b.vac_name 
            LEFT JOIN appointmenttable c ON c.vacid = b.vacid AND c.cid = '$cid' AND c.appt_date is not null
            WHERE a.cid = '$cid' AND b.vac_name like '%Rota%'
            ORDER BY 
            vac_name asc") or die('query failed');
            $rota_record = mysqli_fetch_all($bcg, MYSQLI_ASSOC);  
        ?>  

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
                                  <?php foreach($rota_record as $value){?>
                                  <tr>
                                      <th><?= $value['vac_name'] ?></th>
                                      <th><?= $value['vaccine_status'] ?></th>
                                      <th><?= $value['appt_date'] ?></th>
                                      <th><?= $value['vaccine_administer'] ?></th>
                                  </tr>
                                  <?php }?>
                              </tbody>
                          </table>
                      </div>
                    </div>



        <?php 
            //get child vaccine record
            $bcg = mysqli_query($conn, "SELECT DISTINCT     
            CASE
            WHEN a.status = 2 AND c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is null THEN 'NO'
            WHEN a.status = 0 AND c.appt_date is null THEN 'NO'
            WHEN a.status = 1 AND c.appt_date is null THEN 'NO'
            END AS vaccine_status,
            a.vac_name,
            c.vaccine_administer,
            c.appt_date
            FROM child_vaccine_status a 
            LEFT JOIN vaccineinventory b ON a.vac_name = b.vac_name 
            LEFT JOIN appointmenttable c ON c.vacid = b.vacid AND c.cid = '$cid' AND c.appt_date is not null
            WHERE a.cid = '$cid' AND b.vac_name like '%MMR%'
            ORDER BY 
            vac_name asc") or die('query failed');
            $mmr_record = mysqli_fetch_all($bcg, MYSQLI_ASSOC);  
        ?>  


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
                                  <?php foreach($mmr_record as $value){?>
                                  <tr>
                                      <th><?= $value['vac_name'] ?></th>
                                      <th><?= $value['vaccine_status'] ?></th>
                                      <th><?= $value['appt_date'] ?></th>
                                      <th><?= $value['vaccine_administer'] ?></th>
                                  </tr>
                                  <?php }?>
                              </tbody>
                          </table>
                      </div>
                    </div>



        <?php 
            //get child vaccine record
            $bcg = mysqli_query($conn, "SELECT DISTINCT     
            CASE
            WHEN a.status = 2 AND c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is null THEN 'NO'
            WHEN a.status = 0 AND c.appt_date is null THEN 'NO'
            WHEN a.status = 1 AND c.appt_date is null THEN 'NO'
            END AS vaccine_status,
            a.vac_name,
            c.vaccine_administer,
            c.appt_date
            FROM child_vaccine_status a 
            LEFT JOIN vaccineinventory b ON a.vac_name = b.vac_name 
            LEFT JOIN appointmenttable c ON c.vacid = b.vacid AND c.cid = '$cid' AND c.appt_date is not null
            WHERE a.cid = '$cid' AND b.vac_name like '%Influenza%'
            ORDER BY 
            vac_name asc") or die('query failed');
            $influenza_record = mysqli_fetch_all($bcg, MYSQLI_ASSOC);  
        ?>  

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
                                  <?php foreach($influenza_record as $value){?>
                                  <tr>
                                      <th><?= $value['vac_name'] ?></th>
                                      <th><?= $value['vaccine_status'] ?></th>
                                      <th><?= $value['appt_date'] ?></th>
                                      <th><?= $value['vaccine_administer'] ?></th>
                                  </tr>
                                  <?php }?>
                              </tbody>
                          </table>
                      </div>
                    </div>



        <?php 
            //get child vaccine record
            $bcg = mysqli_query($conn, "SELECT DISTINCT     
            CASE
            WHEN a.status = 2 AND c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is not null THEN 'YES'
            WHEN c.appt_date is null THEN 'NO'
            WHEN a.status = 0 AND c.appt_date is null THEN 'NO'
            WHEN a.status = 1 AND c.appt_date is null THEN 'NO'
            END AS vaccine_status,
            a.vac_name,
            c.vaccine_administer,
            c.appt_date
            FROM child_vaccine_status a 
            LEFT JOIN vaccineinventory b ON a.vac_name = b.vac_name 
            LEFT JOIN appointmenttable c ON c.vacid = b.vacid AND c.cid = '$cid' AND c.appt_date is not null
            WHERE a.cid = '$cid' AND b.vac_name like '%HepA%'
            ORDER BY 
            vac_name asc") or die('query failed');
            $hepa_record = mysqli_fetch_all($bcg, MYSQLI_ASSOC);  
        ?> 

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
                                  <?php foreach($hepa_record as $value){?>
                                  <tr>
                                      <th><?= $value['vac_name'] ?></th>
                                      <th><?= $value['vaccine_status'] ?></th>
                                      <th><?= $value['appt_date'] ?></th>
                                      <th><?= $value['vaccine_administer'] ?></th>
                                  </tr>
                                  <?php }?>
                              </tbody>
                          </table>
                      </div>
                    </div>
              </div>
          </div>                 
</div>
</div>
</div>
           
<script>
    function enableEdit() {
        var editableFields = document.querySelectorAll('.editable-info span');
        editableFields.forEach(function (field) {
            if (field.classList.contains('label')) {
                // Exclude labels from being editable
                return;
            }
            field.setAttribute('contenteditable', 'true');
            field.classList.add('editable');
        });
        document.getElementById('editButton').style.display = 'none';
        document.getElementById('saveButton').style.display = 'inline-block';
    }

    function saveChanges() {
        var editableFields = document.querySelectorAll('.editable-info span');
        editableFields.forEach(function (field) {
            field.setAttribute('contenteditable', 'false');
            field.classList.remove('editable');
        });
        document.getElementById('editButton').style.display = 'inline-block';
        document.getElementById('saveButton').style.display = 'none';
    }
</script>

<script>
    function enableVaccineEdit() {
        var editableFields = document.querySelectorAll('.modal-table tbody td');
        editableFields.forEach(function (field) {
            field.setAttribute('contenteditable', 'true');
            field.classList.add('editable');
        });
        document.getElementById('editVaccineButton').style.display = 'none';
        document.getElementById('saveVaccineButton').style.display = 'inline-block';
    }

    function saveVaccineChanges() {
        var editableFields = document.querySelectorAll('.modal-table tbody td');
        editableFields.forEach(function (field) {
            field.setAttribute('contenteditable', 'false');
            field.classList.remove('editable');
        });
        document.getElementById('editVaccineButton').style.display = 'inline-block';
        document.getElementById('saveVaccineButton').style.display = 'none';
    }
</script>                   
  
    
   

</body>
</html>
<!--merge -->