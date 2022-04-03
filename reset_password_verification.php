<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];

        $mailid = $_POST['mailid'];

        if($pass1 == $pass2)
        {
            require "database_connection.php";

            $sql = "UPDATE `user` SET code='0' WHERE mail='$mailid'";
            $result = mysqli_query($connect, $sql);

            $pass1 = password_hash($pass1, PASSWORD_DEFAULT);

            $sql = "UPDATE `user` SET password='$pass1' WHERE mail='$mailid'";
            $result = mysqli_query($connect, $sql);

            header("location: login.php");
        }
        else
        {
            echo '<script type ="text/JavaScript">
            alert("Password not match'.$pass1.' and '.$pass2.'")
            window.location = "login.php"
            </script>';
        }
    }
?>