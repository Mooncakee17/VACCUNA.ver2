
<?php include('../templates/Header.php'); ?>
<link rel="stylesheet" href="./css/style3.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
<body>
<div class="container1">
        <div class="column1">
            
          <?php include('../templates/Parent-Dash.php'); ?> <!------------call side bar template------------>
        </div>

        <div class="column">
            <div class="d-board">
                <img src="./images/Dashboard.png">
            <div class="d-board-text">
                    <?php
                    $select = mysqli_query($conn, "SELECT * FROM `usertable` WHERE userid = '$user_id'") or die('query failed');
                     if(mysqli_num_rows($select) > 0){
                    $fetch = mysqli_fetch_assoc($select);
                    }      
                    ?>
                <h1>Hi <?php echo $fetch['firstname']; ?>! </h1>
               
            </div>
            </div>

            <div class="Notif-table">
            <div class="NotifTable_section">
                <table>
                    <thead>
                        <tr>
                            <th>NOTIFICATIONS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="./images/notif1.png" alt="">
                                <span class="notification-text">
                                    <strong>Why vaccine is important to baby?</strong> <br>Deciding to vaccinate your child: Common concerns
                                </span>
                            </td>
                            <td>
                            <a href="#"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="./images/notif2.png" alt="">
                                <span class="notification-text">
                                    <strong>Needed vaccine from 0yrs old to 24 months</strong> <br>List of vaccine required by the government
                                </span>
                            </td>
                            <td>
                            <a href="#"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td><img src="./images/notif3.png" alt="">
                                <span class="notification-text">
                                    <strong>Benefits of vaccines for future generations</strong> <br>Important reasons to vaccinate your child
                                </span>
                            </td>
                            <td>
                            <a href="#"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    
                    </tbody>
                </table>
            </div>
        </div>
        </div>
</div>
    <script src="./js/index.js"></script>

</body>
</html>
