<?php
    // Start Session
    session_start(); 
    //create constants to store no repeating values
    define('SITEURL','http://localhost/pizzahouse/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food-order');

    $conn = mysqli_connect('localhost','root','') or die(mysqli_error());//Database connection
    $db_select = mysqli_select_db($conn, 'food-order') or die(mysqli_error());// selecting Database




?>