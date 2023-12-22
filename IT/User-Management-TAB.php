<?php
include('../templates/Header.php');
include('../config.php');

// Fetch user data from the database
if (isset($_GET['search']) && $_GET['search'] === 'all users') {
    // If searching for "all users," fetch all users
    $query = "SELECT * FROM usertable";
} else {
    // If searching for a specific term, filter the results
    $searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
    $query = "SELECT * FROM usertable WHERE CONCAT(firstname, ' ', lastname) LIKE '%$searchTerm%' OR user_email LIKE '%$searchTerm%' OR phonenumber LIKE '%$searchTerm%' OR usertype LIKE '%$searchTerm%' OR status = '$searchTerm'";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="./css/style5.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
</head>

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

            <div class="IT-search">
                <form action="" method="GET">
                    <input type="text" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" placeholder="Search ">
                    <button type="submit"><i class="fa fa-search"></i></button>
                    <button onclick="location.reload()">Refresh</button>
                </form>
            </div>

            <div class="IT-table">
                <div class="ITtable_section">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>EMAIL</th>
                                <th>CONTACT NUMBER</th>
                                <th>USERTYPE</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                                <th>SEND EMAIL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>{$row['userid']}</td>";
                                echo "<td>{$row['firstname']} {$row['lastname']}</td>";
                                echo "<td>{$row['user_email']}</td>";
                                echo "<td>{$row['phonenumber']}</td>";
                                echo "<td>{$row['usertype']}</td>";
                                echo "<td>{$row['status']}</td>";
                                echo "<td><a href='User-Management-Details.php?id={$row['userid']}'><i class='fas fa-eye'></i></a>";
                                echo "<button onclick=\"openModal('edit', {$row['userid']})\"><i class='fas fa-edit'></i></button></td>";
                                if ($row['status'] == 'Active') {
                                    echo "<td><button onclick=\"sendEmail('{$row['user_email']}')\">Send</button></td>";
                                } else {
                                    echo "";
                                }
                            }
                                echo "";
                              
                                                        
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="editModal" class="modal">
                <div class="editModal-content">
                    <form id="editForm" action="#" method="POST">
                        <!-- Add a hidden input for user ID -->
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">First Name</span>
                                <input type="text" name="firstname" placeholder="User's first name" id="firstname" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Last Name</span>
                                <input type="text" name="lastname" placeholder="User's last name" id="lastname" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Email</span>
                                <input type="text" name="user_email" placeholder="User's email" id="user_email" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Usertype</span>
                                <input type="text" name="usertype" placeholder="Usertype" id="usertype" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Contact Number</span>
                                <input type="text" name="phonenumber" placeholder="Contact number" id="phonenumber" required>
                            </div>
                            <div class="input-box">
                                <span class="details">Status</span>
                                <div class="styled-select">
                                    <select name="status" id="status" required>
                                        <option value="" disabled selected>Select Status</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="button" onclick="closeModal('edit')">Close</button>
                        <button type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="./js/User-Management-Edit-Button-Modal.js"></script>

    <script>
        // Function to populate the modal fields with user details
function openModal(modalType, userId) {
    // Fetch user details from the server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetch-user-details.php?id=' + userId, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                var userDetails = JSON.parse(xhr.responseText);

                // Check if the response contains an 'error' property
                if (userDetails.error) {
                    console.error('Error fetching user details:', userDetails.error);
                } else {
                    // Populate the modal fields with user details
                    document.getElementById('user_id').value = userDetails.userid;
                    document.getElementById('firstname').value = userDetails.firstname;
                    document.getElementById('lastname').value = userDetails.lastname;
                    document.getElementById('user_email').value = userDetails.user_email;
                    document.getElementById('usertype').value = userDetails.usertype;
                    document.getElementById('phonenumber').value = userDetails.phonenumber;
                    document.getElementById('status').value = userDetails.status;

                    // Display the modal
                    document.getElementById(modalType + 'Modal').style.display = 'block';
                }
            } else {
                console.error('Error fetching user details. Status code:', xhr.status);
            }
        }
    };
    xhr.send();
}

// Function to close the modal
function closeModal(modalType) {
    // Close the modal
    document.getElementById(modalType + 'Modal').style.display = 'none';
}

// Function to handle form submission using AJAX
document.addEventListener('DOMContentLoaded', function () {
    var editForm = document.getElementById('editForm');

    editForm.addEventListener('submit', function (event) {
        event.preventDefault();

        // Prepare the data to be sent to the server
        var formData = new FormData(editForm);

        // Make an AJAX request to update the user
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update-user.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert('Changes saved successfully!');
                        // You can close the modal or perform other actions as needed
                        closeModal('edit');
                        // Reload the page to reflect the changes
                        location.reload();
                    } else {
                        alert('Error saving changes: ' + response.message);
                    }
                } else {
                    alert('Error: ' + xhr.status);
                }
            }
        };
        xhr.send(formData);
    });
});
function sendEmail(userEmail) {
        // Make an AJAX request to send the email
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'send-email.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert('Email sent successfully!');
                    } else {
                        alert('Error sending email: ' + response.message);
                    }
                } else {
                    alert('Error: ' + xhr.status);
                }
            }
        };
        xhr.send('user_email=' + encodeURIComponent(userEmail));
    }

    </script>
</body>

</html>
