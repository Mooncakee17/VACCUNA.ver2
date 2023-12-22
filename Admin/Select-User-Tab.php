
<?php 
include('../templates/Header.php'); 

?>
<link rel="stylesheet" href="./css/style5.css">
<link rel="stylesheet" href="./css/responsiveness.css">
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
                    
                <h1>REGISTER CHILD</h1>
               
            </div>
            </div>
           
            <div class="search1">
            <p>*Select the user or guardian who wishes to sign up their child</p>
                    <form action="" method="GET">
                    <button onclick="location.reload()" style="">Refresh</button>  
                    <button type="submit" style=""><i class="fa fa-search"></i></button>
                    <input type="text" name="search" value="" placeholder="Search ">
                    
                    </form>
                    
            </div>
            <div class="table3">
            
            <div class="table3_section">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>USERNAME</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>PHONENUMBER</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          
                            $record =  "SELECT * FROM `usertable`";
                            if(isset($_GET['search'])){
                                $row = $_GET['search'];
                                $record =  "SELECT * FROM `usertable` WHERE CONCAT(userid, firstname, lastname, user_email, phonenumber) LIKE '%$row%'";
                              
                        }
                            $record_run = mysqli_query($conn, $record);
                     
                            if(mysqli_num_rows($record_run) > 0 ){
                            foreach($record_run as $row){
                              
                                ?>
                            
                            <tr>
                            <td><?= $row['userid']; ?></td>
                            <td><?= $row['username']; ?></td>
                            <td><?= $row['firstname']; ?>  <?= $row['lastname']; ?></td>
                            <td><?= $row['user_email']; ?></td>
                            <td><?= $row['phonenumber']; ?></td>
                            
                            <td>
                                <a style=""href="Child-Reg-TAB.php?id=<?= $row['userid']; ?>">Select User</i></a>
                        

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
        <div style="margin-top: 15px;"><a href="Report-TAB.php" style="border: none;
                                            
                                            margin-left:100px;
                                            outline: none;
                                            border-radius: 6px;
                                            cursor: pointer;
                                            padding: 11px 15px 11px 15px;
                                            background-color: #8860D0;
                                            color: #ffffff;
                                            transition: .3s ease"><i class="fa fa-step-backward	"></i> Back </a>  </div>
        
                    
        </div>
</div>


</body>
</html>