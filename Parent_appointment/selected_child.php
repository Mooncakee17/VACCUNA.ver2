<?php 
include '../Homepage/config.php';
//CREATE SESSION FOR SELECTED CHILD
session_start();
unset($_SESSION['cid']);
$session_cid = $_POST['cid'];
$_SESSION['cid'] = $session_cid;

?>
