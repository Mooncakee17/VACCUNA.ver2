<?php

include '../templates/Header.php';

// update profile for both users
if(isset($_POST['update_profile'])){   
   $update_firstname = mysqli_real_escape_string($conn, $_POST['update_firstname']);
   $update_lastname = mysqli_real_escape_string($conn, $_POST['update_lastname']);
   $update_username = mysqli_real_escape_string($conn, $_POST['update_username']);


   mysqli_query($conn, "UPDATE `usertable` SET firstname = '$update_firstname', lastname = '$update_lastname', username = '$update_username' WHERE userid = '$user_id'") or die('query failed');



   $old_pass = $_POST['old_pass'];
   $update_pass = mysqli_real_escape_string($conn, md5($_POST['update_pass']));
   $new_pass = mysqli_real_escape_string($conn, md5($_POST['new_pass']));
   $confirm_pass = mysqli_real_escape_string($conn, md5($_POST['confirm_pass']));

   if(!empty($update_pass) || !empty($new_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         mysqli_query($conn, "UPDATE `usertable` SET password = '$confirm_pass' WHERE userid = '$user_id'") or die('query failed');
         $message2[] = 'Updated successfully!';
      }
   }

   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = '../uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image is too large';
      }else{
         $image_update_query = mysqli_query($conn, "UPDATE `usertable` SET image = '$update_image' WHERE userid = '$user_id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         $message[] = 'Updated succssfully!';
      }
   }
   if (mysqli_query($conn, "UPDATE `usertable` SET firstname = '$update_firstname', lastname = '$update_lastname', username = '$update_username' WHERE userid = '$user_id'")) {
    $message[] = 'Updated successfully!';
} else {
    $message[] = 'Failed to update profile';
}
}

?>
<!DOCTYPE html>
<html>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"
rel="stylesheet">
<link rel="stylesheet" href="../Parent/css/style2.css">
<title> VACCUNA </title>

<body>


<?php
                  if(isset($message)){
                    foreach($message as $message){
                     echo "<script>
                             swal({
                             title: '$message',
                             html: '$message',
                             
                             confirmButtonText: 'Okay'
            })
        </script>";
         }
      }
      ?>
    <div class="container">
        <div class="column1">
          <?php include('../templates/Admin-Dash.php'); ?> <!------------call side bar template------------>
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
                <form action="" method="post" enctype="multipart/form-data">
                <?php
                    $select = mysqli_query($conn, "SELECT * FROM `usertable` WHERE userid = '$user_id'") or die('query failed');
                     if(mysqli_num_rows($select) > 0){
                    $fetch = mysqli_fetch_assoc($select);
                    }
                      if($fetch['image'] == ''){
                         echo '<img src="assets/images/default-avatar.png">';
                      }else{
                     echo '<img src="../uploaded_img/'.$fetch['image'].'" alt="Profile Avatar" class="profilepic">';
                     }
                     ?>
                <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box1">
                 <input type="text" name="update_username" value="<?php echo $fetch['username']; ?>" class="box">
                  <h4><?php echo $fetch['usertype']; ?></h4>

                </div>

                <div class="profile-details">
                <h4>First Name:</h4>
                <input type="text"name="update_firstname" value="<?php echo $fetch['firstname']; ?>" class="box">
                <h4>Last Name:</h4>
                <input type="text" name="update_lastname" value="<?php echo $fetch['lastname']; ?>" class="box">                
                <h4>Email</h4>
                <h3><?php echo $fetch['user_email']; ?></h3>
                <h4>Contact Number:</h4>
                <input type="text" name="update_phonenumber" value="<?php echo $fetch['phonenumber']; ?>" class="box">


                <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
                <h4>Old Password:</h4>
                <input type="password" name="update_pass" placeholder="Enter previous password" class="box">
                <h4>New Password:</h4>
                <input type="password" name="new_pass" placeholder="Enter new password" class="box">
                <h4>Confirm Password:</h4>
                <input type="password" name="confirm_pass" placeholder="Confirm new password" class="box">

                <div class="btnb">
                <input href="Update-Profile.php" type="submit" name="update_profile" style=" padding: 10px 10px 10px 10px;
                                                         width: 200px;
                                                         height: 45px;
                                                         background: #8860D0;
                                                         border-radius: 10px;
                                                         font-size: 17px;
                                                         color: white;
                                                         cursor: pointer;
                                                         text-align: center;
                                                         margin-right: 10px;" value="Save Changes" >
                <a href="Profile-TAB.php" class="btn-b">Cancel</a>
                </div>
                </div>
             </div>


        </div>

    </div>

</body>
</html>
