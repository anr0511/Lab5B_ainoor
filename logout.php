<?php
session_start(); 

// Unset all session variables
$_SESSION = array();


session_destroy();

// link to login page
header("location: login.php");
exit;
?>