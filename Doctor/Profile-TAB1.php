<?php

include('../templates/Header.php');

if(isset($_POST['update_image'])){  
  $user_id=$_POST["id"];

  $update_image = $_FILES['fileImg']['name'];
  $update_image_size = $_FILES['fileImg']['size'];
  $update_image_tmp_name = $_FILES['fileImg']['tmp_name'];
  $update_image_folder = '../Homepage/uploaded_img/'.$update_image;

  if(!empty($update_image)){
     if($update_image_size > 2000000){
        $message[] = 'image is too large';
     }else{
        $image_update_query = mysqli_query($conn, "UPDATE `usertable` SET image = '$update_image' WHERE userid = '$user_id'") or die('query failed');
        if($image_update_query){
           move_uploaded_file($update_image_tmp_name, $update_image_folder);

          
        }
        $message[] = 'image updated succssfully!';
        header('Location: Profile-TAB.php');

        if(empty($message)){
          header('Location: Profile-TAB.php');
}
     }
  }

 }
?>


<link rel="stylesheet" href="../Parent/css/style2.css">

<body>
    <div class="container">
        <div class="column1">
          <?php include('../templates/Doctor-Dash.php'); ?> <!------------call side bar template------------>
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
                <a href="./Update-Profile1.php" class="btn">Update Profile</a>
                </div>
                </div>
             </div>

            
        </div>
    
    </div>

</body>
</html>
