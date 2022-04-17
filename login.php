<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">


    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<![endif]-->


    <!-- CSS Files
    ================================================== -->
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="css/jpreloader.css" type="text/css">
    <link rel="stylesheet" href="css/animate.css" type="text/css">
    <link rel="stylesheet" href="css/plugin.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="css/owl.theme.css" type="text/css">
    <link rel="stylesheet" href="css/owl.transitions.css" type="text/css">
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="css/jquery.countdown.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/twentytwenty.css" type="text/css">

    <!-- custom background -->
    <link rel="stylesheet" href="css/bg.css" type="text/css">
    <link rel="stylesheet" href="css2/main.css" type="text/css">

    <!-- color scheme -->
    <link rel="stylesheet" href="css/colors/magenta.css" type="text/css" id="colors">
    <link rel="stylesheet" href="css/color.css" type="text/css">

    <!-- load fonts -->
    <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="fonts/elegant_font/HTML_CSS/style.css" type="text/css">
    <link rel="stylesheet" href="fonts/et-line-font/style.css" type="text/css">

    <!-- custom font -->
    <link rel="stylesheet" href="css/font-style.css" type="text/css">
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>
<?php
$err = "";
session_start();
session_unset();
session_destroy();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['user_name'];
    $passcode = $_POST['password'];

    $user_name = str_replace("<", "&lt;", "$user_name");
    $user_name = str_replace(">", "&gt;", "$user_name");
    $passcode = str_replace("<", "&lt;", "$passcode");
    $passcode = str_replace(">", "&gt;", "$passcode");

    $user_name = str_replace("=", "&eq;", "$user_name");
    $user_name = str_replace("\'", " ", "$user_name");
    $user_name = str_replace("\"", " ", "$user_name");

    $passcode = str_replace("=", "&eq;", "$passcode");
    $passcode = str_replace("\'", " ", "$passcode");
    $passcode = str_replace("\"", " ", "$passcode");

    include "database_connection.php";
    $sql = "SELECT * FROM `user` WHERE user_id = '$user_name'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_num_rows($result);
    if ($row != 0) {
        while ($r = mysqli_fetch_assoc($result)) {
            $pass = $r['password'];
            
            if (password_verify($passcode, $pass)) {

                session_start();
                $_SESSION['logged_in'] = "true";
                $_SESSION['user_id'] = $user_name;
                $_SESSION['name'] = $r['name'];
                $_SESSION['phone_number'] = $r['phone_number'];
                $_SESSION['mail'] = $r['mail'];
                $_SESSION['college'] = $r['college'];

                header("location: index.php");
            } else {
                $err = "password is incorrect";
            }
        }
    } else {
        $err =  "user not exist";
    }
}
?>


<body id="homepage">

    <div id="wrapper">

        <!-- header begin -->
        <?php
        require "page_navbar.php";
        ?>
        <!-- header close -->


        <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins" data-bgimage="url(images-event/bg/3.jpg)">
            <div class="wrapper wrapper--w780">
                <div class="card card-3">
                    <div class="card-heading"></div>
                    <div class="card-body">
                        <h2 class="title">Log In</h2>

                        <p style="color:red; font-size:15px; position:relative; top: 30px;">
                            <?php echo $err ?>
                        </p>

                        <form method="POST">

                            <div class="data">
                                <div class="input-group">
                                    <input class="input--style-3" type="text" placeholder="User Id" name="user_name">

                                </div>
                                <div class="input-group">
                                    <input class="input--style-3" type="password" placeholder="Password" name="password">
                                </div>

                            </div>

                            <div class="p-t-10">
                                <button class="btn btn--pill btn--green" type="submit">Login</button>
                            </div>

                            <div class="p-t-10">
                                <a href="forgot_password.php" class="btn btn--pill" style="color:#555; position:relative; left:-30px;">Forgot password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- footer begin -->
    <?php
    require "page_footer.php";
    ?>
    <!-- footer close -->
    </div>
    </div>

    <!-- Javascript Files
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jpreLoader.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/easing.js"></script>
    <script src="js/jquery.flexslider-min.js"></script>
    <script src="js/jquery.scrollto.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/jquery.countTo.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/video.resize.js"></script>
    <script src="js/validation.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/enquire.min.js"></script>
    <script src="js/designesia.js"></script>
    <script src="js/jquery.event.move.js"></script>
    <script src="js/jquery.plugin.js"></script>
    <script src="js/jquery.countdown.js"></script>
    <script src="js/countdown-custom.js"></script>
    <script src="js/jquery.twentytwenty.js"></script>

    <script>
        $(window).on("load", function() {
            $(".twentytwenty-container[data-orientation!='vertical']").twentytwenty({
                default_offset_pct: 0.7
            });
            $(".twentytwenty-container[data-orientation='vertical']").twentytwenty({
                default_offset_pct: 0.3,
                orientation: 'vertical'
            });
        });
    </script>


</body>

</html>