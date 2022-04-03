<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_SESSION['logged_in']))
    {
        if($_SESSION['logged_in'] == 'true')
        {
            $flag_verified = 0;
            require "../database_connection.php";

            $uid_leader = $_SESSION['user_id'];
            $uid_member2 = $_POST['uid_member2'];
            $uid_member2 = str_replace("<","&lt;","$uid_member2");
            $uid_member2= str_replace(">", "&gt;", "$uid_member2");

            $uid_member3 = $_POST['uid_member3'];
            $uid_member3 = str_replace("<","&lt;","$uid_member3");
            $uid_member3= str_replace(">", "&gt;", "$uid_member3");

            $event = $_POST['event'];

            $sql = "SELECT user_id FROM `user`";
            $result = mysqli_query($connect, $sql);

            $flag2 = 0;
            $flag3 = 0;

            while($r = mysqli_fetch_assoc($result))
            {
                $user = $r['user_id'];
                if($user == $uid_member2)
                {
                    $flag2 = 1;
                }
                if($user == $uid_member3)
                {
                    $flag3 = 1;
                }
            }

            if($uid_member2 != "")
            {
                if($flag2 == 0)
                {
                    echo '<div id="simpleModal" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Alert</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                '.$uid_member2.' not exist
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
header("refresh:3,url=../Event.php");
                $flag_verified = 1;
                }
            }

            if($uid_member3 != "")
            {
                if($flag3 == 0)
                {
                    echo '<div id="simpleModal" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Alert</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                '.$uid_member3.' not exist
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
header("refresh:3,url=../Event.php");
                   $flag_verified = 1;
    
                }
            }

            $sql = "SELECT event_count FROM `user` WHERE user_id='$uid_leader'";
            $result = mysqli_query($connect, $sql);
            $r2 = mysqli_fetch_assoc($result);
            $event_count = $r2['event_count'];
            if($event_count == 0)
            {
                echo '<div id="simpleModal" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Alert</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            No event remaining in '.$uid_leader.'\'s wallet
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
header("refresh:3,url=../Event.php");
               $flag_verified = 1;

            }

            if($uid_member2 != "")
            {
                $sql = "SELECT event_count FROM `user` WHERE user_id='$uid_member2'";
                $result = mysqli_query($connect, $sql);
                $r2 = mysqli_fetch_assoc($result);
                $event_count2 = $r2['event_count'];
                if($event_count2 == 0)
                {
                    echo '<div id="simpleModal" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Alert</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                No event remaining in '.$uid_member2.'\'s wallet
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
header("refresh:3,url=../Event.php");
                   $flag_verified = 1;
    
                }
            }

            if($uid_member3 != "")
            {
                $sql = "SELECT event_count FROM `user` WHERE user_id='$uid_member3'";
                $result = mysqli_query($connect, $sql);
                $r2 = mysqli_fetch_assoc($result);
                $event_count3 = $r2['event_count'];
                if($event_count3 == 0)
                {
                    echo '<div id="simpleModal" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Alert</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                No event remaining in '.$uid_member3.'\'s wallet
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
header("refresh:3,url=../Event.php");
                   $flag_verified = 1;
    
                }
            }

            $eve_register = $event."_register";

            $sql = "SELECT * FROM `$eve_register` WHERE user_id='$uid_leader'";
            $result = mysqli_query($connect, $sql);
            $r = mysqli_num_rows($result);
                if($r == 1)
                {
                    echo '<div id="simpleModal" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Alert</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                '.$uid_leader.' is already in this event
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
header("refresh:3,url=../Event.php");

                   $flag_verified = 1;

                }

            if($uid_member2 != "")
            {
            $sql = "SELECT * FROM `$eve_register` WHERE user_id='$uid_member2'";
            $result = mysqli_query($connect, $sql);
            $r = mysqli_num_rows($result);
                if($r == 1)
                {
                    echo '<div id="simpleModal" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Alert</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                '.$uid_member2.' is already in this event
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
header("refresh:3,url=../Event.php");

                   $flag_verified = 1;

                }
            }
            if($uid_member3 != "")
            {
            $sql = "SELECT * FROM `$eve_register` WHERE user_id='$uid_member3'";
            $result = mysqli_query($connect, $sql);
            $r = mysqli_num_rows($result);
                if($r == 1)
                {
                    echo '<div id="simpleModal" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Alert</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                '.$uid_member3.' is already in this event
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
header("refresh:3,url=../Event.php");

                   $flag_verified = 1;

                }
            }


            if($flag_verified == 0)
            {
                $userid = $_SESSION['user_id'];
                $name = $_SESSION['name'];
                $phone_number = $_SESSION['phone_number'];
                $mail = $_SESSION['mail'];
                $college = $_SESSION['college'];
                
                if($uid_member2 != "")
                {
                    $sql = "SELECT * FROM `user` WHERE user_id='$uid_member2'";
                    $result = mysqli_query($connect, $sql);
                    $r = mysqli_fetch_assoc($result);
                    $name_2 = $r['name'];
                    $mail_2 = $r['mail'];
                    $college_2 = $r['college'];
                }
                
                if($uid_member3 != "")
                {
                    $sql = "SELECT * FROM `user` WHERE user_id='$uid_member3'";
                    $result = mysqli_query($connect, $sql);
                    $r = mysqli_fetch_assoc($result);
                    $name_3 = $r['name'];
                    $mail_3 = $r['mail'];
                    $college_3 = $r['college'];
                }
    
    
                $sql = "INSERT INTO `$event` (`leader_name`, `leader_college`, `leader_mail`, `leader_phone_number`, `member2_name`,`member2_college`,`member2_mail`, `member3_name`, `member3_college`, `member3_mail`) VALUES ('$name','$college','$mail','$phone_number','$name_2','$college_2','$mail_2','$name_3','$college_3','$mail_3')";
                $result = mysqli_query($connect, $sql);
                
                $eve_register = $event."_register";
                $sql = "INSERT INTO `$eve_register` (`user_id`) VALUES ('$uid_leader')";
                $result = mysqli_query($connect, $sql);
                if($uid_member2 != "")
                {
                    $sql = "INSERT INTO `$eve_register` (`user_id`) VALUES ('$uid_member2')";
                    $result = mysqli_query($connect, $sql);
                }
                if($uid_member3 != "")
                {
                    $sql = "INSERT INTO `$eve_register` (`user_id`) VALUES ('$uid_member3')";
                    $result = mysqli_query($connect, $sql);
                }

                $event_count = $event_count - 1;
                if($uid_member2 != "")
                {
                    $event_count2 = $event_count2 - 1;
                }
                if($uid_member3 != "")
                {
                    $event_count3 = $event_count3 - 1;
                }

                $sql = "UPDATE `user` SET event_count='$event_count' WHERE user_id='$uid_leader'";
                $result = mysqli_query($connect, $sql);

                if($uid_member2 != "")
                {
                    $sql = "UPDATE `user` SET event_count='$event_count2' WHERE user_id='$uid_member2'";
                    $result = mysqli_query($connect, $sql);
                }
                if($uid_member3 != "")
                {
                    $sql = "UPDATE `user` SET event_count='$event_count3' WHERE user_id='$uid_member3'";
                    $result = mysqli_query($connect, $sql);
                }
  
                require '../vendor/autoload.php';
                require '../smtp.php';

                $sender = 'hello@techpulse.co.in';
                $senderName = 'Techpluse';
                $recipient = $mail;

                $subject = $name . ', Thank you for Participating';

                // The plain-text body of the email
                $bodyText =  "okay you got it.";

                // The HTML-formatted body of the email
                $bodyHtml = "<html><body>";
                $bodyHtml .= "Thank you for participating in Techpulse Events.<br><br>";
                $bodyHtml .= "Event details are mention below.<br><br>

                Event Name: $event<br>
                Event Participator:<br> 
                        $name <br>
                        $name_2 <br>
                        $name_3 <br><br>
                
                Name: $name<br>
                Email: $mail<br>
                phone number: $phone_number<br><br>
                
                    
                Thanks and Regards,<br>
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
                
            }
        }
        else
        {
            header("location: ../index.php");
        }
    }
    else
    {
        header("location: ../index.php");
    }
}
else
{
    header("location: ../index.php");
}
?>