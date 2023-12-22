<?php

 include ('../Homepage/config.php');
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('Location: ../Homepage/LoginForm.php');
};

 if(isset($_POST['submit'])){

    $fname = $_POST['Child_fname'];
    $lname = $_POST['Child_lname'];
    $fname = $_POST['Child_fname'];
    $mdname = $_POST['Child_mname'];
    $bday = $_POST['Child_bdate'];
    $mothername = $_POST['Child_fthrname'];
    $fathername = $_POST['Child_mthrname'];
    $c_age = $_POST['Child_age'];

    $sql = "INSERT INTO `childtable`(`userid`, `child_firstname`, `child_lastname`, `child_middlename`, `birthdate`, `mothername`, `fathername`, `child_age`) 
    VALUES ('$user_id','$fname','$lname','$mdname','$bday','$mothername','$fathername','$c_age]')";
     $conn->query($sql) or die ($conn->error);
     if($sql){
        $message[] = 'registered successfully!'; 
        header('location:../Parent/vaccination.php');
     }else{
        $message[] = 'registration failed!';
     }
 }




?>
<!DOCTYPE html>
<html>


<form action = "" method="post" >

    <label for="">Child's First Name</label>
    <input type="text" name="Child_fname">

    <label for="">Child's Last Name</label>
    <input type="text" name="Child_lname">
    <label for="">Child's Middle Name</label>
    <input type="text" name="Child_mname">

    <label for="">Child's Birthdate </label>
    <input type="date" name="Child_bdate">

    <label for="">Child's Father's Name</label>
    <input type="text" name="Child_fthrname">

    <label for="">Child's Mother's Name</label>
    <input type="text" name="Child_mthrname">

   
    
    <input type="submit" name="submit" value="Submit Form">
</form>
<body>

</body>
</html>
