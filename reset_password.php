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
    <title>Reset Password</title>

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
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $code = $_POST['code'];
        $mailid = $_POST['mailid'];

        require "database_connection.php";

        $sql = "SELECT * FROM `user` WHERE mail='$mailid'";
        $result = mysqli_query($connect, $sql);

        $r = mysqli_fetch_assoc($result);

        $code2 = $r['code'];

        if($code == $code2)
        {
            echo '<body>
            <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
                <div class="wrapper wrapper--w780">
                    <div class="card card-5">
                        <div class="card-heading"></div>
                        <div class="card-body">
                        <h2 class="title"><?php echo $event ?> Reset Password </h2>
                            
                                <form action="reset_password_verification.php" method="post" id="form1">
                               
                                    <div class="input-group">
                                        <input class="input--style-3" type="password" placeholder="Enter new password" name="pass1" maxlength="20" required>
                                    </div>

                                    <div class="input-group">
                                    <input class="input--style-3" type="password" placeholder="Confirm password" name="pass2" maxlength="20" required>
                                    </div>

                                    <input type="hidden" name="mailid" value='.$mailid.'>

                                    <div class="p-t-10">
                                        <button class="btn btn--pill btn--green" type="submit" id="next1">Set password</button>
                                    </div>
                                    
                                </form>
        
                                
                        </div>
                    </div>
                </div>
            </div>
        
        
        
        
                                <!-- Jquery JS-->
                                <script src="vendor/jquery/jquery.min.js"></script>
                                <!-- Vendor JS-->
                                <script src="vendor/select2/select2.min.js"></script>
                                <script src="vendor/datepicker/moment.min.js"></script>
                                <script src="vendor/datepicker/daterangepicker.js"></script>
        
                                <!-- Main JS-->
                                <script src="js/global.js"></script>
        
        </body>';
        }
        else
        {
            echo '<body>
            <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
                <div class="wrapper wrapper--w780">
                    <div class="card card-5">
                        <div class="card-heading"></div>
                        <div class="card-body">
                        <h2 class="title"><?php echo $event ?> Reset Password </h2>
                            
                                <form id="form1">
        
                                    <div>
                                        <p style="color:red; font-size=20px">
                                            Verification code in invalid.
                                        </p>
                                    </div>
                                    
                                </form>
        
                                
                        </div>
                    </div>
                </div>
            </div>
        
        
        
        
                                <!-- Jquery JS-->
                                <script src="vendor/jquery/jquery.min.js"></script>
                                <!-- Vendor JS-->
                                <script src="vendor/select2/select2.min.js"></script>
                                <script src="vendor/datepicker/moment.min.js"></script>
                                <script src="vendor/datepicker/daterangepicker.js"></script>
        
                                <!-- Main JS-->
                                <script src="js/global.js"></script>
        
        </body>';
        }
    }
?>

</html>