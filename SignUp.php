<?php

include 'config.php';
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor1/autoload.php';

//Send email function 
//need mag dl ng composer ng phpmailer sa terminal
function sendemail_verify($username,$email,$token_verified)
{
/*
    $mail = new PHPMailer();
    $mail->IsSMTP();
  
    $mail->SMTPDebug  = 0;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    //$mail->Host       = "smtp.mail.yahoo.com";
    $mail->Username   = "hatalagtag@gmail.com";
    $mail->Password   = "udiujxcblrowjpzm";
  */
    
    $mail = new PHPMailer(true);
    $mail ->IsSMTP();
    $mail ->SMTPAuth = true;
    $mail->Host       = "smtp.gmail.com";
  //$mail->Host       = "smtp.mail.yahoo.com";
    $mail->Username   = "hatalagtag@gmail.com";
    $mail->Password   = "udiujxcblrowjpzm";

    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;

    $mail->AddAddress($email);
    $mail->SetFrom("hatalagtag@gmail.com", $username);

    $mail->IsHTML(true);
    //$mail->AddReplyTo("reply-to-email", "reply-to-name");
    //$mail->AddCC("cc-recipient-email", "cc-recipient-name");
    $mail->Subject = "Email Verification from VACCUNA";
    $email_template ="
    <!DOCTYPE html>
        <html>
        <head>
            <style>
                /* Provided CSS styles */
                @media screen {
                    @font-face {
                        font-family: 'Source Sans Pro';
                        font-style: normal;
                        font-weight: 400;
                        src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
                    }
                    @font-face {
                        font-family: 'Source Sans Pro';
                        font-style: normal;
                        font-weight: 700;
                        src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
                    }
                    /* Add other CSS styles from your provided code */
                }
                /* Additional CSS styles */
                body,
                table,
                td,
                a {
                    -ms-text-size-adjust: 100%;
                    -webkit-text-size-adjust: 100%;
                }
                /* ... Other CSS styles ... */
            </style>
        </head>
        <body style='background-color: #e9ecef;'>
            <div class='preheader' style='display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;'>
                A preheader is the short summary text that follows the subject line when an email is viewed in the inbox.
            </div>

            <table border='0' cellpadding='0' cellspacing='0' width='100%'>

    <tr>
      <td align='center' bgcolor='#e9ecef'>
      
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='center' valign='top' style='padding: 36px 24px;'>
              <a href='https://www.blogdesire.com' target='_blank' style='display: inline-block;'>
                <img src='../assets/images/VACUNNA logo.png' alt='Logo' border='0' width='100px' style='display: block; width: 300px; max-width: 300px; min-width: 300px;'>
              </a>
            </td>
          </tr>
        </table>
     
      </td>
    </tr>
  

  
    <tr>
      <td align='center' bgcolor='#e9ecef'>
      
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;'>
              <h1 style='margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;'>You have registered with VACCUNA</h1>
            </td>
          </tr>
        </table>
      
      </td>
    </tr>


    
    <tr>
      <td align='center' bgcolor='#e9ecef'>
      
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>

          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
              <p style='margin: 0;'>Tap the button below to confirm your email address. If you didn't create an account with <a href='https://vaccuna.online'>VACCUNA</a>, you can safely delete this email.</p>
            </td>
          </tr>
       

       
          <tr>
            <td align='left' bgcolor='#ffffff'>
              <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tr>
                  <td align='center' bgcolor='#ffffff' style='padding: 12px;'>
                    <table border='0' cellpadding='0' cellspacing='0'>
                      <tr>
                        <td align='center' bgcolor='#1a82e2' style='border-radius: 6px;'>
                          <a href='https://vaccuna.online/verify-email.php?token=$token_verified' target='_blank' style='display: inline-block; padding: 16px 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;'>Verify your email address</a>
                          
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
     
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;'>
              <p style='margin: 0;'>If that doesn't work, copy and paste the following link in your browser:</p>
              <p style='margin: 0;'><a href='https://blogdesire.com' target='_blank'>https://blogdesire.com/xxx-xxx-xxxx</a></p>
            </td>
          </tr>
   
          <tr>
            <td align='left' bgcolor='#ffffff' style='padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf'>
              <p style='margin: 0;'>Cheers,<br> VACCUNA</p>
            </td>
          </tr>
       
        </table>
     
      </td>
    </tr>
    
    <tr>
      <td align='center' bgcolor='#e9ecef' style='padding: 24px;'>
 
        <table border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px;'>

     
          <tr>
            <td align='center' bgcolor='#e9ecef' style='padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;'>
              <p style='margin: 0;'></p>
            </td>
          </tr>
        
          <tr>
            <td align='center' bgcolor='#e9ecef' style='padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;'>
              <p style='margin: 0;'> <a href='https://www.blogdesire.com' target='_blank'></a> </p>
              <p style='margin: 0;'></p>
            </td>
          </tr>
     
        </table>
   
      </td>
    </tr>
  

  </table>

        </body>
        </html>
    ";

    $mail ->Body =$email_template;
    $mail ->send(); 
   // echo 'Message has been sent';
}
  //Conditions of inserting data into database
if(isset($_POST['submit'])){

   $firstname = mysqli_real_escape_string($conn, $_POST['fname']);
   $lastname = mysqli_real_escape_string($conn, $_POST['lname']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $username = mysqli_real_escape_string($conn, $_POST['uname']);
   $phonenumber = mysqli_real_escape_string($conn, $_POST['pnumber']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $usertype = $_POST ['usertype'];
   $status = $_POST ['status'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image; 
   $token_verified = md5(rand()); //++token verified, --user_verify

   $select= mysqli_query($conn, "SELECT * FROM `usertable` WHERE user_email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
         $message[] = 'user already exist!'; //need rin pala ng message css
   }else{
        if($pass != $cpass){
           $message[] = 'Confirm password not matched!';
        }elseif($image_size > 2000000){
           $message[] = 'image size is too large!';
        }
   else{
    $insert = mysqli_query($conn,"INSERT INTO reset_pass(email) VALUES('$email')") or die('query failed');
         $insert = mysqli_query($conn,"INSERT INTO usertable(firstname, lastname, user_email, username, phonenumber, password, usertype,token_verified, image, status) VALUES('$firstname','$lastname', '$email', '$username','$phonenumber','$pass', '$usertype','$token_verified', '$image', $status)") or die('query failed');
         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            sendemail_verify("$username","$email","$token_verified");
            $message[] = 'registered successfully!'; 
            header("Location:https://vaccuna.online/Signup-Confirmation.php");
         }else{
            $message[] = 'registration failed!';
         }
      }
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="path_to_sweetalert2.js"></script>
</head>
<body>
<?php
                  if(isset($message)){
                    foreach($message as $message){
                     echo "<script>
                             swal({
                             title: '$message',
                             icon: 'error',
                             showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                              },
                              hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                              }
                            })
        </script>";
         }
      }
      ?>
      
    <div class="container">
        <a href="Index.php"><img src="../assets/images/VACUNNA logo.png" class="logo"></a>
        <form action="" method="post" enctype="multipart/form-data">
            <h1>CREATING PROFILE</h1>
   
            <div class="user-details">
                <div class="input-box">
                    <span class="details">First Name</span>
                    <input type="text" name="fname" placeholder="Enter your first name" required>
                </div>
                <div class="input-box">
                    <span class="details">Last Name</span>
                    <input type="text" name="lname" placeholder="Enter your last name" required>
                </div>
                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="text" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-box">
                    <span class="details">Username</span>
                    <input type="text" name="uname" placeholder="Enter your username" required>
                </div>
                <div class="input-box">
                    <span class="details">Phone Number</span>
                    <input type="text" name="pnumber" placeholder="Enter your number" required>
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" name="password"  placeholder="Enter your password" required>
                </div>
                
                    
                <div class="input-box">
                    <span class="details">Confirm Password</span>
                    <input type="password" name="cpassword" placeholder="Confirm your password" required>
                </div>
                
                <input type="hidden" name="status" value="active">  
                <input type="hidden" name="usertype" value="parent">
                <input type="hidden" name="userverify" value="2">

                <div class="input-box">
                    <span class="details">Profile Picture</span>
                        <label class="file-upload">
                            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="profile-picture-input">
                            <span class="file-label"></span>
                         </label>
                         
    </div>     
        
</div>

            <p class="login-link">
                By signing up, you agree to our <a href="#">Terms and Conditions</a>.
            </p>

            <input type="submit" name="submit" value ="Create" class="btn">

            <p class="login-link">
                Already have an account? <a href="LoginForm.php">Click here</a>.
            </p>

        </form>
    </div>

</body>
</html>