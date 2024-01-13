<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "u621398810_Vaccunadb_v1";



// MySQLi connection
$con = new mysqli($host, $username, $password, $database);

// pang connect
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>

<?php 
session_start();
require "config.php";
$email = "";
$name = "";
$errors = array();



    //nakalimutan password
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM usertable WHERE user_email = '$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE reset_pass SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: support@vaccuna.online";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a password reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }

    //reset otp buttons
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM reset_pass WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    // Validate the OTP code
if (isset($_POST['check-reset-otp'])) {
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM reset_pass WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);

    if (mysqli_num_rows($code_res) > 0) {
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];

        // Retrieve the new password from the 'reset_pass' table
        $reset_pass_query = "SELECT rpass FROM reset_pass WHERE email = '$email'";
        $reset_pass_result = mysqli_query($con, $reset_pass_query);

        if ($reset_pass_result && mysqli_num_rows($reset_pass_result) > 0) {
            $reset_pass_data = mysqli_fetch_assoc($reset_pass_result);
            $new_password = $reset_pass_data['rpass'];

            // Hash the new password
            $encpass = md5($new_password);

            // Update the 'password' column in the 'usertable' with the hashed new password
            $update_usertable_query = "UPDATE usertable SET password = '$encpass' WHERE user_email = '$email'";
            $update_result = mysqli_query($con, $update_usertable_query);

            if ($update_result) {
                $info = "Your password has been updated.";
                // Add any further actions or redirection here.
            } else {
                $errors['db-error'] = "Failed to update the password in usertable!";
            }
        } else {
            $errors['db-error'] = "Failed to retrieve the new password!";
        }
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}


    //change pass
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $email = $_SESSION['email']; // Get email
            $encpass = md5($password);
            $update_pass = "UPDATE usertable SET password = '$encpass' WHERE user_email = '$email'";
            
            $run_query = mysqli_query($con, $update_pass);
            
            if($run_query){
                $info = "Your password has been changed. Now you can log in with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            } else {
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //log-in
    if(isset($_POST['login-now'])){
        header('Location: LoginForm.php');
    }
?>