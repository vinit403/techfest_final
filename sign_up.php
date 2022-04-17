<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <title>Signup</title>
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
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$err = "";
$user_name = $name = $college_name = $mail = $password = $cpassword = $fpassword  = "";
$fnamef = $lnamef = $useridf = $emailf = $cnof = $passwordf = 0;
$phone_number = null;
$education = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["user_name"])) {
        $err = "User id is required";
    } else {
        $user_name = test_input($_POST["user_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z0-9 ]*$/", $user_name)) {
            $err = "Only Character and white space allowed in user id";
        } else {
            $fnamef = 1;
        }
    }
    if (empty($_POST["name"])) {
        $err = "Full Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z- ]*$/", $name)) {
            $err = "Only Character and white space allowed in full name";
        } else {
            $lnamef = 1;
        }
    }

    if (empty($_POST["college_name"])) {
        $err = "College name is required";
    } else {
        $college_name = test_input($_POST["college_name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $college_name)) {
            $err = "Only Character,Number,# and @ allowed in college name";
        } else {
            $useridf = 1;
        }
    }

    if (empty($_POST["mail"])) {
        $err = "Email is required";
    } else {
        $mail = test_input($_POST["mail"]);
        // check if e-mail address is well-formed
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $err = "Invalid email format";
        } else {
            $emailf = 1;
        }
    }

    if (empty($_POST["phone_number"])) {
        $err = "Contact Number is required";
    } else {
        $phone_number = test_input($_POST["phone_number"]);
        // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
        if (!preg_match("/^[0-9]{10}+$/", $phone_number)) {
            $err = "Invalid Contact Number";
        } else {
            $cnof = 1;
        }
    }


    if (!empty($_POST["password"]) && ($_POST["password"] == $_POST["password2"])) {
        $passcode = test_input($_POST["password"]);
        $passcode2 = test_input($_POST["password2"]);
        if (strlen($_POST["password"]) < '8') {
            $err = "Your Password Must Contain At Least 8 Characters!";
        } elseif (!preg_match("#[0-9]+#", $passcode)) {
            $err = "Your Password Must Contain At Least 1 Number!";
        } elseif (!preg_match("#[A-Z]+#", $passcode)) {
            $err = "Your Password Must Contain At Least 1 Capital Letter!";
        } elseif (!preg_match("#[a-z]+#", $passcode)) {
            $err = "Your Password Must Contain At Least 1 Lowercase Letter!";
        } else {
            $fpassword = test_input($_POST["password"]);
            $passwordf = 1;
        }
    } elseif (!empty($_POST["password"])) {
        $err = "Please Check You've Entered Or Confirmed Your Password!";
    } else {
        $err = "Please enter password   ";
    }

    $flag = 0;

    include "database_connection.php";
    $sql = "SELECT * FROM `user`";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_num_rows($result);
    if ($row != 0) {
        while ($r = mysqli_fetch_assoc($result)) {
            $username = $r['user_id'];
            if ($username == $user_name) {
                $err = "This Username Is Already Exist"; 

                $flag = 1;
            }
        }
    }

    $sql = "SELECT * FROM `user`";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_num_rows($result);
    if ($row != 0) {
        while ($r = mysqli_fetch_assoc($result)) {
            $temp_mail = $r['mail'];
            if ($temp_mail == $mail) {
                $err = "This Mail Id Is Already Used";

                $flag = 1;
            }
        }
    }

    $passcode = password_hash($passcode, PASSWORD_DEFAULT);

    if ($flag == 0 && $fnamef == 1 && $lnamef == 1 && $useridf == 1 && $emailf == 1 && $cnof == 1 && $passwordf == 1) {
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
<style>
    input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button{
    -webkit-appearance: none;
}
</style>
<body id="homepage">
 
    <div id="wrapper">

        <!-- header begin -->
        <?php
        require "page_navbar.php";
        ?>
        <!-- header close -->
        
            <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins" data-bgimage="url(images-event/bg/3.jpg)">
            
        <div>
                <div class="wrapper wrapper--w780">
                    <div class="card card-2">
                        <div class="card-heading"></div>
                        <div class="card-body">
                            <h2 class="title">Create Account
                                <p style="color:red; font-size:15px">
                                    <?php echo $err ?>
                                </p>
                                <br>
                            </h2>
                            <div>
            <p style="color:#555;font-size: 12px; line-height:15px;">Please provide information that is both authentic and reliable. The information you provide will be used for certification. Under any circumstances, it will not be altered! 
             
        </p>
        </div>
                            <form method="POST">
                                <div class="data">
                                    <div class="input-group">
                                        <input class="input--style-3" type="text" placeholder="User Id" name="user_name" maxlength="20" required>
                                    </div>
                        
                                    <div class="input-group">
                                        <input class="input--style-3" type="text" placeholder="Full Name" name="name" maxlength="50" required>
                                    </div>
                                    <div class="input-group">
                                        <input class="input--style-3" type="text" placeholder="College Name" name="college_name" maxlength="100" required>
                                    </div>
                                    <div class="input-group">
                                        <input class="input--style-3" type="email" placeholder="Email Address" name="mail" maxlength="50" required>
                                    </div>
                                    <div class="input-group">
                                        <input class="input--style-3" type="tel" placeholder="Mobile Number" name="phone_number" required>
                                    </div>
                                    <div class="input-group">
                                        <input class="input--style-3" type="password" placeholder="Enter Password *" name="password" maxlength="20" required>
                                    </div>
                                    <div class="input-group">
                                        <input class="input--style-3" type="password" placeholder="Confirm Password" name="password2" maxlength="20" required>
                                    </div>
                                    <p style="color:#555;font-size: 12px; line-height:15px;">* Password contains three character categories: digits, Uppercase characters and minimum 8-characters.</p>
                                    <p style="color:#555;font-size: 12px; line-height:15px;">* By submitting this form you accepting our <a href = "terms-conditions.php" style="font-weight: 100;" >terms & conditions.</a></p>

                                </div>
                                <div class="p-t-10" style="margin-bottom:20px">
                                    <button class="btn btn--pill btn--green" type="submit" style="position: relative; bottom: 20px;">Signup</button>
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