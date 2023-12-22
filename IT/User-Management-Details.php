<?php
include('../templates/Header.php');
include('connection.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT firstname, lastname, user_email, phonenumber, usertype, status FROM usertable WHERE userid = $id";
    $result = mysqli_query($conn, $query);
    $userDetails = mysqli_fetch_assoc($result);
}
?>

<link rel="stylesheet" href="./css/style5.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

<body>
    <div class="container1">
        <div class="column1">
            <?php include('../templates/IT-Dash.php'); ?>
        </div>

        <div class="column">
            <div class="dashboard">
                <img src="./images/user management 1.png">
                <div class="dashboard-text">
                    <h1>USER MANAGEMENT</h1>
                </div>
            </div>

            <div id="Report-Details">
                <div class="ReportDetails-content">
                    <div class="header">
                        <h2><?php echo $userDetails['firstname'] . ' ' . $userDetails['lastname']; ?></h2>
                        <img src="./images/User Profile.png" alt="">
                    </div>

                    <div class="title">
                        <h2>PERSONAL INFORMATION</h2>
                    </div>
                    <div class="info">
                        <p>
                            <span class="label">First Name:</span>
                            <span><?php echo $userDetails['firstname']; ?></span>
                        </p>
                        <p>
                            <span class="label">Last Name:</span>
                            <span><?php echo $userDetails['lastname']; ?></span>
                        </p>
                        <p>
                            <span class="label">Email:</span>
                            <span><?php echo $userDetails['user_email']; ?></span>
                        </p>
                        <p>
                            <span class="label">Contact Number:</span>
                            <span><?php echo $userDetails['phonenumber']; ?></span>
                        </p>
                        <p>
                            <span class="label">User Type:</span>
                            <span><?php echo $userDetails['usertype']; ?></span>
                        </p>
                        <p>
                            <span class="label">Status:</span>
                            <span><?php echo $userDetails['status']; ?></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>
