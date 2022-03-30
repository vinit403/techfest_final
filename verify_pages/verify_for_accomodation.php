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
    $name = $_SESSION['name'];
    $mail = $_SESSION['mail'];
    $phone_number = $_SESSION['phone_number'];
    $amount = $_SESSION['amount'];

    $payment_id = $_POST['razorpay_payment_id'];

    $name = str_replace("<","&lt;","$name");
    $name = str_replace(">", "&gt;", "$name");
    $mail = str_replace("<","&lt;","$mail");
    $mail = str_replace(">", "&gt;", "$mail");

        $name_member2 = $_SESSION['name_member2'];
        $mail_member2 = $_SESSION['mail_member2'];
        $phone_number2 = $_SESSION['phone_number2'];

        $name_member2 = str_replace("<","&lt;","$name_member2");
        $name_member2 = str_replace(">", "&gt;", "$name_member2");

        $mail_member2 = str_replace("<","&lt;","$mail_member2");
        $mail_member2 = str_replace(">", "&gt;", "$mail_member2");


        $sql = "INSERT INTO `accomodation`( `name_member_1`, `mail_member_1`, `phone_member_1`, `name_member_2`,`mail_member_2`,`phone_member_2`, `payment_id`) VALUES ('$name','$mail','$phone_number','$name_member2','$mail_member2','$phone_number2','$payment_id')";
        $result = mysqli_query($connect, $sql);

        if($result)
        {
            session_start();
            session_unset();
            session_destroy();
        }
    header("location: ../index.php");
}
else
{
    $html = "<p>Your payment failed</p>
        <p>{$error}</p>";
}

