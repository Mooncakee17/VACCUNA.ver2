<?php
session_start();
include('config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

//Resend email function
function resend_email_verify($username, $email, $token_verified)
{
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
    $mail->Subject = "Resend - Email Verification from VACCUNA";
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
              <p style='margin: 0;'>Tap the button below to confirm your email address. If you didn't create an account with <a href='https://vaccuna.com'>VACCUNA</a>, you can safely delete this email.</p>
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
} //Resend email condition
if(isset($_POST['submitemail']))
{
    if(!empty(trim($_POST['email'])))
    {
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $email_query ="SELECT * FROM usertable WHERE user_email= '$email' LIMIT 1";
        $email_query_run = mysqli_query($conn, $email_query);

        if(mysqli_num_rows($email_query_run) > 0)
        {
            $row = mysqli_fetch_array($email_query_run);
            if($row['status_verified'] =="0")
            {
                $username = $row['username'];
                $email = $row['user_email'];
                $token_verified['token_verified'];

                resend_email_verify($username,$email,$token_verified);
                $_SESSION['status']= "Verification email link has been sent to your email address.";
                header("Location: LoginForm.php");
                exit(0);
            }
            else{
                $_SESSION['status']= "Email already verified. Please Log in";
                header("Location: resend-email.php");
                exit(0);
            }
        }
        else{
            $_SESSION['status']= "Email is not registered. Please register first";
            header("Location: SignUp.php");
            exit(0);
        }


    }
    else
    {
        $_SESSION['status']= "Please enter the email field";
        header("Location: resend-email.php");
        exit(0);
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
    <?php 
        if(isset($_POST['status']))
        {
            ?>
            <div class="alert alert-success">
                <h5><?= $_SESSION['status']; ?></h5>
            </div>
         <?php
        unset($_SESSION['status']);
    } ?>

    <div class="wrapper">
        
        <a href="Index.php"><img src="../assets/images/VACUNNA logo.png" class="logo"></a>

        <form action="" method="post" enctype="multipart/form-data">
                
        <center> <h1>Resend Email Verification</h1> </center>
      
        <div class="input-box">
            <center>   <input type="text" name="email" placeholder="Enter your email address" required> </center>
            <input type="submit" name="submitemail" value="Resend" class="btn">
        </div>


        </form>
    </div>

</body>
</html>