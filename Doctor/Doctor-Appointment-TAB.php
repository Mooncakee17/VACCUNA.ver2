<!DOCTYPE html>
<html>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
rel="stylesheet">
<?php include('../include/include.php'); ?>


<link rel="stylesheet" href="./css/style5.css">
<link rel="stylesheet" href="./css/appointment_tab.css">

<?php include('../Admin_appointment/admin_appointment_controller.php'); 
include('../Admin_appointment/vaccine_details.php'); ?>
<!-- Include Bootstrap JavaScript and Popper.js from a CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<body>
    <div class="dash-container">
    <div class="column1">
        <!--------------------------------Start OF SIDE BAR-------------------------------->
         <?php include('../templates/Doctor-Dash.php'); ?>
         <!--------------------------------END OF SIDE BAR-------------------------------->
    </div>
    <div class="column">
    <div class="dashboard">
                <img class="appt" src="./images/Appointment.png">
            <div class="dashboard-text">
                <h1 class="text-white">APPOINTMENT</h1>
            </div>
            </div>

        <div class="table">
        <div class="search" style="margin-bottom:10px;">
<div class="form-group">
    <div class="row">
        <div class="col-auto">
             <div style="position: relative; display: inline-block;">
                <span>Search By:</span>
                <select class="form-select" id="search_dropdown">
                    <option>-- SELECT --</option>
                    <option value="1">Appointment Status</option>
                    <option value="2">Reason</option>
                    <option value="3">Keyword</option>
                </select>
            </div>           
        </div>

        <div class="col-auto" id="search_main_cont"  style="display:none;">
             <div id="search_display_container" style="position: relative; display: inline-block;">
            </div>           
        </div>


        <div class="col-auto" id="search_by_keyword_cont"  style="display:none;">
             <div id="search_by_keyword_container" style="position: relative; display: inline-block;">
            </div>           
        </div>       


    </div>
</div>


                <button id="open_appointment_form" onclick="openModal('set_appointment')" style=""><span style="background-color:transparent; color:white;" class="fa fa-user-plus"></span> Register Child </button>  
        </div>
            <div class="table_section">                            
                    <!--Table Data Start-->
                    <div class="row"  style="position:relative; left:80px;">

                            <!--Start table-->
                                     <table class="table" id="data_table">
                                        <thead class="">
                                            <tr>
                                                <th scope="col" class="col col-auto ps-1 pe-2 text-uppercase">
                                                    <text>id</text>
                                                </th>
                                                <th scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text>child name</text>
                                                </th>
                                                <th scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text>parent</text>
                                                </th>
                                                <th scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text>vaccine</text>
                                                </th>
                                                <th scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text>status</text>
                                                </th>                                                
                                                <th scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text>contact number</text>
                                                </th>
                                                <th scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text>date</text>
                                                </th>
                                                <th scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text>time</text>
                                                </th> 
                                                 <th scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text>reason</text>
                                                </th>                                           
                                                <th scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text>action</text>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="p-3 fs-7 text-white text-center">
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
                                                    $appointment_status = $info['appointment_status'];
                                                    $vac_name = $info['vac_name']; 
                                                    $for_reason = $info['for_reason'];          

                                                    if($appointment_status == 1 ){
                                                        $appointment_status_list = "For Approval";
                                                    }                                      
                                            ?>            
                                             <tr>
                                                <td scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text><?php echo $appt_id; ?></text>
                                                </td>
                                                <td scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text><?php echo $child_name; ?></text>
                                                </td>
                                                <td scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text><?php echo $guardian_name; ?></text>
                                                </td>
                                                <td scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text><?php echo $vac_name; ?></text>
                                                </td>
                                                <td scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text><?php echo $appointment_status_list; ?></text>
                                                </td>                     
                                                <td scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text><?php echo $contact_number; ?></text>
                                                </td>
                                                <td scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text><?php echo $appt_date; ?></text>
                                                </td>
                                                <td scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text><?php echo $appt_time; ?></text>
                                                </td>
                                                <td scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <text><?php echo $for_reason; ?></text>
                                                </td>
                                                <td scope="col" class="col col-auto ps-2 pe-2 text-uppercase">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <a id="send_notif-<?php echo $appt_id; ?>"  style="cursor:pointer;">
                                                                <i class="fa fa-comment"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <a href="../Admin/admin_more_info.php?id=<?= $cid; ?>" style="cursor:pointer; color:black;">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-lg-4">
                                                             <a id="update_record-<?php echo $appt_id; ?>"  style="cursor:pointer;">
                                                                <i class="fa fa-edit"></i>
                                                             </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>


                                            <!--Set Appointment-->
                                            <div class="modal fade" id="update_appointment" >
                                                <div class="modal-dialog" role="docoment">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <div class="row p-5 text-start header">
                                                                        <h4 class="fs-violet">Update</h4>
                                                                </div>
                                                                <br> <br>
                                                                <input type="hidden" value="" id="userid" / >
                                                                <input type="hidden" value="" id="cid" / >
                                                                <input type="hidden" value="" id="appt_id" / >
                                                                <input type="hidden" value="" id="vacid" / >
                                                                <input type="hidden" value="" id="dosage" / >
                                                                 <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <input type="text" id="child_name" class="form-control" value="" readonly>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <input type="text" id="contact" class="form-control" value="" readonly>
                                                                    </div>
                                                                </div> 

                                                                 <div class="row mt-3">
                                                                    <div class="col-lg-6">
                                                                        <input type="text" id="child_age" class="form-control" value="" readonly>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <input type="text" id="email" class="form-control" value="" readonly> 
                                                                    </div>
                                                                </div> 


                                                                 <div class="row mt-3">
                                                                    <div class="col-lg-6">
                                                                        <input type="text" id="mother_name" class="form-control" value="" placeholder="Mother's Name">
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <input type="date" id="appointment_date" class="form-control" >
                                                                    </div>
                                                                </div> 


                                                                 <div class="row mt-3">
                                                                    <div class="col-lg-6">
                                                                        <input type="time" id="appointment_time" class="form-control" >
                                                                    </div>
                                                                    <div class="col-lg-6" id="vaccine_name">
                                                                         <input type="text" id="vaccine_administer" class="form-control" readonly>
                                                                    </div>
                                                                </div>


                                                                 <div class="row mt-3" id="vaccine_dose">
                                                                    <div class="col-lg-12">
                                                                        <select id="dose" class="form-select">
                                                                            <option value="-1" disabled>-- Select --</option>
                                                                            <option value="1" disabled>1st Dose</option>
                                                                            <option value="2" disabled>2nd Dose</option>
                                                                            <option value="3" disabled>3rd Dose</option>
                                                                        </select>
                                                                    </div>
                                                                </div>


                                                                <div class="row mt-3">
                                                                    <div class="col-lg-12" id="doctor" >  
                                                               
                                                                    </div>
                                                                </div>


                                                                <div class="row mt-3">
                                                                    <div class="col-lg-12">
                                                                         <input type="text" id="for_reason" class="form-control" readonly>
                                                                    </div>
                                                                </div>





                                                                <div class="row mt-5">
                                                                    <div class="col-sm-3"></div>
                                                                    <div class="col-sm-auto text-end">
                                                                     <button type="button" id="update_appointment" onclick="update_appointment()" class="btn btn-md rounded-5 border text-white" style="background-color: violet;">Update</button>
                                                                    </div>  

                                                                    <div class="col-sm-auto text-end">
                                                                        <button type="button" id="back_update_appointment" class="btn btn-md ps-5 pe-5 rounded-5 border text-white" style="background-color: violet;">Cancel</button>
                                                                    </div>  


                                                                    <div class="col-sm-auto text-end">
                                                                        <button type="button" id="missed_appointment" onclick="missed_appointment()" class="btn btn-md ps-5 pe-5 rounded-5 border text-white" style="background-color: violet;">Missed</button>
                                                                    </div>  

                                                                

                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Appointment-->
                                            
                                            <form action="../Admin_appointment/send_notification.php" method="POST">
                                                <div class="modal fade" id="notify_applicant">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12 text-center">
                                                                        <h4>Click Yes to send a notificatiodsdn</h4>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-lg-12 text-center">
                                                                        <input type="hidden" name="notify_appt" id="notify_appt" />
                                                                        <button type="submit" id="send_notification" class="btn btn-md btn-primary">Send Notification</button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <?php
                                            //get id of the active user;
                                            $userid = $_SESSION['user_id']; 
                                            ?>
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
                                                            $("#doctor").html(response.doctor);
                                                            $("#for_reason").val(response.for_reason);
                                                            if(response.for_reason == "Consultation"){
                                                                $("#vaccine_name").css("display","none");
                                                                $("#vaccine_dose").css("display","none");
                                                            }
                                                            $('#update_appointment').modal('show');
                                                         }
                                                    }
                                                });

                                            });
 


                                                document.getElementById('back_update_appointment').addEventListener('click', function() {
                                                    $("#appt_id").val('');
                                                    $('#update_appointment').modal('hide');
                                                });  


                                            </script>

                                            <script type="text/javascript">
                                            // JavaScript to open the modal
                                            document.getElementById('send_notif-<?php echo $appt_id; ?>').addEventListener('click', function() {
                                                var appt_id = this.id; 
                                                appt_id = appt_id.split('-')[1];
                                                $("#notify_appt").val(appt_id);
                                                $('#notify_applicant').modal('show');
                                                

                                            });
                                          
                                            </script>
                                            <?php } ?>                           
                                        </tbody>                                
                                    </table>   
                            <!--End table-->   
                    </div>
                    <!--Table Data END-->

                    </div>
            </div>
    </div>
            
        
        <!--------------------------------END OF MAIN-------------------------------->
        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <span class="material-icons-sharp">menu</span>
                </button>
            </div>
        </div>

    </div>
            <div id="set_appointmentModal" class="modal fade" style="background-color:white;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                        <h3 class="details">Walkin Registration</h3>
                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">Guardian Name</span>
                                <input type="text" name="walkin_guardian_name" id="walkin_guardian_name" placeholder="Guardian Name" value="" required>
                            </div>


                            <div class="input-box">
                                <span class="details">Children Name</span>
                                <input type="text" name="walkin_child_name" id="walkin_child_name" placeholder="Children Name" value="" required>
                            </div>                          

                            <div class="input-box">
                                <span class="details">Contact Number</span>
                                <input type="text" name="walkin_contact" id="walkin_contact" placeholder="Contact Number" value="" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Children Age</span>
                                <input type="text" name="walkin_child_age" id="walkin_child_age" placeholder="Children Age" value="" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Email</span>
                                <input type="text" name="walkin_email" id="walkin_email" placeholder="Email - Walkin (Optional)" value="">
                            </div>

                            <div class="input-box" id="dose_container">
                                <span class="details">DOSE</span>
                                <input type="text" name="set_dose_display" id="set_dose_display" placeholder="Email - Walkin (Optional)" value="1st Dose">
                                <input type="hidden" name="hidden_dose" id="hidden_dose"  value="1"/>
                            </div>



                            <div class="input-box" id="vaccine_container">
                                  <span class="details" style="">Vaccine Name</span>
                                  <select class="form-select" name="select_vaccine" id="select_vaccine">
                                        <?php foreach($vaccine_list as $value){?>
                                            <option value="<?php echo $value['vacid']; ?>"><?php echo $value['vac_name']; ?></option>
                                        <?php }?>
                                  </select>  
                            </div>


                            <div class="input-box">
                                  <span class="details" style="">Appointment Type</span>
                                  <select name="walkin_appointment_type" class="form-select" id="walkin_appointment_type">
                                        <option value="Vaccination">Vaccination</option>
                                        <option value="Consultation">Consultation</option>
                                  </select>  
                            </div>
                        </div>                      
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-md btn-danger" onclick="closeModal('set_appointment')">Close</button>
                            <button class="btn btn-md btn-success" id="register">Register</button>                                  
                        </div>
                    </div>
                </div>
              </div>

     <script src="./js/index.js?v="<?php echo date('YmdHis'); ?>></script>
    <script src="./js/appointmentpage.js?v="<?php echo date('YmdHis'); ?>></script>
    <script type="text/javascript">
  
    function openModal(modal) {
        var modal = document.getElementById(modal + 'Modal');
        $("#set_appointmentModal").modal("show");
    }
      
    function closeModal(modal) {
        var modal = document.getElementById(modal + 'Modal');
        $("#set_appointmentModal").modal("hide");
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
                    var guardian_name = $("#walkin_guardian_name").val();
                    var child_name = $("#walkin_child_name").val();
                    var contact = $("#walkin_contact").val();
                    var child_age = $("#walkin_child_age").val();
                    var email = $("#walkin_email").val();
                    var vaccine_id = $("#select_vaccine").val();
                    var appointment_type = $("#walkin_appointment_type").val();
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
                            window.location.href="Appointment-TAB.php" ;                   
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



        $("#walkin_appointment_type").on("change",function(){
            if($("#walkin_appointment_type").val() == "Consultation"){
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
    });

$("#search_dropdown").change(function () {
    if ($(this).val() == 1) {
        $("#search_display_container").html("<select class='form-select' style='position:relative; top:19px;' name='search_via_dropdown' id='search_via_dropdown'><option>-- SELECT --</option><option value='1'>For Approval</option><option value='3'>Missed Appointment</option><option value='5'>Walkin</option><option value='2'>Completed</option></select>");
        $("#search_main_cont").css("display", "block");
        $("#search_by_keyword_cont").css("display", "none");
    } else if ($(this).val() == 2) {
        $("#search_display_container").html("<select class='form-select' style='position:relative; top:19px;'  name='search_via_dropdown' id='search_via_dropdown'><option>-- SELECT --</option><option value='Consultation'>Consultation</option><option value='Vaccination'>Vaccination</option></select>");
        $("#search_main_cont").css("display", "block");
        $("#search_by_keyword_cont").css("display", "none");
    } 
    else if ($(this).val() == 3) {
        $("#search_display_container").html("<input type='text' class='form-control w-100' placeholder='Search By Childname, Vaccine Name, Guardian Name, Id' id='searchData' name='searchData' style='position:relative; top:19px;' > ");
        $("#search_by_keyword_container").html("<button type='button' class='btn btn-md btn-primary' id='search_keyword' style='position:relative; top:19px;'>Search</button>");
        $("#search_by_keyword_cont").css("display", "block");
        $("#search_main_cont").css("display", "block");
    } 
    else {
        $("#search_by_keyword_cont").css("display", "none");
        $("#search_main_cont").css("display", "none");
    }
});

// Event delegation for dynamically added element
$("#search_display_container").on("change", "#search_via_dropdown", function () {
    // Handle the onchange event for #search_via_dropdown here
    var searchBy = $("#search_dropdown").val();
    var selectedValue = $(this).val();

    $.ajax({
        url:'../Admin_appointment/admin_appointment_search.php',
        type:'POST',
        data:{
            selectedValue:selectedValue,
            searchBy:searchBy
        },
        success:function(data){
            $(".table_section").html(data);
        }
    });


});


// Event delegation for dynamically added element
$("#search_by_keyword_container").on("click", "#search_keyword", function () {
    // Handle the onchange event for #search_via_dropdown here
    var searchBy = $("#search_dropdown").val();
    var searchData = $("#searchData").val();
    $.ajax({
        url:'../Admin_appointment/admin_appointment_search.php',
        type:'POST',
        data:{
            searchBy:searchBy,
            searchData:searchData
        },
        success:function(data){
            $(".table_section").html(data);
        }
    });


});





$("#update_appointment").click(function(){
    //console.log("clicked !!!!");return false;
    var cid = $("#cid").val();
    var appt_id = $("#appt_id").val();
    var vacid = $("#vacid").val();
    var vaccine_administer = $("#vaccine_administer").val();
    var dose = $("#dosage").val();
    var appointment_date = $("#appointment_date").val();
    var userid = $("#userid").val();
    var doctor = $("#doctor_select").val();
    var for_reason = $("#for_reason").val();

    $.ajax({
        url: '../Admin_appointment/update_appointment.php',
        type: 'POST',
        data: {
            cid: cid,
            dose: dose,
            appointment_date: appointment_date,
            vaccine_administer: vaccine_administer,
            userid: userid,
            appt_id: appt_id,
            vacid: vacid,
            doctor:doctor,
            for_reason:for_reason
        },
        success:function(result){
                window.location.href="../Admin/Appointment-TAB.php";
        },
        error:function(error){

        }
    }); 
});





$("#missed_appointment").click(function(){
    //console.log("Missed !!!!");return false; double pala hahah
    var cid = $("#cid").val();
    var appt_id = $("#appt_id").val();
    var vacid = $("#vacid").val();
    var vaccine_administer = $("#vaccine_administer").val();
    var dose = $("#dosage").val();
    var appointment_date = $("#appointment_date").val();
    var userid = $("#userid").val();
        console.log("dsakdhiwhdihsa");
        $.ajax({
        url: '../Admin_appointment/update_missed_appointment.php',
        type: 'POST',
        data: {
            cid: cid,
            dose: dose,
            appointment_date: appointment_date,
            vaccine_administer: vaccine_administer,
            userid: userid,
            appt_id: appt_id,
            vacid: vacid,
        },
        success:function(result){
            window.location.href="../Admin/Appointment-TAB.php";
        },
        error:function(error){

        }
    }); 
});

</script>

</body>
</html>
