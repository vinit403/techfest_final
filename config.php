<?php

// $keyId = 'rzp_live_oWLAVFP5n6uLhR';
// $keySecret = 'kLYrkQX3b20uSsfP8nAZeZhX';
// $displayCurrency = 'INR';

$keyId = 'rzp_test_0owRfSJRFwV8sn';
$keySecret = 'tFOdGCbDTxfUqoSQ8QLd4MTm';
$displayCurrency = 'INR';

//These should be commented out in production
// This is for error reporting
// Add it to config.php to report any errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "techpulse.c4vg6z6fzyif.ap-south-1.rds.amazonaws.com";
$username = "admin";
$password = "Awsrds##techpulse";
$database = "techpulse";
$connect = mysqli_connect($servername, $username, $password, $database);  