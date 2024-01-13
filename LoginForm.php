<?php

include 'config.php';
session_start();

//login condition
if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `usertable` WHERE user_email = '$email' AND password = '$pass'") or die('query failed');
//checking if existed
   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      //$_SESSION['user_id'] = $row['userid'];
      
      if($row['usertype'] == 'admin'){

        $_SESSION['user_id'] = $row['userid'];
        header('location: ../Admin/ADMIN-Dashboard.php');
            
     }elseif($row['usertype'] == 'parent'){

        $_SESSION['user_id'] = $row['userid'];
        header('location: ../Parent/Dashboard-PARENT.php');
      
      } elseif ($row['usertype'] == 'it') {
         header('location: ../IT/User-Management-TAB.php');
         exit();
        
        } elseif ($row['usertype'] == 'doctor') {
            $_SESSION['user_id'] = $row['userid'];
            header('location: ../Doctor/Doctor-Appointment-TAB.php');
            exit();

     }
     // header('location:homeprofile.php');
   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-in Login form</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Inline&family=Poppins&display=swap" rel="stylesheet">
</head>
<body>

    <div class="wrapper">
        
        <a href="Index.php"><img src="../assets/images/VACUNNA logo.png" class="logo"></a>

        <form action="" method="post" enctype="multipart/form-data">
            <h1>LOGIN</h1>
                 <div class="input-box">
                    <input type="text" name="email" placeholder="Email" required>
                 </div>

             <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
             </div>

            <input type="submit" name="submit" value="Log In" class="btn">
            <div style="margin-bottom:20px;" class="signup_link">
                <a href="forgot-password.php" style="color:#8860D0; " >Forgot Password? </a>
            </div>


            <div class="signup_link">
                Don't have an account yet? <a href="SignUp.php" class="btn-create-account">Create Account</a>
            </div>

           
        </form>
    </div>

</body>
</html>
