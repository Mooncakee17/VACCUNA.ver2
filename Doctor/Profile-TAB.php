<?php
// Include database configuration file
include('../config.php'); // Adjust the path accordingly

// Create a database connection
$mysqli = new mysqli('localhost', 'root', '', 'u621398810_Vaccunadb_v1');

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch user data from the database
session_start();  // Start the session
$user_id = $_SESSION['user_id']; // Get the user ID from the session
$query = "SELECT firstname, lastname, user_email, phonenumber, usertype, status FROM usertable WHERE userid = ? AND usertype = 'doctor'";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Close the database connection
$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style5.css">
    <link rel="stylesheet" href="./css/calendar-style.css">
    <title>Doctor Profile</title>
</head>
<body>
    <div class="container1">
        <div class="column1">
            <?php include('../templates/Doctor-Dash.php'); ?>
        </div>
        <div class="column">
            <div class="dashboard">
                <img src="./images/Profile.png">
                <div class="dashboard-text">
                    <h1>Welcome Doctor!</h1>
                </div>
                <div class="content">
                    <?php if ($row !== null) : ?>
                        <div class="header">
                            <h2><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></h2>
                            <img src="./images/User Profile.png" alt="">
                        </div>
                        <div class="title">
                            <h2>PERSONAL INFORMATION</h2>
                        </div>
                        <p><span class="label">First Name</span> <?php echo $row['firstname']; ?></p>
                        <p><span class="label">Last Name</span> <?php echo $row['lastname']; ?></p>
                        <p><span class="label">Email</span> <?php echo $row['user_email']; ?></p>
                        <p><span class="label">Contact Number</span> <?php echo $row['phonenumber']; ?></p>
                        <p><span class="label">User Type</span> <?php echo $row['usertype']; ?></p>
                        <p><span class="label">Status</span> <?php echo $row['status']; ?></p>
                        <!-- Add other fields as needed -->
                    <?php else : ?>
                        <p>No user found with the specified ID and user type 'doctor'.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
