<?php

//admin dashboard example
include '../config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location: ../LoginForm.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location: ../LoginForm.php');
}

?>
<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> VACCUNA </title>
    <link rel = "icon" href = "../assets/images/VACUNNA-logo-(2).png"         type = "image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Inline&family=Poppins&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="path_to_sweetalert2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


