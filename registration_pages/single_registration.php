<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css_files/registration_form_css.css">
</head>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

    session_start();
    if(isset($_SESSION['logged_in']))
    {
        if($_SESSION['logged_in'] == 'true')
        {
            if($_SERVER['REQUEST_METHOD'] == 'GET')
            {   
                $f=0;
                foreach ($_GET as $key => $value) {
                    if($key == 'event')
                    {
                        $f = 1;
                    }
                }
                if($f == 0)
                {
                    exit;
                }
                require "../database_connection.php";
                $sql = "SELECT * FROM `events`";
                $result = mysqli_query($connect, $sql);
                $flag = 0;
                while($r = mysqli_fetch_assoc($result))
                {
                    $event_name = $r['event_name'];
                    $event = $_GET['event'];
                    if($event == $event_name)
                    {
                        $flag = 1;
                    }
                }
                if($flag == 0)
                {
                    exit;
                }
                else{
                    $user = $_SESSION['user_id'];
                    $sql = "SELECT event_count FROM `user` WHERE user_id='$user'";
                    $result = mysqli_query($connect, $sql);

                    $r = mysqli_fetch_assoc($result);
                    $event_count = $r['event_count'];

                    if($event_count == 0)
                    {
                        echo '<div id="simpleModal" class="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Customer Details Form</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    No Event remaining in '.$user.'\'s wallet
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
window.onload = function () {
    OpenBootstrapPopup();
};
function OpenBootstrapPopup() {
    $("#simpleModal").modal("show");
}
</script>'; 

                    }
                    else
                    {
                        $name = $_SESSION['name'];
                        $phone_number = $_SESSION['phone_number'];
                        $mail = $_SESSION['mail'];
                        $college = $_SESSION['college'];

                        $eve_register = $event."_register";

                        $sql = "SELECT * FROM `$eve_register` WHERE user_id='$user'";
                        $result = mysqli_query($connect, $sql);
                        $flag = 0;
                        $r = mysqli_num_rows($result);
                            if($r == 1)
                            {
                                $flag = 1;
                            }

                        if($flag == 0)
                        {
                            $event_count = $event_count - 1;
                            $sql = "UPDATE `user` SET event_count='$event_count' WHERE user_id='$user'";
                            $result = mysqli_query($connect, $sql);
    
                            $sql = "INSERT INTO `$event`( `name`, `college`, `mail`, `phone_number`) VALUES ('$name','$college','$mail','$phone_number')";
                            $result = mysqli_query($connect, $sql);

                            $eve_register = $event."_register";
                            $sql = "INSERT INTO `$eve_register` (`user_id`) VALUES ('$user')";
                            $result = mysqli_query($connect, $sql);

                            // $to = $mail;
                            // $subject = "".$event." registration";
                            // $headers = "From: jilsvaghasiya333@gmail.com";
                            // $body = "You have successfully registered in event ".$event.". Thank You.";

                            // mail($to, $subject, $body, $headers);
                            
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function


// If necessary, modify the path in the require statement below to refer to the
// location of your Composer autoload.php file.
require '../vendor/autoload.php';

// Replace sender@example.com with your "From" address.
// This address must be verified with Amazon SES.
$sender = 'techpulse2022@gmail.com';
$senderName = 'Techpluse Admin';

// Replace recipient@example.com with a "To" address. If your account
// is still in the sandbox, this address must be verified.
$recipient = 'jilsvaghasiya333@gmail.com';

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
$subject = 'AWS SNS Email test';

// The plain-text body of the email
$bodyText =  "okay you got it.";

// The HTML-formatted body of the email
$bodyHtml = '-- Put body html here --';

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
                            echo '<div id="simpleModal" class="modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Customer Details Form</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        You already Participated in this event!
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>
                        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
    window.onload = function () {
        OpenBootstrapPopup();
    };
    function OpenBootstrapPopup() {
        $("#simpleModal").modal("show");
    }
</script>'; 
                        }
                    }
                }
            }
        }
        else
        {
            header("location: ../login.php");
        }
    }
    else{
        header("location: ../login.php");
    }

?>
</html>

