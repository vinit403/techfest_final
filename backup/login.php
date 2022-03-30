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
    <title>Registration</title>

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
session_start();
session_unset();
session_destroy();

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $user_name = $_POST['user_name'];
        $passcode = $_POST['password'];

        $user_name = str_replace("<","&lt;","$user_name");
        $user_name = str_replace(">", "&gt;", "$user_name");
        $passcode = str_replace("<","&lt;","$passcode");
        $passcode = str_replace(">", "&gt;", "$passcode");

        $user_name = str_replace("=","&eq;","$user_name");
        $user_name = str_replace("\'", " ", "$user_name");
        $user_name = str_replace("\"", " ", "$user_name");

        $passcode = str_replace("=","&eq;","$passcode");
        $passcode = str_replace("\'", " ", "$passcode");
        $passcode = str_replace("\"", " ", "$passcode");


            include "database_connection.php";
            $sql = "SELECT * FROM `user` WHERE user_id = '$user_name'";
            $result = mysqli_query($connect, $sql);
            $row = mysqli_num_rows($result);
            if($row != 0)
            {
                while($r = mysqli_fetch_assoc($result))
                {
                    $pass = $r['password'];
                    if($pass == $passcode)
                    {
                        echo  '<script type ="text/JavaScript">
                        alert("login successfull")
                       </script>'; 
    
                       session_start();
                       $_SESSION['logged_in'] = "true";
                       $_SESSION['user_id'] = $user_name;
                       $_SESSION['name'] = $r['name'];
                       $_SESSION['phone_number'] = $r['phone_number'];
                       $_SESSION['mail'] = $r['mail'];
                       $_SESSION['college'] = $r['college'];

                       header("location: index.php");

                    }
                    else
                    {
                        echo  '<script type ="text/JavaScript">
                        alert("password incorrect")
                       </script>'; 
                    }
                }
            }
            else
            {
                echo  '<script type ="text/JavaScript">
                alert("user not exist")
               </script>'; 
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
                        <form id="form1" action="login.php" method="post">
                            <h3>Log In</h3><br>
                            <input type="text" name="user_name" placeholder="User Id" maxlength="20" required>
                            <input type="password" name="password" placeholder="Password" maxlength="20" required>

                            <div class="btn-box">
                                <button type="submit" id="next1">LogIn</button>
                            </div>
                            <div class="btn-box">
                                <a href="sign_up.php">
                                <button type="button" id="next1">Sign Up</button>
                                </a>
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

