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

            $event_count = 4;
            $workshop_count = 1;

            $payment_id = $_POST['razorpay_payment_id'];
        
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


            $sql = "INSERT INTO `user_entry_pass` (`user_id`, `mail`) VALUES ('$user_name', '$mail')";
            $result = mysqli_query($connect, $sql);

            require '../vendor/autoload.php';

            // Replace sender@example.com with your "From" address.
            // This address must be verified with Amazon SES.
            $sender = 'techpulse2022@gmail.com';
            $senderName = 'Techpluse Admin';
            
            // Replace recipient@example.com with a "To" address. If your account
            // is still in the sandbox, this address must be verified.
            $recipient = $mail;
            
            // Replace smtp_username with your Amazon SES SMTP user name.
            $usernameSmtp = 'AKIAR3NH6FDMMDNB25EB';
            
            // Replace smtp_password with your Amazon SES SMTP password.
            $passwordSmtp = 'BJM+spGKi0uSUKETgnodvcqdKzyFuZs5Q/pTHEPJyOjY';
            
            // Specify a configuration set. If you do not want to use a configuration
            // set, comment or remove the next line.
            //$configurationSet = 'ConfigSet';
            
            // If you're using Amazon SES in a region other than US West (Oregon),
            // replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
            // endpoint in the appropriate region.
            $host = 'email-smtp.ap-south-1.amazonaws.com';
            $port = 587;
            
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

