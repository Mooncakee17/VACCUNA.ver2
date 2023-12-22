

<?php include('../templates/Header.php'); ?>
<link rel="stylesheet" href="./css/style6.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

<body>
<div class="container1">
        <div class="column1">
          <?php include('../templates/Admin-Dash.php'); ?> <!------------call side bar template------------>
        </div>

        <div class="column">
            <div class="dashboard">
                <img src="./images/Notification.png">
            <div class="dashboard-text">
                    
                <h1>NOTIFICATION</h1>
               
            </div>
            </div>

            <div class="Notif-table">
            <div class="add-button">
                <a style="  width: 100px;
    border-radius: 10px;
    border: none;
    color: #ffffff;
    background: #8860D0;
    padding: 10px 10px;
    font-size: 14px;
    margin-top: 20px;
    cursor: pointer;" href="Notification-add.php"><i class="fas fa-plus"></i> Add</a>
            </div>
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
                            <button onclick="openModal('trash')"><i class="fas fa-trash"></i></button>
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
                            <button onclick="openModal('trash')"><i class="fas fa-trash"></i></button>
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
                            <button onclick="openModal('trash')"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    
                    </tbody>
                </table>
            </div>
            <div id="trashModal" class="modal">
                <div class="NotiftrashModal-content">
                  <h2>This action cannot be undone. Are you sure you want to delete this record?</h2>
                  
                  <button onclick="deleteRecord('trash')">Delete</button>
                  <button onclick="closeModal('trash')">Close</button>
                </div>
            </div>
        </div>
        </div>
</div>

    <script src="./js/index.js"></script>

</body>
</html>
