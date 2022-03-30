<?php
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
            $event = $_POST['event'];

            $sql = "SELECT user_id FROM `user`";
            $result = mysqli_query($connect, $sql);

            $flag2 = 0;

            while($r = mysqli_fetch_assoc($result))
            {
                $user = $r['user_id'];
                if($user == $uid_member2)
                {
                    $flag2 = 1;
                }
            }
            if($uid_member2 != "")
            {
                if($flag2 == 0)
                {
                    echo '<script type ="text/JavaScript">
                    alert("'.$uid_member2.' not exist")
                    window.location = "../index.php";
                   </script>'; 
                   $flag_verified = 1;
                }
            }

            $sql = "SELECT event_count FROM `user` WHERE user_id='$uid_leader'";
            $result = mysqli_query($connect, $sql);
            $r2 = mysqli_fetch_assoc($result);
            $event_count = $r2['event_count'];
            if($event_count == 0)
            {
                echo '<script type ="text/JavaScript">
                alert("No event remaining in '.$uid_leader.'\'s wallet")
                window.location = "../index.php";
               </script>'; 
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
                    echo '<script type ="text/JavaScript">
                    alert("No event remaining in '.$uid_member2.'\'s wallet")
                    window.location = "../index.php";
                   </script>'; 
                   $flag_verified = 1;
    
                }
            }

            $eve_register = $event."_register";

            $sql = "SELECT * FROM `$eve_register` WHERE user_id='$uid_leader'";
            $result = mysqli_query($connect, $sql);
            $r = mysqli_num_rows($result);
                if($r == 1)
                {
                    echo '<script type ="text/JavaScript">
                    alert("'.$uid_leader.' is already in this event")
                    window.location = "../index.php"
                   </script>'; 

                   $flag_verified = 1;

                }

            if($uid_member2 != "")
            {
            $sql = "SELECT * FROM `$eve_register` WHERE user_id='$uid_member2'";
            $result = mysqli_query($connect, $sql);
            $r = mysqli_num_rows($result);
                if($r == 1)
                {
                    echo '<script type ="text/JavaScript">
                    alert("'.$uid_member2.' is already in this event")
                    window.location = "../index.php"
                   </script>'; 

                   $flag_verified = 1;

                }
            }
            // $sql = "SELECT * FROM `$event` WHERE userid='$uid_leader'";
            // $sql2 = "SELECT * FROM `$event` WHERE userid_member2='$uid_member2'";
            // $sql3 = "SELECT * FROM `$event` WHERE userid_member3='$uid_member3'";
            // $sql4 = "SELECT * FROM `$event` WHERE userid_member4='$uid_member4'";
            // $result = mysqli_query($connect, $sql);
            // $result2 = mysqli_query($connect, $sql2);
            // $result3 = mysqli_query($connect, $sql3);
            // $result4 = mysqli_query($connect, $sql4);

            // $rws = mysqli_num_rows($result);
            // $rws2 = mysqli_num_rows($result2);
            // $rws3 = mysqli_num_rows($result3);
            // $rws4 = mysqli_num_rows($result4);

            // if($rws == 1)
            // {
            //     echo '<script type ="text/JavaScript">
            //     alert("'.$uid_leader.'is already in this event")ss
            //     window.location = "group4_registration.php?event='.$event.'"
            //    </script>'; 
            //    $flag_verified = 1;

            // }
            // if($rws2 == 1)
            // {
            //     echo '<script type ="text/JavaScript">
            //     alert("'.$uid_member2.'is already in this event")ss
            //     window.location = "group4_registration.php?event='.$event.'"
            //    </script>'; 
            //    $flag_verified = 1;

            // }
            // if($rws3 == 1)
            // {
            //     echo '<script type ="text/JavaScript">
            //     alert("'.$uid_member3.'is already in this event")ss
            //     window.location = "group4_registration.php?event='.$event.'"
            //    </script>'; 
            //    $flag_verified = 1;

            // }
            // if($rws4 == 1)
            // {
            //     echo '<script type ="text/JavaScript">
            //     alert("'.$uid_member4.'is already in this event")ss
            //     window.location = "group4_registration.php?event='.$event.'"
            //    </script>'; 
            //    $flag_verified = 1;

            // }

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
    
                $sql = "INSERT INTO `$event` (`leader_name`, `leader_college`, `leader_mail`, `leader_phone_number`, `member2_name`,`member2_college`,`member2_mail`) VALUES ('$name','$college','$mail','$phone_number','$name_2','$college_2','$mail_2')";
                $result = mysqli_query($connect, $sql);
                
                $eve_register = $event."_register";
                $sql = "INSERT INTO `$eve_register` (`user_id`) VALUES ('$uid_leader')";
                $result = mysqli_query($connect, $sql);
                if($uid_member2 != "")
                {
                    $sql = "INSERT INTO `$eve_register` (`user_id`) VALUES ('$uid_member2')";
                    $result = mysqli_query($connect, $sql);
                }

                $event_count = $event_count - 1;

                if($uid_member2 != "")
                {
                    $event_count2 = $event_count2 - 1;
                }
    
                $sql = "UPDATE `user` SET event_count='$event_count' WHERE user_id='$uid_leader'";
                $result = mysqli_query($connect, $sql);

                if($uid_member2 != "")
                {
                    $sql = "UPDATE `user` SET event_count='$event_count2' WHERE user_id='$uid_member2'";
                    $result = mysqli_query($connect, $sql);
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