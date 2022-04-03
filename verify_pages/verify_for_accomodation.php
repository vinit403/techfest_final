<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
    $payment_id = $_POST['razorpay_payment_id'];
    $order_id = $_POST['order_id'];
    $count = $_POST['count'];
    $amount = $_POST['amount'];

    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $phone_number = $_POST['phone_number'];

    $name_member2 = $_POST['name_member2'];
    $mail_member2 = $_POST['mail_member2'];
    $phone_number2 = $_POST['phone_number2'];

    if($count == 4)
    {
        $name_member3 = $_POST['name_member3'];
        $mail_member3 = $_POST['mail_member3'];
        $phone_number3 = $_POST['phone_number3'];

        $name_member4 = $_POST['name_member4'];
        $mail_member4 = $_POST['mail_member4'];
        $phone_number4 = $_POST['phone_number4'];
    }

    echo $count;
    echo '<br>';
    echo $amount;

    if($count == 2 && $amount == 400000)
    {
        $sql = "INSERT INTO `accomodation_person2_2days`( `name_member_1`, `mail_member_1`, `phone_member_1`, `name_member_2`,`mail_member_2`,`phone_member_2`, `payment_id`) VALUES ('$name','$mail','$phone_number','$name_member2','$mail_member2','$phone_number2','$payment_id')";
        $result = mysqli_query($connect, $sql);
    }
    if($count == 2 && $amount == 200000)
    {
        $sql = "INSERT INTO `accomodation_person2_1day`( `name_member_1`, `mail_member_1`, `phone_member_1`, `name_member_2`,`mail_member_2`,`phone_member_2`, `payment_id`) VALUES ('$name','$mail','$phone_number','$name_member2','$mail_member2','$phone_number2','$payment_id')";
        $result = mysqli_query($connect, $sql);
    }
    if($count == 4 && $amount == 800000)
    {
        $sql = "INSERT INTO `accomodation_person4_2days`( `name_member_1`, `mail_member_1`, `phone_member_1`, `name_member_2`,`mail_member_2`,`phone_member_2`,`name_member_3`,`mail_member_3`,`phone_member_3`,`name_member_4`,`mail_member_4`,`phone_member_4` ,`payment_id`) VALUES ('$name','$mail','$phone_number','$name_member2','$mail_member2','$phone_number2','$name_member3','$mail_member3','$phone_number3','$name_member4','$mail_member4','$phone_number4','$payment_id')";
        $result = mysqli_query($connect, $sql);
    }
    if($count == 4 && $amount == 400000)
    {
        $sql = "INSERT INTO `accomodation_person4_1day`( `name_member_1`, `mail_member_1`, `phone_member_1`, `name_member_2`,`mail_member_2`,`phone_member_2`,`name_member_3`,`mail_member_3`,`phone_member_3`,`name_member_4`,`mail_member_4`,`phone_member_4` ,`payment_id`) VALUES ('$name','$mail','$phone_number','$name_member2','$mail_member2','$phone_number2','$name_member3','$mail_member3','$phone_number3','$name_member4','$mail_member4','$phone_number4','$payment_id')";
        $result = mysqli_query($connect, $sql);
    }

    header("location: ../index.php");
}
else
{
    $html = "<p>Your payment failed</p>
        <p>{$error}</p>";
}

