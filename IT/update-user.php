<?php
include('connection.php');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the form data
    $userid = mysqli_real_escape_string($conn, $_POST['user_id']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $usertype = mysqli_real_escape_string($conn, $_POST['usertype']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Update the user record in the database
    $query = "UPDATE usertable SET
        firstname='$firstname',
        lastname='$lastname',
        user_email='$user_email',
        usertype='$usertype',
        phonenumber='$phonenumber',
        status='$status'
        WHERE userid='$userid'";

    if (mysqli_query($conn, $query)) {
        $response = array('success' => true, 'message' => 'User updated successfully');
        echo json_encode($response);
    } else {
        $response = array('success' => false, 'message' => 'Error updating user: ' . mysqli_error($conn));
        echo json_encode($response);
    }
} else {
    $response = array('success' => false, 'message' => 'Invalid request method');
    echo json_encode($response);
}

mysqli_close($conn);
?>
