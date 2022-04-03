<!DOCTYPE html>

<html>
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    <link rel="stylesheet" type="text/css" href="style.css">


    <!-- Title Page-->
    <title>Forgot password</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css2/main.css" rel="stylesheet" media="all">
</head>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$err = "";
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            require "database_connection.php";

            $mailid = $_POST['usermailid'];
            $name = $_POST['user_name'];

            $sql = "SELECT * FROM `user` WHERE mail ='$mailid' AND user_id='$name'";
            $result = mysqli_query($connect, $sql);

            if(mysqli_num_rows($result) == 0)
            {
                $err = "No any account found with this mail";

                echo '<script type ="text/JavaScript">
                 alert("Account Not found. Check your input values.")
                window.location = "forgot_password.php"
                </script>';
            }
            else
            {
                $code = rand(100000, 999999);

                require 'vendor/autoload.php';
                require 'smtp.php';
                $sender = 'admin@techpulse.co.in';
                $senderName = 'Techpluse Admin';
                $recipient = $mailid;

                // The subject line of the email
                $subject = 'Your One-Time Passcode from Techpulse';

                // The plain-text body of the email
                $bodyText =  "okay you got it.";

                // The HTML-formatted body of the email
                $bodyHtml = "<html><body>";
                $bodyHtml .= "Dear $name,<br>";
                $bodyHtml .= "Greetings from Techpulse. Your OTP is $code. Please note that OTP is valid for 10 minutes.<br><br>

                We assure you of our best services.<br><br>
                
                Thanks and Regards,<br>
                
                Team Techpulse";
                $bodyHtml .= "</body></html>";

                // $bodyHtml = 'Your code for verification is '.$code.'';

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

                    $sql = "UPDATE `user` SET code='$code' WHERE mail='$mailid'";
                    $result = mysqli_query($connect, $sql);


                    // echo "Email sent!" , PHP_EOL;
                } 
                catch (phpmailerException $e) {
                    echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
                } catch (Exception $e) {
                    echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
                }

            }
        }
        else
        {
            exit;
        }
?>

<body>
        <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
            <div class="wrapper wrapper--w780">
                <div class="card card-5">
                    <div class="card-heading"></div>
                    <div class="card-body">
                    <h2 class="title">Enter Verification Code</h2>
                        
                            <form action="reset_password.php" method="post" id="form1">
    
                                <div>
                                    <p style="color:red; font-size:15px">
                                        <?php echo $err ?>
                                    </p>
                                </div>
                           
                                <div class="input-group">
                                    <input class="input--style-3" type="number" placeholder="Enter Verification Code" name="code" maxlength="6" required>
                                </div>

                                <input type="hidden" name="mailid" value="<?php echo $mailid ?>">

                                <div class="p-t-10">
                                    <button class="btn btn--pill btn--green" type="submit" id="next1">Verify</button>
                                </div>
                                
                            </form>
    
                            
                    </div>
                </div>
            </div>
        </div>
    
    
    
    
                            <!-- Jquery JS-->
                            <script src="vendor/jquery/jquery.min.js"></script>
                            <!-- Vendor JS-->
                            <script src="vendor/select2/select2.min.js"></script>
                            <script src="vendor/datepicker/moment.min.js"></script>
                            <script src="vendor/datepicker/daterangepicker.js"></script>
    
                            <!-- Main JS-->
                            <script src="js/global.js"></script>
    
    </body>
</html>
