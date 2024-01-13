<?php
include('../templates/Header.php');
include('connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input from the form
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $password = md5($_POST['password']); // Use appropriate password hashing method
    $confirmpassword = md5($_POST['confirmpassword']);
    $usertype = $_POST['usertype'];
    $token_verified = md5(rand()); //++token verified, --user_verify
    $status = ($_POST['status'] == '1') ? 'Active' : 'Inactive';


    // Save the generated token in the database
    
    $query = "INSERT INTO usertable (firstname, lastname, username, user_email, phonenumber, password, usertype, token_verified, status_verified, status)
              VALUES ('$firstname', '$lastname', '$username', '$email', '$phonenumber', '$password', '$usertype', '$token_verified', 0, '$status')";
              $insert = mysqli_query($conn,"INSERT INTO reset_pass(email) VALUES('$email')") or die('query failed');
    
    $insert = mysqli_query($conn, $query) or die('query failed');

    if ($insert) {
        // Insertion successful
        echo '<script>alert("User registered successfully! Please check your email for verification.");</script>';

        // Send verification email
        $subject = "Verify Your Email";
        $message = "Click the following link to verify your email: http://vaccuna.online/verify-email.php?token=$token_verified";
        $headers = "From: support@vaccuna.online"; // Change this to your email

        mail($email, $subject, $message, $headers);
    } else {
        // Insertion failed
        echo '<script>alert("Registration failed!");</script>';
    }
}

?>
<link rel="stylesheet" href="./css/style5.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

<body>
<div class="container1">
        <div class="column1">
          <?php include('../templates/IT-Dash.php'); ?> <!------------call side bar template------------>
        </div>

        <div class="column">
            <div class="dashboard">
                <img src="./images/register account.png">
            <div class="dashboard-text">
                    
                <h1>REGISTER ACCOUNT</h1>
               
            </div>
            </div>

            <div class="container">
            <form action="Register-Account-TAB.php" method="post">
                        <h1>REGISTER USER</h1>
                        <div class="user-details">
                        <div class="input-box">
                            <span class="details">First Name</span>
                            <input type="text" name="firstname" placeholder="Enter your first name" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Last Name</span>
                            <input type="text" name="lastname" placeholder="Enter your last name" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Username</span>
                            <input type="text" name="username" placeholder="Enter your username" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Email</span>
                            <input type="text" name="user_email" placeholder="Enter your email" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Phone Number</span>
                            <input type="text" name="phonenumber" placeholder="Enter your number" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Password</span>
                            <input type="password" name="password" placeholder="Enter your password" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Confirm Password</span>
                            <input type="password" name="confirmpassword"placeholder="Confirm your password" required>
                        </div>
                        <div class="input-box">
                            <span class="details">User Type</span>
                                <div class="styled-select">
                                    <select name="usertype" required>
                                        <option value="" disabled selected>Select user type</option>
                                        <option value="parent">Parent</option>
                                        <option value="admin">Admin</option>
                                        <option value="it">IT</option>
                                        <option value="doctor">Doctor</option>
                                </select>
                            </div> 

                        <div class="input-box">
                            <span class="details">Status</span>
                                <div class="styled-select">
                                    <select name="status" required>
                                        <option value="" disabled selected>Select status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                </select>
                            </div>
                    </div>

                        </div>
                    </div>

                    <button type="submit" class="create-button">Create</button>

                </form>
            </div>
        </div>

        
           
                    
    </div>
</div>


</body>
</html>
<!--merge -->