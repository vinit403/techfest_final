<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// If necessary, modify the path in the require statement below to refer to the
// location of your Composer autoload.php file.
require 'vendor/autoload.php';
require 'smtp.php';

// Replace sender@example.com with your "From" address.
// This address must be verified with Amazon SES.
$sender = 'hello@techpulse.co.in';
$senderName = 'Techpluse';

// Replace recipient@example.com with a "To" address. If your account
// is still in the sandbox, this address must be verified.
// $recipient = 'utsavsachapara007@gmail.com';

// Replace smtp_username with your Amazon SES SMTP user name.
// $usernameSmtp = 'AKIAR3NH6FDMMDNB25EB';

// Replace smtp_password with your Amazon SES SMTP password.
// $passwordSmtp = 'BJM+spGKi0uSUKETgnodvcqdKzyFuZs5Q/pTHEPJyOjY';

// Specify a configuration set. If you do not want to use a configuration
// set, comment or remove the next line.
//$configurationSet = 'ConfigSet';

// If you're using Amazon SES in a region other than US West (Oregon),
// replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
// endpoint in the appropriate region.
// $host = 'email-smtp.ap-south-1.amazonaws.com';
// $port = 587;

// The subject line of the email.
$subject = 'Jsk, Thank you for Participating in Workshop';
    
// The plain-text body of the email
$bodyText =  "okay you got it.";

// The HTML-formatted body of the email
$bodyHtml = "<html><body>";
$bodyHtml .= "Thank you for participating in Techpulse Workshop.<br><br>";
$bodyHtml .= "Workshop details are mention below.<br><br>

ORDER SUMMARY:<br><br>

Workshop Name: AI/ML

Name: Chillimuntha Jothsna Sri Kathyayani<br>
Email: 21se02ml006@ppsu.ac.in<br>
phone number: 9979439989 <br><br>
    
Thanks and Regards,<br>
Team Techpulse";

$bodyHtml .= "</body></html>";

$recipient = "";
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
