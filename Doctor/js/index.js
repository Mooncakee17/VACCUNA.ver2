const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
})

closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
})




function update_appointment(){
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
                window.location.href="../Doctor/Appointment-TAB.php";
        },
        error:function(error){

        }
    });    
}
function missed_appointment(){
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
            window.location.href="../Doctor/Appointment-TAB.php";
        },
        error:function(error){

        }
    });  
}





