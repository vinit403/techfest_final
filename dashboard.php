<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="utf-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
<!-- comment -->

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
    <link rel="stylesheet" href="css2/dash.css" type="text/css">

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
require "database_connection.php";
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

$txt = "None";
$pkg = "None";
$event = [];

$workshops = [];

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
    $txt = "Stand up + DJ night party Included";
}

if($row == 1 || $row3 == 1)
{
    $pkg = "standerd package";
}
if($row2 == 1 || $row4 == 1)
{
    $pkg = "premium package";
}

// Fetching events

$sql = "SELECT * FROM `events`";
$result = mysqli_query($connect, $sql);
while ($r = mysqli_fetch_assoc($result)) {
    $eve = $r['event_name'];
    $eve_register = $eve . "_register";

    $sql2 = "SELECT * FROM `$eve_register` WHERE user_id = '$user'";
    $result2 = mysqli_query($connect, $sql2);

    $rows = mysqli_num_rows($result2);

    if ($rows == 1) {
        array_push($event, $eve);
    }
}

$total = count($event);


// Fetching Workshop
$sql = "SELECT * FROM `workshop`";
$result = mysqli_query($connect, $sql);
while ($r = mysqli_fetch_assoc($result)) {
    $eve2 = $r['workshop_name'];
    $eve_register = $eve2 . "_register";

    $sql2 = "SELECT * FROM `$eve_register` WHERE user_id = '$user'";
    $result2 = mysqli_query($connect, $sql2);

    $rows = mysqli_num_rows($result2);

    if ($rows == 1) {
        array_push($workshops, $eve2);
        
    }



}
$total2 = count($workshops);
?>


<body id="homepage">

    <div id="wrapper">

        <!-- header begin -->
        <?php
        require "page_navbar.php";
        ?>
        <!-- header close -->
        <div class="dash">
            <div class="padding" data-bgimage="url(images-event/bg/3.jpg)">
                <div class="col-xl-6 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white" style="margin-top: 25vh;background-size: cover;">
                                    <p class="f-u"><?php echo $user ?></p>
                                    <p><?php echo $name ?></p>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <p class="m-b-20 p-b-5 b-b-default f-w-600">Information</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <p class="text-muted f-w-400"><?php echo $mail ?></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Phone</p>
                                            <p class="text-muted f-w-400"><?php echo $phone_number ?></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">College</p>
                                            <p class="text-muted f-w-400"><?php echo $college ?></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Package</p>
                                            <p class="text-muted f-w-400"><?php echo $pkg ?></p>
                                        </div>
                                    </div>
                                    <p class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Wallet</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Number of Event</p>
                                            <p class="text-muted f-w-400"><?php echo $event_count ?></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Number of Workshops</p>
                                            <p class="text-muted f-w-400"><?php echo $workshop_count ?></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Event name</p>
                                            <p class="text-muted f-w-400">
                                                <?php 
                                                    for($i=0; $i<$total;$i++){
                                                    echo $event[$i];
                                                    echo "<br>"; 
                                                }
                                                ?>
                                            </p>
                                        </div>

                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Workshop name</p>
                                            <p class="text-muted f-w-400">
                                                <?php 
                                                    for($i=0; $i<$total2;$i++){
                                                    echo $workshops[$i];
                                                    echo "<br>"; 
                                                }
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                    <p class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Entertainment</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- <p class="m-b-10 f-w-600">Evening Events</p> -->
                                            <p class="text-muted f-w-400"><?php echo $txt ?></p>
                                        </div>
                                        
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
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