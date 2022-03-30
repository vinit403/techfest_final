<style>
    input {
        background-color: #8e04d9;
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
        color: white;
        padding: 10px 20px;
        font-size: 28px;
        font-weight: bold;
    }

    #h {
        color: white;
        font-weight: bold;
        font-family: "Times New Roman", Times, serif;
    }

    body {
        background-image: url('images-event/bg/3.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }

    .container {
        background-color: #191C24;
        max-width: 600px;
        margin: auto;
        padding: 0.5px;
    }

    #form {
        background-color: #191C24;
        max-width: 600px;
        opacity: 0.9;
        padding-top: 2px;
        padding-bottom: 25px;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<?php
require "../database_connection.php";
session_start();
if (isset($_SESSION['logged_in'])) {
    if ($_SESSION['logged_in'] == 'true') {
        $user = $_SESSION['user_id'];
        $sql = "SELECT * FROM `user` WHERE user_id='$user'";
        $result = mysqli_query($connect, $sql);

        $r = mysqli_fetch_assoc($result);

        $name = $r['name'];
        $mail = $r['mail'];
        $college = $r['college'];
        $phone_number = $r['phone_number'];
        $event_count = $r['event_count'];
        $workshop_count = $r['workshop_count'];
    } else {
        header("location: login.php");
    }
} else {
    header("location: login.php");
}
?>

<body>
    <center style="vertical-align: center;">
        <div class="container my-3" style="opacity:0.9;margin-top: 10px; padding-top: 30px;padding-bottom: 30px;border-top-left-radius: 40px;border-bottom-right-radius: 40px;">
            <div class="container my-3">
                <h2 id="h" style="color:#8e04d9">
                    Your Details
                </h2>
            </div>
            <div class="container my-3">
                <h3 id="h">
                    User id : <?php echo $user ?>
                </h3>
            </div>
            <div class="container my-3">
                <h3 id="h">
                    Name : <?php echo $name ?>
                </h3>
            </div>
            <div class="container my-3">
                <h3 id="h">
                    Mail id : <?php echo $mail ?>
                </h3>
            </div>
            <div class="container my-3">
                <h3 id="h">
                    Phone Number : <?php echo $phone_number ?>
                </h3>
            </div>
            <div class="container my-3">
                <h3 id="h">
                    College/University : <?php echo $college ?>
                </h3>
            </div>
            <div class="container my-3">
                <h3 id="h">
                    Event in your wallet : <?php echo $event_count ?>
                </h3>
            </div>
            <div class="container my-3">
                <h3 id="h">
                    Workshops in your wallet : <?php echo $workshop_count ?>
                </h3>
            </div>
            <?php
            $sql = "SELECT * FROM `package_purchased` WHERE user_id = '$user'";
            $result = mysqli_query($connect, $sql);
            $sql = "SELECT * FROM `premium_package_purchased` WHERE user_id='$user'";
            $result2 = mysqli_query($connect, $sql);
            $sql = "SELECT * FROM `package_purchased_on_cash` WHERE user_id='$user'";
            $result3 = mysqli_query($connect, $sql);
            $sql = "SELECT * FROM `premium_package_purchased_on_cash` WHERE user_id='$user'";
            $result4 = mysqli_query($connect, $sql);

            $row3 = mysqli_num_rows($result3);
            $row4 = mysqli_num_rows($result4);
            $row2 = mysqli_num_rows($result2);
            $row = mysqli_num_rows($result);

            if ($row == 1 || $row2 == 1 || $row3 == 1 || $row4 == 1) {
                echo '    <div class="container my-3">
                <h3 id="h">
                      Staund up + Sunburn party Included
                  </h3>
                </div>';
            }
            ?>
            <div class="container my-3">
                <h3 id="h">
                    Events You Registered :
                </h3>
            </div>

            <?php
            $sql = "SELECT * FROM `events`";
            $result = mysqli_query($connect, $sql);
            while ($r = mysqli_fetch_assoc($result)) {
                $eve = $r['event_name'];
                $eve_register = $eve . "_register";

                $sql2 = "SELECT * FROM `$eve_register` WHERE user_id = '$user'";
                $result2 = mysqli_query($connect, $sql2);

                $rows = mysqli_num_rows($result2);

                if ($rows == 1) {
                    echo '    <div class="container my-3">
                <h3 id="h">
                      ' . $eve . '
                  </h3>
                </div>';
                }
            }
            ?>
            <div class="container my-3">
                <h3 id="h">
                    Events You Registered :
                </h3>
            </div>

            <?php
            $sql = "SELECT * FROM `workshop`";
            $result = mysqli_query($connect, $sql);
            while ($r = mysqli_fetch_assoc($result)) {
                $eve = $r['workshop_name'];
                $eve_register = $eve . "_register";

                $sql2 = "SELECT * FROM `$eve_register` WHERE user_id = '$user'";
                $result2 = mysqli_query($connect, $sql2);

                $rows = mysqli_num_rows($result2);

                if ($rows == 1) {
                    echo '    <div class="container my-3">
                <h3 id="h">
                      ' . $eve . '
                  </h3>
                </div>';
                }
            }
            ?>

    </center>

    <center>
        </div>
    </center>
    </div>
    <!-- Javascript Files
    ================================================== -->
    <script src="js/jquery.min.js"></script>
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

    <!-- RS5.0 Core JS Files -->
    <script src="revolution/js/jquery.themepunch.tools.min.js?rev=5.0"></script>
    <script src="revolution/js/jquery.themepunch.revolution.min.js?rev=5.0"></script>

    <!-- RS5.0 Extensions Files -->
    <script src="revolution/js/extensions/revolution.extension.video.min.js"></script>
    <script src="revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script src="revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <script src="revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
    <script src="revolution/js/extensions/revolution.extension.migration.min.js"></script>
    <script src="revolution/js/extensions/revolution.extension.parallax.min.js"></script>

    <script>
        jQuery(document).ready(function() {
            // revolution slider
            jQuery("#slider-revolution").revolution({
                sliderType: "standard",
                sliderLayout: "fullwidth",
                delay: 5000,
                navigation: {
                    arrows: {
                        enable: true
                    },
                    bullets: {
                        enable: false,
                        style: 'hermes'
                    },

                },
                parallax: {
                    type: "mouse",
                    origo: "slidercenter",
                    speed: 2000,
                    levels: [2, 3, 4, 5, 6, 7, 12, 16, 10, 50],
                },
                spinner: "off",
                gridwidth: 1140,
                gridheight: 700,
                disableProgressBar: "on"
            });
        });
    </script>

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