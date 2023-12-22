<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success!</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Inline&family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
<?php
session_start();
include('config.php');

// email verification condition
if(isset($_GET['token']))
{
    //adding status_verified
    $token = $_GET['token'];
    $verify_query = "SELECT token_verified, status_verified FROM usertable WHERE token_verified ='$token' LIMIT 1";
    $verify_query_run = mysqli_query($conn,$verify_query);

    if(mysqli_num_rows($verify_query_run)> 0)
    {
        $row = mysqli_fetch_array($verify_query_run);

        if($row['status_verified']== "0"){

            $clicked_token = $row['token_verified'];
            $update_query = "UPDATE usertable SET status_verified='1' WHERE token_verified= '$clicked_token' LIMIT 1";
            $update_query_run = mysqli_query($conn, $update_query);

            if($update_query_run)
            {
                $_SESSION['status']= "Verified successfully";
                header("Location: Verify-Success.php");
                exit(0);     
            }
            else{
                $_SESSION['status']= "Verification failed";
                header("Location: LoginForm.php");
                exit(0);   
            }
        }
        else{
            $_SESSION['status']= "Email already verified, please log in";
            header("Location: LoginForm.php");    
            exit(0);
        }
    
    }
    else{
        $_SESSION['status']= "This token does not exists";
        header("Location: LoginForm.php");    
    }
}
else{
    $_SESSION['status']= "Not allowed";
    header("Location: LoginForm.php");

}
?>

</body>