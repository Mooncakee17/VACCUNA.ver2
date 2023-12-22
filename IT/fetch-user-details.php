<?php
include('connection.php');

// Check if the user ID is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the user details from the database
    $userId = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM usertable WHERE userid = '$userId'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Fetch user details as an associative array
        $userDetails = mysqli_fetch_assoc($result);

        // Return user details as JSON
        echo json_encode($userDetails);
    } else {
        // Handle the case where the query fails
        echo json_encode(['error' => 'Failed to fetch user details']);
    }
} else {
    // Handle the case where the user ID is not set
    echo json_encode(['error' => 'User ID not provided']);
}

// Close the database connection
mysqli_close($conn);
?>
