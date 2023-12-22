
<?php 
include('../templates/Header.php'); 
include('../Admin_appointment/vaccine_details.php'); 
?>
<link rel="stylesheet" href="./css/style5.css">
<link rel="stylesheet" href="./css/style6.css">

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
            <div class="search">
                    <input  type="text" name="search" id="search_data" value="" placeholder="Search ">
                    <button type="button" id="search_btn" style=""><i class="fa fa-search"></i></button>
                    <button onclick="location.reload()" style="">Refresh</button>  
            </div>
            <div class="table3">
            
            <div class="table3_section">
                <table id="data_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>CHILD NAME</th>
                            <th>GENDER</th>
                            <th>BIRTHDATE</th>
                            <th>PARENT/GUARDIAN</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          
                            $record =  "SELECT * FROM `childtable`";
                            if(isset($_GET['search'])){
                                $row = $_GET['search'];
                                $record =  "SELECT * FROM `childtable` WHERE CONCAT(child_firstname, child_lastname, mothername) LIKE '%$row%'";
                              
                        }
                            $record_run = mysqli_query($conn, $record);
                     
                            if(mysqli_num_rows($record_run) > 0 ){
                            foreach($record_run as $row){
                              
                                ?>
                            
                            <tr>
                            <td><?= $row['cid']; ?></td>
                            <td><?= $row['child_firstname']; ?>  <?= $row['child_lastname']; ?></td>
                            <td><?= $row['gender']; ?></td>
                            <td><?= $row['birthdate']; ?></td>
                            <td><?= $row['mothername']; ?></td>
                            <td>
                                <a href="Report-Details.php?id=<?= $row['cid']; ?>"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                                <?php
                            }
                            }
                            else {
                                // Display a message when no records are found
                                ?>
                                <tr>
                                    <td colspan="6"> <!-- colspan should match the number of columns in your table -->
                                        <div>No Record Found</div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
           
                    
        </div>
</div> 
</body>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>



<script type="text/javascript">
function openModal(modal) {
    var modal = document.getElementById(modal + 'Modal');
    modal.style.display = "block";
}
  
function closeModal(modal) {
    var modal = document.getElementById(modal + 'Modal');
    modal.style.display = "none";
}
  

  window.onclick = function(event) {
    if (event.target.className === 'modal') {
      event.target.style.display = 'none';
    }
  }

</script>
<script type="text/javascript">
    $(document).ready(function(){
                $("#register").click(function(){
                    var guardian_name = $("#guardian_name").val();
                    var child_name = $("#child_name").val();
                    var contact = $("#contact").val();
                    var child_age = $("#child_age").val();
                    var email = $("#email").val();
                    var vaccine_id = $("#select_vaccine").val();
                    var appointment_type = $("#appointment_type").val();
                    var hidden_dose = $("#hidden_dose").val();
                    console.log(hidden_dose);
                    $.ajax({
                        url: '../Admin_appointment/admin_walkin_registration.php',
                        type: 'POST',
                        data: {
                            child_name: child_name,
                            contact: contact,
                            child_age: child_age,
                            email: email,
                            guardian_name: guardian_name,
                            vaccine_id: vaccine_id,
                            appointment_type:appointment_type,
                            hidden_dose:hidden_dose
                        },
                        success:function(result){
                            console.log(result);
                            alert("Your appointment is save");  
                            window.location.href="Report-TAB.php" ;                   
                        },
                        error:function(error){

                        }
                    });
                });




        $("#select_vaccine").on("change",function(){
            var vaccine_name = $(this).val();
            console.log(vaccine_name);
            const dose1 = ['1','2','5','7','9','12','14','16','17','18'];

            const dose2 = ['3','6','8','10','13','15','19','24','25']; 
            const dose3 = ['4','11','20','21','22','23'];
            if (dose1.includes(vaccine_name)) {
               $("#set_dose_display").val("1st Dose");
               $("#hidden_dose").val(1);
            } 
            else if (dose2.includes(vaccine_name)) {
               $("#set_dose_display").val("2nd Dose");
               $("#hidden_dose").val(2);
            }
            else if (dose3.includes(vaccine_name)) {
               $("#set_dose_display").val("3rd Dose");
               $("#hidden_dose").val(3);
            } else {
              console.log(`vaccine does not exist in the array.`);
            }


        });



        $("#appointment_type").on("change",function(){
            if($("#appointment_type").val() == "Consultation"){
                    $("#vaccine_container").css('display','none');
                    $("#dose_container").css('display','none');
            }else{

                    $("#vaccine_container").css('display','block');
                    $("#dose_container").css('display','block');

                    var vaccine_name = $("#select_vaccine").val();
                    const dose1 = ['1','2','5','7','9','12','14','16','17','18'];

                    const dose2 = ['3','6','8','10','13','15','19','24','25']; 
                    const dose3 = ['4','11','20','21','22','23'];
                    if (dose1.includes(vaccine_name)) {
                       $("#set_dose_display").val("1st Dose");
                       $("#hidden_dose").val(1);
                    } 
                    else if (dose2.includes(vaccine_name)) {
                       $("#set_dose_display").val("2nd Dose");
                       $("#hidden_dose").val(2);
                    }
                    else if (dose3.includes(vaccine_name)) {
                       $("#set_dose_display").val("3rd Dose");
                       $("#hidden_dose").val(3);
                    } else {
                      console.log(`vaccine does not exist in the array.`);
                    }

            }

        });     






        $("#search_btn").click(function(){
           var search_data = $("#search_data").val();

           $.ajax({
                url: '../Admin_appointment/search_process.php',
                type: 'POST',
                data:{search_data:search_data},
                success:function(data){
                    $("#data_table").html(data);
                }
           });

        });



    });
</script>
</html>
<!--merge -->