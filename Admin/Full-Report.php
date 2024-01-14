<html>
<?php 
include('../templates/Header.php'); 
$select = mysqli_query($conn, "SELECT * FROM `usertable` WHERE userid = '$user_id'") or die('query failed');
if(mysqli_num_rows($select) > 0){
$fetch = mysqli_fetch_assoc($select);
$user_id = $fetch['userid'];                   
}   

include('../Admin_appointment/vaccine_details.php'); 
?>
<link rel="stylesheet" href="./css/style5.css">
<link rel="stylesheet" href="./css/style6.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
<!-- Include Bootstrap JavaScript and Popper.js from a CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<body>
<div class="container1">
        <div class="column1">
          <?php include('../templates/Admin-Dash.php'); ?> <!------------call side bar template------------>
        </div>

        <div class="column">
            <div class="dashboard">
                <img src="./images/Immunization Record.png">
            <div class="dashboard-text">
                    
                <h1>REPORTS</h1>
               
            </div>
            </div>
          <div style=" margin:100px 20px 0 10px; ;
        padding: 50px 0 0 400px; "class="search">
            <a style="background-color:#8860D0;
            color:#ffffff;
            margin-top:100px;padding:100px; font-size:15px" href="Report-skeletal.php"  >VACCINATION REPORTS</a>
            <a style="background-color:#8860D0;
            color:#ffffff;
            margin-top:100px; padding:100px; font-size:15px" href="Invertory-report.php"  >VACCINE INVETORY REPORTS</a>
            
                </form>
                </div>

              


<script>
    // Event delegation for dynamically added element
$("#search_button").on("click",  function () {
    // Handle the onchange event for #search_via_dropdown here
    var searchData = $("#search_data").val();
    $.ajax({
        url:'../Admin_appointment/admin_appointment_searchnew.php',
        type:'POST',
        data:{
            searchBy:3,
            searchData:searchData
        },
        success:function(data){
            $(".table3").html(data);
        }
    });


});
</script>
</body>
</html>