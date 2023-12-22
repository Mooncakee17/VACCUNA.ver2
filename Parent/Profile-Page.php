
<?php include('../templates/Header.php'); ?>

<link rel="stylesheet" href="./css/style2.css">
<body>
    <div class="container1">
        <div class="column1">
            
          <?php include('../templates/Parent-Dash.php'); ?> <!------------call side bar template------------>
        </div>

        <div class="column">
            <div class="dashboard">
                <img src="./images/Profile.png">
            <div class="dashboard-text">
                <h1>Your Profile</h1>
            </div>
            </div>
             <div class="content">
             <div class="profile-pic">
                <?php
                    $select = mysqli_query($conn, "SELECT * FROM `usertable` WHERE userid = '$user_id'") or die('query failed');
                     if(mysqli_num_rows($select) > 0){
                    $fetch = mysqli_fetch_assoc($select);
                    }
                      if($fetch['image'] == ''){
                         echo '<img src="assets/images/default-avatar.png">';
                      }else{
                        echo '<img src="../uploaded_img/'.$fetch['image'].'" id ="profile" alt="Profile Avatar" class="profilepic">';
                     }
                     ?>
                  <h2><?php echo $fetch['username']; ?></h2>
                  <h4><?php echo $fetch['usertype']; ?></h4>
                  
                </div>
                
                <div class="profile-details">
                <h4>First Name:</h4>
                <h3><?php echo $fetch['firstname']; ?></h3>
                <h4>Last Name:</h4>
                <h3><?php echo $fetch['lastname']; ?></h3>
                <h4>Email</h4>
                <h3><?php echo $fetch['user_email']; ?></h3>
                <h4>Contact Number:</h4>
                <h3><?php echo $fetch['phonenumber']; ?></h3>
                <h4>Account Data Created</h4>
                <h3><?php echo $fetch['datecreated']; ?></h3>
                <div class="btna">
                <a href="Update-Profile.php" name="update_profile" class="btn">Update Profile</a>
                </div>
                </div>
             </div>

            
        </div>
    
    </div>

</body>
</html>