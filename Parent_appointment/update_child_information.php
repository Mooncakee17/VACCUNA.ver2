<?php 
include '../Homepage/config.php';

$cid = $_POST['cid'];
$child_fname = $_POST['child_fname'];
$child_lname = $_POST['child_lname'];
$child_mname = $_POST['child_mname'];
$child_age = $_POST['child_age'];
$mother_name = $_POST['mother_name'];
$father_name = $_POST['father_name'];
$bday =  $_POST['bday'];
$url_type =  $_POST['url_type'];


$sql = "UPDATE childtable SET child_firstname = '$child_fname',child_lastname = '$child_lname' ,child_middlename = '$child_mname', child_age = '$child_age' ,mothername = '$mother_name' ,fathername = '$father_name', birthdate = '$bday' WHERE cid = $cid";
if (mysqli_query($conn, $sql)) {
	$result = 'success';
} else {
    //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    $result  = "Error: " . $sql . "<br>" . mysqli_error($conn);
}
echo $_POST['child_fname']." ".$child_mname." "." ".$child_mname." "." ".$child_age." "." ".$mother_name." ";


if($url_type == 'Parent'){
    header('location: ../Parent/Select_child_data.php');
}
else{
    header('location: ../Admin/Appointment-TAB.php');
}

?>
