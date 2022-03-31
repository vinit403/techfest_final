<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $pass1 = $_POST['pass1'];
        $psss2 = $_POST['pass2'];
        $mail = $_POST['mail'];
        if($pass1 == $pass2)
        {
            $pass1 = password_hash($pass1, PASSWORD_DEFAULT);

            $sql = "UPDATE `user` SET code=0 WHERE mail='$mail'";
            $result = mysqli_query($connect, $sql);

            $sql = "UPDATE `user` SET password='$pass1' WHERE mail='$mail'";
            $result = mysqli_query($connect, $sql);

            header("location: login.php");
        }
        else
        {
            echo '<script type ="text/JavaScript">
            alert("Password not match")
            window.location = "login.php"
            </script>';
        }
    }
?>