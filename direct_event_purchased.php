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

                $sql = "SELECT * FROM `unique_codes` WHERE code='$unique_code'";
                $result = mysqli_query($connect, $sql);

                $rows = mysqli_num_rows($result);

                if($rows == 0)
                {
                    echo '<script type ="text/JavaScript">
                    alert("Invalid Unique Code")
                    window.location = "pay_pages/pay_for_event.php"
                   </script>'; 
                    exit;
                   $flag = 1;
                }

                $sql = "SELECT * FROM `promotion_team_code` WHERE team_code='$team_code'";
                $result = mysqli_query($connect, $sql);

                $rows = mysqli_num_rows($result);

                if($rows == 0)
                {
                    echo '<script type ="text/JavaScript">
                    alert("Invalid Promotion Team Code")
                    window.location = "pay_for_event.php"
                   </script>'; 
                    exit;
                   $flag = 1;
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
                    $event_count = $event_count+1;
                
                    $sql = "UPDATE `user` SET event_count='$event_count' WHERE user_id='$user_name'";
                    $result = mysqli_query($connect, $sql);

                    $sql = "INSERT INTO `event_purchased_on_cash` (`user_id`,`unique_code`, `promotion_team_code`) VALUES ('$user_name', '$unique_code' ,'$team_code')";
                    $result = mysqli_query($connect, $sql);

                    $sql = "INSERT INTO `user_entry_pass` (`user_id`, `mail`) VALUES ('$user_name', '$mail')";
                    $result = mysqli_query($connect, $sql);

                    $sql = "DELETE FROM `unique_codes` WHERE code='$unique_code'";
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