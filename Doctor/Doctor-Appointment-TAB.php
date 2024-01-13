<!DOCTYPE html>
<html>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
<?php include('../include/include.php'); ?>


<link rel="stylesheet" href="./css/style5.css">
<link rel="stylesheet" href="./css/appointment_tab.css">


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
                                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Marijo Pedian</td>
                            <td>May Pedian</td>
                            <td>Rotavirus</td>
                            <td>For Approval</td>
                            <td>09123435786</td>
                            <td>01/10/24</td>
                            <td>9:00am</td>
                            <td>Vaccination</td>
                            <td>
                                <button onclick="openModal('sms')"><i class="fas fa-sms"></i></button>
                                <button onclick="openModal('eye')"><i class="fas fa-eye"></i></button>
                                <button onclick="openModal('edit')"><i class="fas fa-edit"></i></button>
                                
                                <div id="smsModal" class="modal">
                                  <div class="smsModal-content">
                                    <h2>SMS Reminder Sent.</h2>
                                    <button onclick="closeModal('sms')">Close</button>
                                  </div>
                                </div>
                                
                                <div id="eyeModal" class="modal">
                                  <div class="eyeModal-content">
                                        <div class="header">
                                            <h2>DAN XAVIER A. COLOMA</h2>
                                        </div>
                                        <div class="title">
                                            <h2>PERSONAL INFORMATION</h2>
                                        </div>
                                        <p><span class="label">Age</span> 2</p>
                                        <p><span class="label">Gender</span> Male</p>
                                        <p><span class="label">Birth Date</span> November 24, 2022</p>
                                        <p><span class="label">Birth Place</span> St Luke's Medical Center</p>
                                        <p><span class="label">Address</span> Santa Mesa, Manila</p>
                                        <p><span class="label">Mother's Name</span> Mary Rose A. Coloma</p>
                                        <p><span class="label">Father's Name</span> Mark G. Coloma</p>
                                        <p><span class="label">Contact Number</span> 09132567445</p>
                                        <div class="title">
                                            <h2>VACCINE INFORMATION</h2>
                                        </div>
                                        <p><span class="label">POLIO DOSE 1</span> YES</p>
                                        <p><span class="label">POLIO DOSE 2</span> NO</p>
                                        <button onclick="closeModal('eye')">Close</button>
                                  </div>
                                </div>
                                
                                <div id="editModal" class="modal">
                                  <div class="editModal-content">
                                    <form action="">
                                        <div class="user-details">
                                            <div class="input-box">
                                                <span class="details">Vaccine Name</span>
                                                <input type="text" placeholder="Enter what vaccine has been administered" required>
                                            </div>
                                            <div class="input-box">
                                                <span class="details">Dose Number</span>
                                                <input type="text" placeholder="Enter dose number" required>
                                            </div>
                                            <div class="input-box">
                                                <span class="details">Administrator's Name</span>
                                                <input type="text" placeholder="Enter your child's middle name" required>
                                            </div>
                                            <div class="date">
                                                <span class="details">Date</span>
                                                <input type="date" placeholder="Choose Date" required>
                                            </div>
                                            <button type="submit" onclick="closeModal('edit')">Update</button>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                            </td>
                        </tr>

</script>

</body>
</html>
