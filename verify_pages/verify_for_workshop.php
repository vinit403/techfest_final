<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
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

if (empty($_POST['razorpay_payment_id']) === false) {
    $api = new Api($keyId, $keySecret);

    try {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    } catch (SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true) {
    if (isset($_SESSION['logged_in'])) {
        if ($_SESSION['logged_in'] == "true") {

            $uuid = uniqid();

            $user_name = $_SESSION['user_id'];
            $name = $_SESSION['name'];
            $phone_number = $_SESSION['phone_number'];
            $mail = $_SESSION['mail'];
            $college = $_SESSION['college'];

            $payment_id = $_POST['razorpay_payment_id'];
            $order_id = $_POST['order_id'];

            $amount = $_POST['amount'];
            $amount = $amount / 100;


            $sql = "SELECT workshop_count FROM `user` WHERE user_id='$user_name'";
            $result = mysqli_query($connect, $sql);

            $r = mysqli_fetch_assoc($result);
            $event_count =  $r['workshop_count'];
            $event_count = $event_count + 1;

            $sql = "UPDATE `user` SET workshop_count='$event_count' WHERE user_id='$user_name'";
            $result = mysqli_query($connect, $sql);


            $sql = "INSERT INTO `workshop_purchased` (`user_id`, `payment_id`) VALUES ('$user_name','$payment_id')";

            $result = mysqli_query($connect, $sql);

            $sql = "SELECT * FROM `user_entry_pass` WHERE user_id = '$user_name'";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_num_rows($result);

            require '../vendor/autoload.php';
            require '../smtp.php';

            $sender = 'hello@techpulse.co.in';
            $senderName = 'Techpluse';

            $recipient = $mail;

            // The subject line of the email
            $subject =  $name . ', thanks for purchasing Workshop';

            // The plain-text body of the email
            $bodyText =  "okay you got it.";

            // The HTML-formatted body of the email
            $bodyHtml = "<html><body>";
            $bodyHtml .= "Woo hoo! You have successfully purchased Workshop. It will reflect in your wallet.<br>    <br>";
            $bodyHtml .= "Here's your confirmation for order number $order_id. Review your receipt and get started.<br><br>

            ORDER SUMMARY:<br><br>

            Product: Standard Package QTY.1<br>
            Price: INR $amount.00<br>
            Order id: $order_id<br>
            Payment id: $payment_id<br>
            Order Total: INR $amount.00<br><br>
            
            Name: $name<br>
            Email: $mail<br>
            phone number: $phone_number<br><br>";
            if ($row == 0) {
                $sql = "INSERT INTO `user_entry_pass` (`user_id`, `mail`, `unique_number`) VALUES ('$user_name', '$mail', '$uuid')";
                $result = mysqli_query($connect, $sql);

                $bodyHtml .= "Here we attached one QR code for you. It is a entry pass for 14th-15th April.<br>
                        You have to scan this QR code at our verification desk on event date.<br>
                        It is one time scanable QR code so <b> DO NOT SHARE </b> with anyone.<br><br>";

                $bodyHtml .= "<br><img src='https://api.qrserver.com/v1/create-qr-code/?data=$uuid&amp;size=200x200' alt='' title='HELLO'/>";
            }
            $bodyHtml .= "<br><br><br>Thanks and Regards,<br>
            Team Techpulse";

            $bodyHtml .= "</body></html>";

            $mail = new PHPMailer(true);

            try {
                // Specify the SMTP settings.
                $mail->isSMTP();
                $mail->setFrom($sender, $senderName);
                $mail->Username   = $usernameSmtp;
                $mail->Password   = $passwordSmtp;
                $mail->Host       = $host;
                $mail->Port       = $port;
                $mail->SMTPAuth   = true;
                $mail->SMTPSecure = 'tls';
                //  $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);

                // Specify the message recipients.
                $mail->addAddress($recipient);
                // You can also add CC, BCC, and additional To recipients here.

                // Specify the content of the message..
                $mail->isHTML(true);
                $mail->Subject    = $subject;
                $mail->Body       = $bodyHtml;
                $mail->AltBody    = $bodyText;
                $mail->Send();
                echo "Email sent!", PHP_EOL;
            } catch (phpmailerException $e) {
                echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
            } catch (Exception $e) {
                echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
            }

            header("location: ../success.php");
        } else {
            header("location: ../login.php");
        }
    } else {
        header("location: ../login.php");
    }
} else {
    $html = "<p>Your payment failed</p>
        <p>{$error}</p>";
}
