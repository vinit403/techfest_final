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
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS -->
    <link href="css2/main.css" rel="stylesheet" media="all">

</head>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $user_name = $_POST['user_name'];
        $name = $_POST['name'];
        $college_name = $_POST['college_name'];
        $mail = $_POST['mail'];
        $phone_number = $_POST['phone_number'];
        $passcode = $_POST['password'];
        $passcode2 = $_POST['password2'];

        $name = str_replace("<","&lt;","$name");
        $name = str_replace(">", "&gt;", "$name");
        $college_name = str_replace("<","&lt;","$college_name");
        $college_name = str_replace(">", "&gt;", "$college_name");
        $mail = str_replace("<","&lt;","$mail");
        $mail = str_replace(">", "&gt;", "$mail");
        $user_name = str_replace("<","&lt;","$user_name");
        $user_name = str_replace(">", "&gt;", "$user_name");
        $passcode = str_replace("<","&lt;","$passcode");
        $passcode = str_replace(">", "&gt;", "$passcode");
        $passcode2 = str_replace("<","&lt;","$passcode2");
        $passcode2 = str_replace(">", "&gt;", "$passcode2");

        $name = str_replace("=","&eq;","$name");
        $name = str_replace("\'", " ", "$name");
        $name = str_replace("\"", " ", "$name");

        $college_name = str_replace("=","&eq;","$college_name");
        $college_name = str_replace("\'", " ", "$college_name");
        $college_name = str_replace("\"", " ", "$college_name");

        $mail = str_replace("=","&eq;","$mail");
        $mail = str_replace("\'", " ", "$mail");
        $mail = str_replace("\"", " ", "$mail");

        $user_name = str_replace("=","&eq;","$user_name");
        $user_name = str_replace("\'", " ", "$user_name");
        $user_name = str_replace("\"", " ", "$user_name");

        $passcode = str_replace("=","&eq;","$passcode");
        $passcode = str_replace("\'", " ", "$passcode");
        $passcode = str_replace("\"", " ", "$passcode");

        $passcode2 = str_replace("=","&eq;","$passcode2");
        $passcode2 = str_replace("\'", " ", "$passcode2");
        $passcode2 = str_replace("\"", " ", "$passcode2");
        
        $flag = 0;

        if($passcode != $passcode2)
        {
            echo  '<script type ="text/JavaScript">
             alert("password not match")
            </script>'; 

            $flag = 1;
        }

        include "database_connection.php";
        $sql = "SELECT * FROM `user`";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_num_rows($result);
        if($row != 0)
        {
            while($r = mysqli_fetch_assoc($result))
            {
                $username = $r['user_id'];
                if($username == $user_name)
                {
                    echo  '<script type ="text/JavaScript">
                    alert("this username in already exist")
                   </script>'; 
    
                   $flag = 1;
                }
            }
        }

        $sql = "SELECT * FROM `user`";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_num_rows($result);
        if($row != 0)
        {
            while($r = mysqli_fetch_assoc($result))
            {
                $temp_mail = $r['mail'];
                if($temp_mail == $mail)
                {
                    echo  '<script type ="text/JavaScript">
                    alert("this mail is already used");
                   </script>'; 
    
                   $flag = 1;
                }
            }
        }

        if($flag == 0)
        {
            include "database_connection.php";
            $sql = "INSERT INTO `user` ( `user_id`, `name`, `college`, `mail`, `phone_number`, `password`) VALUES ( '$user_name', '$name', '$college_name', '$mail', '$phone_number', '$passcode')";
            $result = mysqli_query($connect, $sql);
            $sql = "INSERT INTO `event_purchased` ( `user_id`, `number_of_purchase`) VALUES ('$user_name', '0')";
            $result = mysqli_query($connect, $sql);

            session_start();
            $_SESSION['logged_in'] = "true";
            $_SESSION['user_id'] = $user_name;
            $_SESSION['name'] = $name;
            $_SESSION['phone_number'] = $phone_number;
            $_SESSION['mail'] = $mail;
            $_SESSION['college'] = $college_name;

            header("location: index.php");
        }

    }
?>
<body>
    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
                    <div class="container">
                        <form id="form1" action="sign_up.php" method="post">
                            <h3>Create Account</h3><br>
                            <input type="text" name="user_name" placeholder="User Id" maxlength="20" required>
                            <input type="text" name="name" placeholder="Full Name" maxlength="50" required>
                            <input type="text" name="college_name" placeholder="College Name" maxlength="100" required>
                            <input type="email" name="mail" placeholder="Mail Id" maxlength="50" required>
                            <input type="number" name="phone_number" placeholder="Phone Number" max="9999999999" min="1000000000" required>
                            <input type="password" name="password" placeholder="Create Password" maxlength="20" required>
                            <input type="password" name="password2" placeholder="Confirm Password" maxlength="20" required>
                            <div class="btn-box">
                                <button type="submit" id="next1">LogIn</button>
                            </div>
                        </form>

                        <!-- <form id="form2">
        <h3>Contact Details</h3><br>
        <input type="mail" placeholder="Email" required>
        <input type="phone" placeholder="Mobile No." required>

        <div class="btn-box">
            <button type="button" id="back1">Back</button>
            <button type="button" id="next2">Next</button>
        </div>
    </form>

    <form id="form3">
        <h3>Create Password</h3><br>
        <input type="password" placeholder="Create Password" required>
        <input type="password" placeholder="Confirm Password." required>

        <div class="btn-box">
            <button type="button" id="back2">Back</button>
            <button type="button">Submit</button>
        </div>
    </form>

    <div class="step-row">
        <div id="progress"></div>
        <div class="step-col"><small>Step 1</small></div>
        <div class="step-col"><small>Step 2</small></div>
        <div class="step-col"><small>Step 3</small></div>
    </div>
    </div>

    <script type="text/javascript">
        var form1=document.getElementById("form1");
        var form2=document.getElementById("form2");
        var form3=document.getElementById("form3");

        var next1=document.getElementById("next1");
        var next2=document.getElementById("next2");
        var back1=document.getElementById("back1");
        var back2=document.getElementById("back2");

        var progress=document.getElementById("progress");


        next1.onclick=function(){
            form1.style.left="-450px"
            form2.style.left="40px"
            progress.style.width="240px"
        }

        back1.onclick=function(){
            form1.style.left="40px"
            form2.style.left="450px"
            progress.style.width="120px"
        }

        next2.onclick=function(){
            form2.style.left="-450px"
            form3.style.left="40px"
            progress.style.width="360px"
        }

        back2.onclick=function(){
            form2.style.left="40px"
            form3.style.left="450px"
            progress.style.width="240px"
        }


    </script>
                </div>
            </div>
        </div>
    </div> -->




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

