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
                            require '../vendor/autoload.php';

                            require 'C:/xampp/htdocs/techfest_final/vendor/phpmailer/phpmailer/src/Exception.php';
                            require 'C:/xampp/htdocs/techfest_final/vendor/phpmailer/phpmailer/src/PHPMailer.php';
                            require 'C:/xampp/htdocs/techfest_final/vendor/phpmailer/phpmailer/src/SMTP.php';

                            $mail = new PHPMailer(true);

                            try {
                                $mail->SMTPDebug = 2;                                       
                                $mail->isSMTP();                                            
                                $mail->Host       = 'email-smtp.ap-south-1.amazonaws.com';                    
                                $mail->SMTPAuth   = true;                             
                                $mail->Username   = 'AKIAR3NH6FDMMDNB25EB';                 
                                $mail->Password   = 'BJM+spGKi0uSUKETgnodvcqdKzyFuZs5Q/pTHEPJyOjY';                        
                                $mail->SMTPSecure = 'tls';                              
                                $mail->Port       = 587;  
                              
                                $mail->setFrom('techpulse2022@gmail.com', 'Techpulse 2022');           
                                $mail->addAddress($mail);
                                $mail->addAddress($mail, $name);
                                   
                                $mail->isHTML(true);                                  
                                $mail->Subject = $event.' registration';
                                $mail->Body    = 'You have registered for '.$event.'.. Thank you. ';
                                $mail->AltBody = 'Body in plain text for non-HTML mail clients';
                                $mail->send();
                            } catch (Exception $e) {
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

