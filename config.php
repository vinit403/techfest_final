<?php

$keyId = 'rzp_live_jRHSfuOG5U9oHm';
$keySecret = 'g8eZwzOxvewasSIbwFnDStX5';
$displayCurrency = 'INR';

//These should be commented out in production
// This is for error reporting
// Add it to config.php to report any errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "techpulse.crqeegwkwobj.ap-south-1.rds.amazonaws.com";
$username = "admin";
$password = "Techfest##90";
$database = "techpulse";
$connect = mysqli_connect($servername, $username, $password, $database);  