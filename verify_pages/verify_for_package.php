<?php

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    echo "page not fount...";
    exit;
}
require('../config.php');
session_start();

require('../razorpay/razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    if(isset($_SESSION['logged_in']))
    {
        if($_SESSION['logged_in'] == "true")
        {
            $user_name = $_SESSION['user_id'];
            $name = $_SESSION['name'];
            $phone_number = $_SESSION['phone_number'];
            $mail = $_SESSION['mail'];
            $college = $_SESSION['college'];

            $event_count = 2;

            $payment_id = $_POST['razorpay_payment_id'];
        
            $sql = "SELECT event_count FROM `user` WHERE user_id='$user_name'";
            $result = mysqli_query($connect, $sql);
        
            $r = mysqli_fetch_assoc($result);
            $event_count = $event_count + $r['event_count'];
        
            $sql = "UPDATE `user` SET event_count='$event_count' WHERE user_id='$user_name'";
            $result = mysqli_query($connect, $sql);
        

            $sql = "INSERT INTO `package_purchased` (`user_id`, `payment_id`) VALUES ('$user_name', '$payment_id')";
            $result = mysqli_query($connect, $sql);

            $sql = "INSERT INTO `user_entry_pass` (`user_id`, `mail`) VALUES ('$user_name', '$mail')";
            $result = mysqli_query($connect, $sql);

            header("location: ../success.php");
        
        }
        else
        {
            header("location: ../login.php");
        }
    }
    else
    {
        header("location: ../login.php");
    }
}
else
{
    $html = "<p>Your payment failed</p>
        <p>{$error}</p>";
}

