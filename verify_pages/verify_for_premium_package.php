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
    if(isset($_SESSION['logged_in']))
    {
        if($_SESSION['logged_in'] == "true")
        {
            $user_name = $_SESSION['user_id'];
            $name = $_SESSION['name'];
            $phone_number = $_SESSION['phone_number'];
            $mail = $_SESSION['mail'];
            $college = $_SESSION['college'];

            $event_count = 4;
            $workshop_count = 1;

            $payment_id = $_POST['razorpay_payment_id'];
            $order_id = $_POST['order_id'];

        
            $sql = "SELECT event_count FROM `user` WHERE user_id='$user_name'";
            $result = mysqli_query($connect, $sql);
            $r = mysqli_fetch_assoc($result);
            $event_count = $event_count + $r['event_count'];
            $workshop_count = $workshop_count + $r['workshop_count'];
        
            $sql = "UPDATE `user` SET event_count='$event_count' WHERE user_id='$user_name'";
            $result = mysqli_query($connect, $sql);
            $sql = "UPDATE `user` SET workshop_count='$workshop_count' WHERE user_id='$user_name'";
            $result = mysqli_query($connect, $sql);
        
            $sql = "INSERT INTO `premium_package_purchased` (`user_id`, `payment_id`) VALUES ('$user_name', '$payment_id')";
            $result = mysqli_query($connect, $sql);

            
            $sql = "SELECT * FROM `user_entry_pass` WHERE user_id = $user_name";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_num_rows($result);

            if($row == 0)
            {
            $sql = "INSERT INTO `user_entry_pass` (`user_id`, `mail`) VALUES ('$user_name', '$mail')";
            $result = mysqli_query($connect, $sql);

            require '../vendor/autoload.php';

            $sender = 'hello@techpulse.co.in';
            $senderName = 'Techpluse Admin';
            
            $recipient = $mail;
            

            // The subject line of the email
            $subject = 'Premium package purchase';
            
            // The plain-text body of the email
            $bodyText =  "okay you got it.";
            
            // The HTML-formatted body of the email
            $bodyHtml = 'You have successfully purchased a premium package... your payment id is : '.$payment_id.'';
            
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
            
                // Specify the content of the message.
                $mail->isHTML(true);
                $mail->Subject    = $subject;
                $mail->Body       = $bodyHtml;
                $mail->AltBody    = $bodyText;
                $mail->Send();
                echo "Email sent!" , PHP_EOL;
            } 
            catch (phpmailerException $e) {
                echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
            } catch (Exception $e) {
                echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
            }
        }

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

