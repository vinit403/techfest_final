<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $user_name = $_POST['user_name'];
        $name = $_POST['name'];
        $college_name = $_POST['college_name'];
        $mail = $_POST['mail'];
        $phone_number = $_POST['phone_number'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        if($password != $password2)
        {
            header("location : ")
        }
    }
?>
<body>
    
</body>
</html>