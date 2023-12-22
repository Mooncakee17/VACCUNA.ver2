const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
})

closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';

}) 
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
 
  
$(document).ready(function(){

    $("#submit_appointment").click(function(){
        
        var child_name = $("#child_name").val();
        var contact = $("#contact").val();
        var child_age = $("#child_age").val();
        var email = $("#email").val();
        var mother_name = $("#mother_name").val();
        var appointment_date = $("#appointment_date").val();
        var appointment_time = $("#appointment_time").val();
        var vaccine_administer = $("#vaccine_administer").val();
        var userid = $("#userid").val();
        var cid = $("#cid").val();
        var dose = $("#dose").val();
        if(appointment_date == ''){
            console.log("date is required");
            return false;
        }
        else if(appointment_time == ''){
            console.log("time is required");
            return false;
        }   
        console.log(dose);
        $.ajax({
            url: '../Parent_appointment/submit_appointment.php',
            type: 'POST',
            data: {
                child_name: child_name,
                contact: contact,
                child_age: child_age,
                email: email,
                mother_name: mother_name,
                appointment_date: appointment_date,
                appointment_time: appointment_time,
                vaccine_administer: vaccine_administer,
                userid: userid,
                cid: cid,
                dose: dose,
                appointment_type:'Vaccination'
            },
            success:function(result){
                alert("Your appointment is save");  
                window.location.href="Select_child_data.php" ;                   
            },
            error:function(error){

            }
        });
    });



    
    $("#select_children").on("change",function(){
        var childid = $("#select_children").val();
   
        $.ajax({
            url:"../Parent_appointment/appointment_page_select_child.php",
            type:"POST",
            data:{
                childid: childid
            },
            success:function(response){
                $("#set_child_age").val(response.child_age);
                $("#set_mother_name").val(response.mothername);   
                $("#set_child_name").val(response.child_full_name);   
                //After fetching the data of age and name, we will now populate the select Vaccine using another ajax 
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
            },
            error:function(error){

            }
        });
    });



   
    $("#select_vaccine").on("change",function(){
        var vaccine_name = $(this).val();
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


    });


    $("#appointment_submit_1").click(function(){
        var child_name = $("#set_child_name").val();
        var contact = $("#set_contact").val();
        var child_age = $("#set_child_age").val();
        var email = $("#set_email").val();
        var mother_name = $("#set_mother_name").val();
        var appointment_date = $("#set_appointment_date").val();
        var appointment_time = $("#set_appointment_time").val();
        var vaccine_administer = $("#select_vaccine").val();
        var userid = $("#set_userid").val();
        var cid = $("#select_children").val();
        var dose = $("#set_dose").val();
        var appointment_type = $("#appointment_type").val();

        if(appointment_type == "Consultation"){
            var surl = '../Parent_appointment/submit_consultation_appointment.php'; 
        }
        else{
            var surl = '../Parent_appointment/submit_appointment.php'; 
        }

        if(appointment_date == ''){
            console.log("date is required");
            return false;
        }
        else if(appointment_time == ''){
            console.log("time is required");
            return false;
        } 
        $.ajax({
            url: surl,
            type: 'POST',
            data: {
                child_name: child_name,
                contact: contact,
                child_age: child_age,
                email: email,
                mother_name: mother_name,
                appointment_date: appointment_date,
                appointment_time: appointment_time,
                vaccine_administer: vaccine_administer,
                userid: userid,
                cid: cid,
                dose: dose,
                appointment_type :appointment_type 
            },
            success:function(result){
                if(result == 1){
                    alert("Your appointment is save");    
                    window.location.href="Appointment-Page.php" ;            
                }
            },
            error:function(error){

            }
        });
    });


});