<!DOCTYPE html>
<html>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
rel="stylesheet">
<link rel="stylesheet" href="./css/style3.css">

 <?php include('../include/include.php'); ?>
<?php include('../templates/Header.php'); ?>
<?php 
    //For fetching table data
    include('../Parent_appointment/appointment_page_view.php'); 
?>
<?php 
    //for set appointment
    include("fetch_child_list.php");
    include('../Parent_appointment/user_personal_details.php');
    include('../Parent_appointment/fetch_business_days.php');
?>
<body>
    <div class="dash-container">

        <div  class="dash-container1">
             <!--------------------------------Start OF SIDE BAR-------------------------------->
         <?php include('../templates/Select-Child-Dash.php'); ?>
         <!--------------------------------END OF SIDE BAR-------------------------------->
        </div>
       
         <main>
            <div class="appt-board">
                <img src="./images/Appointment.png">
            <div class="appt-board-text">
                <h1>APPOINTMENT</h1>
            </div>

            <!--Button For Setting up an appointment-->
            <div class="SetAppt-Button">
                <button type="button" id="open_appointment_form">Set Appointment</button>
            </div>

            <div class="Appt-table">
                <div class="ApptTable_section">
                                     <table>
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>CHILD NAME</th>
                                                <th>PARENT/GUARDIAN</th>
                                                <th>CONTACT NUMBER</th>
                                                <th>DATE</th>
                                                <th>TIME</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach($appointmenttable as $info){
                                                    $appt_id = $info['appt_id'];
                                                    $parent_user_id = $info['userid'];
                                                    $cid = $info['cid'];
                                                    $vacid = $info['vacid'];
                                                    $appt_time = $info['appt_time'];
                                                    $appt_date = $info['appt_date'];
                                                    $dose = $info['dose'];
                                                    $child_name = $info['child_name'];
                                                    $guardian_name = $info['guardian_name'];
                                                    $contact_number = $info['contact_number'];
                                                    $age = $info['age'];
                                                    $email = $info['email'];                                                   
                                            ?>            
                                             <tr>
                                                <td>
                                                    <text><?php echo $appt_id; ?></text>
                                                </td>
                                                <td>
                                                    <text><?php echo $child_name; ?></text>
                                                </td>
                                                <td>
                                                    <text><?php echo $guardian_name; ?></text>
                                                </td>
                                                <td>
                                                    <text><?php echo $contact_number; ?></text>
                                                </td>
                                                <td>
                                                    <text><?php echo $appt_date; ?></text>
                                                </td>
                                                <td>
                                                    <text><?php echo $appt_time; ?></text>
                                                </td>
                                                <td>
                                                    <button id="update_record-<?php echo $appt_id; ?>">
                                                                 <i class='fa fa-edit'></i></button>
                                                    <button id="delete_record-<?php echo $appt_id; ?>">
                                                                <i class='fa fa-trash'></i></button>
                                                </td>
                                            </tr>



                                            <!--Edit Appointment-->
                                            <div class="modal fade" id="update_appointment" >
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <div class="row p-5 text-start header">
                                                                        <h4 class="fs-violet">Update Appointment Details</h4>
                                                                </div>

                                                            <form action="../Parent_appointment/update_appointment_details.php" method="POST">
                                                                
                                                                <input type="hidden" value="" name="userid" id="userid" / >
                                                                <input type="hidden" value="" name="cid" id="cid" / >
                                                                <input type="hidden" value="" name="appt_id" id="appt_id" / >
                                                                <input type="hidden" value="" name="vacid" id="vacid" / >
                                                                <input type="hidden" value="" name="dosage" id="dosage" / >
                                                                 <div class="row">
                                                                    <div class="col-lg-6">
                                                                        Name
                                                                        <input type="text" id="child_name" name="child_name" class="form-control" value="" >
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        Contact Number
                                                                        <input type="text" id="contact" name="contact" class="form-control" value="" >
                                                                    </div>
                                                                </div> 

                                                                 <div class="row mt-3">
                                                                    <div class="col-lg-6">
                                                                        Age
                                                                        <input type="text" id="child_age" name="child_age" class="form-control" value="" readonly>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        Email
                                                                        <input type="text" id="email" name="email" class="form-control" value="" > 
                                                                    </div>
                                                                </div> 


                                                                 <div class="row mt-3">
                                                                    <div class="col-lg-6">
                                                                        Guardian Name
                                                                        <input type="text" id="mother_name" name="mother_name" class="form-control" value="" placeholder="Mother's Name">
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        Appointment Date
                                                                        <input type="text" id="appointment_date" class="form-control date" name="appointment_date">
                                                                    </div>
                                                                </div> 


                                                                 <div class="row mt-3">
                                                                    <div class="col-lg-6">
                                                                        Appointment Time
                                                                        <input type="time" id="appointment_time" class="form-control" name="appointment_time">
                                                                    </div>


                                                                    <div class="col-lg-6">
                                                                        Vaccine Name
                                                                         <input type="text" id="vaccine_administer" class="form-control" readonly>
                                                                    </div>
                                                                </div>


                                                                 <div class="row mt-3">
                                                                    <div class="col-lg-12">
                                                                        <select id="dose" class="form-select">
                                                                            <option value="-1" disabled>-- Select --</option>
                                                                            <option value="1" disabled>1st Dose</option>
                                                                            <option value="2" disabled>2nd Dose</option>
                                                                            <option value="3" disabled>3rd Dose</option>
                                                                        </select>
                                                                    </div>
                                                                </div>


                                                                <div class="row mt-5">
                                                                    <div class="col-sm-3"></div>
                                                                    <div class="col-sm-auto text-end">
                                                                     <button type="submit" id="update_appointment" class="btn btn-md rounded-5 border text-white" style="background-color: violet;">Update</button>
                                                                    </div>  

                                                                    <div class="col-sm-auto text-end">
                                                                        <button type="button" id="cancel_appointment" class="btn btn-md ps-5 pe-5 rounded-5 border text-white" style="background-color: violet;">Cancel</button>
                                                                    </div>  
                                                                </div>

                                                            </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Edit Appointment-->




                                            <!--Delete Appointment-->
                                            <div class="modal fade" id="remove_appointment" >
                                                <div class="modal-dialog" role="docoment">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <div class="row p-5 text-center header">
                                                                        <h4 class="fs-violet" id="r_content">Are you sure you want to cancel your appointment for The <span class="fs-violet" id="selected_vac_name"></span> Vaccination of your child <span class="fs-violet" id="delete_children_name"></span>?</h4>
                                                                </div>

                                                                <form action="../Parent_appointment/delete_appointment.php" method="POST">
                                                                <input type="hidden" name="delete_vac_name" id="delete_vac_name"/ >
                                                                <input type="hidden" name="delete_appointment_id" id="delete_appointment_id"/ > 
                                                                <input type="hidden" name="delete_cid"  id="delete_cid"/ > 
                                                                <div class="row mt-5">
                                                                    <div class="col-sm-3"></div>
                                                                    <div class="col-sm-auto text-end">
                                                                        <button type="submit" id="delete_appointment_modal" class="btn btn-md btn-danger ps-5 pe-5 rounded-5 border text-white">Yes</button>
                                                                    </div>  

                                                                    <div class="col-sm-auto text-end">
                                                                        <button type="button" id="close_appointment_removal" class="btn btn-md ps-5 pe-5 rounded-5 border text-white" style="background-color: violet;">No</button>
                                                                    </div>  


                                                                </div>      
                                                                </form>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--Delete Appointment-->





                                            <?php
                                            //get id of the active user;
                                            $userid = $_SESSION['user_id']; 
                                            ?>
                                            <!-- Include Bootstrap JavaScript and Popper.js from a CDN -->
                                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                                            <script type="text/javascript">
                                            // JavaScript to open the modal
                                            document.getElementById('update_record-<?php echo $appt_id; ?>').addEventListener('click', function() {
                                                var appt_id = this.id; 
                                                appt_id = appt_id.split('-')[1];
                                                $.ajax({
                                                    url: '../Admin_appointment/individual_appointment.php',
                                                    type: 'POST',
                                                    data: { appt_id: appt_id },                           
                                                    success: function(response) {
                                                         if(response.status == 'success'){
                                                            $("#userid").val(<?php echo $userid; ?>);
                                                            $("#appt_id").val(appt_id);
                                                            $("#vacid").val(response.vacid);
                                                            $("#cid").val(response.cid);
                                                            $("#child_name").val(response.child_name);
                                                            $("#contact").val(response.contact_number);
                                                            $("#child_age").val(response.age);
                                                            $("#email").val(response.email);
                                                            $("#mother_name").val(response.guardian_name);
                                                            $("#appointment_date").val(response.appt_date);
                                                            $("#appointment_time").val(response.appt_time);
                                                            $("#vaccine_administer").val(response.vac_name);
                                                            $("#dosage").val(response.dose);
                                                            $("#dose").val(response.dose);
                                                            $('#update_appointment').modal('show');
                                                         }
                                                    }
                                                });

                                            });
                                                document.getElementById('cancel_appointment').addEventListener('click', function() {
                                                    $("#appt_id").val('');
                                                    $('#update_appointment').modal('hide');
                                                });  
                                            </script>


                                            <script type="text/javascript">
                                            // JavaScript to open the modal
                                            document.getElementById('delete_record-<?php echo $appt_id; ?>').addEventListener('click', function() {
                                                var appt_id = this.id; 
                                                appt_id = appt_id.split('-')[1];

                                                $.ajax({
                                                    url: '../Admin_appointment/individual_appointment.php',
                                                    type: 'POST',
                                                    data: { 
                                                        appt_id: appt_id

                                                         },                           
                                                    success: function(response) {
                                                         if(response.status == 'success'){
                                                            $("#userid").val(<?php echo $userid; ?>);
                                                            $("#delete_appointment_id").val(appt_id);
                                                            $("#delete_cid").val(response.cid);
                                                            $("#delete_vac_name").val(response.vac_name);
                                                            $("#delete_children_name").html(response.child_name);
                                                            $("#selected_vac_name").html(response.vac_name);
                                                            $('#remove_appointment').modal('show');
                                                         }
                                                    }
                                                });

                                            });
                                                document.getElementById('close_appointment_removal').addEventListener('click', function() {
                                                    $("#appt_id").val('');
                                                    $('#remove_appointment').modal('hide');
                                                });  
                                            </script>



                                            <?php } ?>                           
                                        </tbody>                                
                                    </table> 
                                </div> 
                            <!--End table-->  
                                

                        </div>
                    </div>
                    <!--Table Data END-->
                </div>
            </div>
            </div>



    <!--Set Appointment-->
    <div class="modal fade" id="set_appointment" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row p-5 text-center header">
                                <h4 class="fs-violet">Appointment Form</h4>
                        </div>
                        <input type="hidden" value="<?php echo $user_id; ?>" id="set_userid">
                        <input type="text" value="" id="set_child_name">
                         <div class="row">
                            <div class="col-lg-6">
                             Select Children
                                <select id="select_children" class="form-select">
                                    <option value="-1">-- Select Children --</option>
                                    <?php 
                                    foreach($child_list_dropdown as $value){?>
                                    <option value=" <?php echo $value["cid"];?>">
                                        <?php echo $value["child_firstname"]." ".$value['child_lastname'];?>
                                    </option>
                                    <?php }?>
                                </select>

                            </div>
                            <div class="col-lg-6">
                                Contact Number
                                <input type="text" id="set_contact" class="form-control" value="<?php echo $phonenumber; ?>" readonly>
                            </div>
                        </div> 

                         <div class="row mt-3">
                            <div class="col-lg-6">
                                Age
                                <input type="text" id="set_child_age" class="form-control" value="">
                            </div>
                            <div class="col-lg-6">
                                Email
                                <input type="text" id="set_email" class="form-control" value="<?php echo $email; ?>" > 
                            </div>
                        </div> 

                         <div class="row mt-3">
                            <div class="col-lg-6">
                                Guardian Name
                                <input type="text" id="set_mother_name" class="form-control" value="" placeholder="Mother's Name">
                            </div>
                            <div class="col-lg-6">
                                Appointment Date
                                <input type="text" id="set_appointment_date" class="form-control date" required>
                            </div>
                        </div> 


                         <div class="row mt-3">
                            <div class="col-lg-6">
                                Appointment Time
                                <input type="time" id="set_appointment_time" class="form-control" required>
                            </div>
                            
                                                            <!--       <div class="row mt-3">
                                                                    <div class="col-lg-12">
                                                                        <select id="dosereason" class="form-select">
                                                                            <option value="-1" disabled>-- Select Reason for appointment --</option>
                                                                            <option value="1" >For Vaccination</option>
                                                                            <option value="2" >For Consultation</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                    -->
                        <div class="col-lg-6" id="vaccine_list">
                                Select Vaccine
                                <select class="form-select" id="select_vaccine">
                                    <option class="option_list">-- Select Vaccine --</option>
                                </select>                            
                                </div>
                            </div>
                        </div>

                         <div class="row mt-3">
                            <div class="col-lg-12">
                                <input type="hidden" id="set_dose" class="form-control">
                                 <input type="text" id="set_dose_display" class="form-control" readonly>
                            </div>
                        </div>

                         <div class="row mt-3">
                            <div class="col-lg-12">
                                 <select class="form-select" id="appointment_type">
                                    <option value="Vaccination">Vaccination</option>
                                    <option value="Consultation">Consultation</option>
                                </select>                                 
                            </div>
                        </div>






                        <div class="row mt-5">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-auto text-end">
                             <button type="button" id="appointment_submit_1" class="btn btn-md rounded-5 border text-white" style="background-color: violet;">Submit Appointment</button>
                            </div>  

                            <div class="col-sm-auto text-end">
                                <button type="button" id="cancel_set_appointment" class="btn btn-md rounded-5 border text-white" style="background-color: violet;">Cancel</button>
                            </div>  
                        </div>






                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Appointment-->


            <!--For Notification-->
            <?php include('../include/notification_popup.php'); ?>



            <script type="text/javascript">

                 // JavaScript to open the modal
                document.getElementById('open_appointment_form').addEventListener('click', function() {
                    $('#set_appointment').modal('show');
                });  


                document.getElementById('cancel_set_appointment').addEventListener('click', function() {
                    $('#set_appointment').modal('hide');
                });  


            </script>

            
        </main>
        <!--------------------------------END OF MAIN-------------------------------->
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
            </div>
        </div>
    </div>
    <script src="./js/index.js"></script>

      <!-- jQuery library -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

      <!-- jQuery UI CSS -->
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

      <!-- jQuery UI Datepicker JS -->
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  


    <script>
//Update Appointment
document.addEventListener("DOMContentLoaded", function () {
  var input = document.getElementById("appointment_date");
  var allowedDates = <?php echo $allowedDatesJSON; ?>; // Populate allowedDates with PHP JSON data

  // Function to check if a date is allowed
  function isDateAllowed(date) {
    return allowedDates.indexOf(date) !== -1;
  }

  // Initialize the datepicker without a value
  $(input).datepicker({
    beforeShow: function (input, inst) {
      var currentDate = $(input).val();
      if (!isDateAllowed(currentDate)) {
        $(input).val(allowedDates[0]);
      }
    },
    beforeShowDay: function (date) {
      var dateString = $.datepicker.formatDate("yy-mm-dd", date);
      if (isDateAllowed(dateString)) {
        return [true];
      }
      return [false, "custom-disabled-date"];
    },
    onClose: function () {
      // Ensure that the datepicker is closed
      input.blur();
    }
  });

  // Set the input to the first allowed date if the current date is not in the allowedDates array
  if (!isDateAllowed(input.value)) {
    input.value = allowedDates[0];
  }
});
</script>

<script>
//SET Appointment
document.addEventListener("DOMContentLoaded", function () {
  var input = document.getElementById("set_appointment_date");
  var allowedDates = <?php echo $allowedDatesJSON; ?>; // Populate allowedDates with PHP JSON data

  // Function to check if a date is allowed
  function isDateAllowed(date) {
    return allowedDates.indexOf(date) !== -1;
  }

  // Initialize the datepicker without a value
  $(input).datepicker({
    beforeShow: function (input, inst) {
      var currentDate = $(input).val();
      if (!isDateAllowed(currentDate)) {
        $(input).val(allowedDates[0]);
      }
    },
    beforeShowDay: function (date) {
      var dateString = $.datepicker.formatDate("yy-mm-dd", date);
      if (isDateAllowed(dateString)) {
        return [true];
      }
      return [false, "custom-disabled-date"];
    },
    onClose: function () {
      // Ensure that the datepicker is closed
      input.blur();
    }
  });

  // Set the input to the first allowed date if the current date is not in the allowedDates array
  if (!isDateAllowed(input.value)) {
    input.value = allowedDates[0];
  }
});
</script>
<script type="text/javascript">
        $("#appointment_type").on('change',function(){
        if($("#appointment_type").val() == "Consultation"){
            $("#select_vaccine").val("");
            $("#vaccine_list").css("display","none");
        }
        else{
            $("#vaccine_list").css("display","block");
            var childid = $("#select_children").val();
            $.ajax({
                url:'../Parent_appointment/appointment_page_fetch_vac_name.php',
                type:'POST',
                data:{ childid: childid },
                success: function(result){
                    $("#select_vaccine").html(result);
                  
                    var vaccine_name = $("#select_vaccine").val();
                    const dose1 = ['BCG', 'HepB1', 'DTaP1', 'HiB1', 'IPV1', 'PCV1', 'Rotavirus1','MMR','Influenza','HepA1'];

                    const dose2 = ['HepB2', 'DTaP2', 'HiB2', 'IPV2', 'PCV2', 'Rotavirus2','MMR2','Influenza2','HepA2']; 
                    const dose3 = ['HepB3', 'DTaP3', 'HiB3','IPV3','Rotavirus3','PCV3'];
                    if (dose1.includes(vaccine_name)) {
                       $("#set_dose_display").val("1st Dose");
                       $("#set_dose").val(1);
                    } 
                    else if (dose2.includes(vaccine_name)) {
                       $("#set_dose_display").val("2nd Dose");
                       $("#set_dose").val(2);
                    }
                    else if (dose3.includes(vaccine_name)) {
                       $("#set_dose_display").val("3rd Dose");
                       $("#set_dose").val(3);
                    } else {
                      console.log(`vaccine does not exist in the array.`);
                    }
                }
            }); 
        }
    });

</script>
<style>
  .custom-disabled-date {
    color: #999; /* Change text color for disabled dates */
    cursor: not-allowed; /* Change cursor for disabled dates */
  }
</style>
</body>
</html>