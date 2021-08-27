<?php
// 1. Inckude constants.php for SITEURL
include('../config/constants.php');
// 2.Destroy the Session
session_destroy();//Unset $SESSION['user]
// 3.Redirect to Login Page
header('location:'.SITEURL.'admin/login.php');

 
?>