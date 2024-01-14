

<?php 
include('../templates/Header.php'); 
$select = mysqli_query($conn, "SELECT * FROM `usertable` WHERE userid = '$user_id'") or die('query failed');
if(mysqli_num_rows($select) > 0){
$fetch = mysqli_fetch_assoc($select);
$user_id = $fetch['userid'];                   
}   

/*
include('../Admin_appointment/vaccine_query.php'); 
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
                    
                <h1>REPORTS FOR VACCINE inventory</h1>
               
            </div>
            </div>
          <div style=" margin:50px 90px 0 70px; ;
        padding: 50px 0 0 400px; "class="search">
        <p style="margin-left:90px;
                  margin-bottom:20px;
                  font-size:20px;">Filter data that you want to export</p>
                <form method="GET" action="Report.php">
                <div style= "border-radius: 6px; border: 1px solid #8860D0;
                                    width: 60%;
                                    padding: 8px 10px;
                                    margin-bottom:20px"class="select1">
                    <label style="  width: 100px;
                                    border-radius: 10px;
                                    border: none;
                                    color: #8860D0;
                                    padding: 8px 10px;
                                    font-size: 20px;
                                    margin-right:20px;
                                    cursor: pointer" for="vaccine_name">Select Vaccine Name:</label>
                    <select style=" width: 200px;
                                    color: #8860D0;
                                    background:#ffffff;
                                    padding: 8px 10px;
                                    font-size: 20px;
                                    margin-left:55px;
                                    
                                    cursor: pointer" name="vaccine_name" id="vaccine_name">
                        <option value="">All</option>
                        <option value="BCG">BCG</option>
                        <option value="HepB">HepB</option>
                        <option value="DTap">DTap</option>
                        <option value="HiB">HiB</option>
                        <option value="IPV">IPV</option>
                        <option value="PCV">PCV</option>
                        <option value="Rota">Rotavirus</option>
                        <option value="Influenza">Influenza</option>
                        <option value="MMR">MMR</option>
                        <option value="HepA">HepA</option>
                    </select>
                    <input type="hidden" name="cid_pdf" id="cid_pdf" value="<?php echo $user_id; ?>"/>
                </div>
                <div style= "border-radius: 6px; border: 1px solid #8860D0;
                                    width: 60%;
                                    padding: 8px 10px;
                                    margin-bottom:20px"class="">
                <label style=" width: 100px;
                                    color: #8860D0;
                                    background:#ffffff;
                                    padding: 8px 10px;
                                    font-size: 20px;
                                    cursor: pointer"for="status"></label>
                <select style=" width: 200px;
                                    color: #8860D0;
                                    background:#ffffff;
                                    padding: 8px 10px;
                                    font-size: 20px;
                                    margin-left:160px;
                                    cursor: pointer"name="status" id="status">
                    <option value="">All</option>
                    <option value="1">Active</option>
                    <option value="2">Inactive</option>

                    <!-- Add other status options here -->
                </select>
                </div>
            <input style="background-color:#8860D0;
            color:#ffffff;
            margin-left:90px" type="submit" value="Filter">
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
*/