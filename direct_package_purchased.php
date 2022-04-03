<?php
session_start();
    if(isset($_SESSION['logged_in']))
    {
        if($_SESSION['logged_in'] == 'true')
        {
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $flag = 0;

                $unique_code = $_POST['unique_code'];
                $team_code = $_POST['team_code'];

                $unique_code = str_replace("<","&lt;","$unique_code");
                $unique_code = str_replace(">", "&gt;", "$unique_code");
                $team_code = str_replace("<","&lt;","$team_code");
                $team_code = str_replace(">", "&gt;", "$team_code");

                $unique_code = str_replace("=","&eq;","$unique_code");
                $unique_code = str_replace("\'", " ", "$unique_code");
                $unique_code = str_replace("\"", " ", "$unique_code");
        
                $team_code = str_replace("=","&eq;","$team_code");
                $team_code = str_replace("\'", " ", "$team_code");
                $team_code = str_replace("\"", " ", "$team_code");

                require "database_connection.php";

                $sql = "SELECT `$team_code` FROM `unique_codes` WHERE $team_code ='$unique_code'";
                $result = mysqli_query($connect, $sql);

                $rows = mysqli_num_rows($result);

                if($rows == 0)
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
                                Invalid unique code
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
        header("refresh:3,url=pay_pages/pay_for_package.php");

                   $flag = 1;
                   exit;
                }

                $sql = "SELECT * FROM `promotion_team_code` WHERE team_code='$team_code'";
                $result = mysqli_query($connect, $sql);

                $rows = mysqli_num_rows($result);

                if($rows == 0)
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
                                Invalid promotion team code
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
        header("refresh:3,url=pay_pages/pay_for_package.php");

                   $flag = 1;
                   exit;
                }

                if($flag == 0)
                {
                    $user_name = $_SESSION['user_id'];
                    $name = $_SESSION['name'];
                    $phone_number = $_SESSION['phone_number'];
                    $mail = $_SESSION['mail'];
                    $college = $_SESSION['college'];

                    $sql = "SELECT event_count FROM `user` WHERE user_id='$user_name'";
                    $result = mysqli_query($connect, $sql);
                
                    $r = mysqli_fetch_assoc($result);
                    $event_count =  $r['event_count'];
                    $event_count = $event_count+2;
                
                    $sql = "UPDATE `user` SET event_count='$event_count' WHERE user_id='$user_name'";
                    $result = mysqli_query($connect, $sql);

                    $sql = "INSERT INTO `package_purchased_on_cash` (`user_id`,`unique_code`, `promotion_team_code`) VALUES ('$user_name', '$unique_code' ,'$team_code')";
                    $result = mysqli_query($connect, $sql);

                    $sql = "SELECT * FROM `user_entry_pass` WHERE user_id = $user_name";
                    $result = mysqli_query($connect, $sql);
                    $row = mysqli_num_rows($result);
                    if($row == 0)
                    {
                        
                    $sql = "INSERT INTO `user_entry_pass` (`user_id`, `mail`) VALUES ('$user_name', '$mail')";
                    $result = mysqli_query($connect, $sql);

                    require '../vendor/autoload.php';
                    require '../smtp.php';
        
                    $sender = 'hello@techpulse.co.in';
                    $senderName = 'Techpulse';
        
                    $recipient = $mail;
        
                    // The subject line of the email
                    $subject = 'Package purchase';
        
                    // The plain-text body of the email
                    $bodyText =  "okay you got it.";
        
                    // The HTML-formatted body of the email
                    $bodyHtml = "<html><body>";
                    $bodyHtml .= "Woo hoo! You have successfully purchased standard package.<br>";
                    $bodyHtml .= "Here's your confirmation for order number $order_id. Review your receipt and get started.<br><br>
        
                    ORDER SUMMARY:<br><br>
        
                    Product: Standard Package QTY.1<br>
                    Price: 399<br>
                    Order id: $order_id<br>
                    Payment id: $payment_id<br>
                    Order Total: [price]<br><br>
                    
                    Name:<br>
                    Email:<br>
                    phone number:<br><br>
                    
                        
                    Thanks and Regards,<br>
                    Team Techpulse";
                    $bodyHtml .= "Here we attached one QR code for you. It is a entry pass for 14th-15th April.<br>
                                You have to scan this QR code at our verification desk on event date.<br>
                                It is one time scanable QR code so <b> DO NOT SHARE </b> with anyone.";
        
                    $bodyHtml .= "<img src='https://api.qrserver.com/v1/create-qr-code/?data=$code&amp;size=200x200' alt='' title='HELLO'/>";
        
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
        
                        // Specify the content of the message.
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
                    }


                    $sql = "UPDATE `unique_codes` SET `$team_code` = 'ReMoVeD' WHERE $team_code = '$unique_code'";
                    $result = mysqli_query($connect, $sql);

                    header("location: success.php");

                }
                else
                {
                    header("location: index.php");
                }
            }
            else
            {
                header("location: index.php");
            }
        }
        else
        {
            header("location: index.php");
        }
    }
    else
    {
        header("location: index.php");
    }
?>