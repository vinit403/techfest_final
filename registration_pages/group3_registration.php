<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    <link rel="stylesheet" type="text/css" href="../style.css">


    <!-- Title Page-->
    <title>Registration</title>

    <!-- Icons font CSS-->
    <link href="../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="../vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../css2/main.css" rel="stylesheet" media="all">
</head>

<?php
session_start();
if(isset($_SESSION['logged_in']))
{
    if($_SESSION['logged_in'] == 'true')
    {
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            $f=0;
            foreach ($_GET as $key => $value) {
                if($key == 'event')
                {
                    $f = 1;
                }
            }
            if($f == 0)
            {
                exit;
            }
            require "../database_connection.php";
            $sql = "SELECT * FROM `events`";
            $result = mysqli_query($connect, $sql);
            $flag = 0;
            while($r = mysqli_fetch_assoc($result))
            {
                $event_name = $r['event_name'];
                $event = $_GET['event'];
                if($event == $event_name)
                {
                    $flag = 1;
                }
            }
            if($flag == 0)
            {
                exit;
            }
        }
    }
    else
    {
        header("location: ../login.php");
    }
}
else
{
    header("location: ../login.php");
}

?>

<body>
    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-5">
                <div class="card-heading"></div>
                <div class="card-body">
                <h2 class="title"><?php echo $event ?> Registration</h2>
                <p style="color:#555;font-size: 12px; line-height:15px;">Maximum 3 students. If you are solo then Click on Register. </p>

                        <form action="group3_registration_validation.php" method="post" id="form1">
                        <div class="input-group">
                                <input class="input--style-3" type="text" placeholder="Second User Id" name="uid_member2" maxlength="20">
                            </div>
                            <div class="input-group">
                                <input class="input--style-3" type="text" placeholder="Third User Id" name="uid_member3" maxlength="20">
                            </div>
                            
                            <div class="p-t-10">
                                <button class="btn btn--pill btn--green" type="submit" id="next1">Register</button>
                            </div>

                            <input type="hidden" name="event" value="<?php echo $event ?>">

                        </form>

                
                </div>
            </div>
        </div>
    </div> -->




                        <!-- Jquery JS-->
                        <script src="../vendor/jquery/jquery.min.js"></script>
                        <!-- Vendor JS-->
                        <script src="../vendor/select2/select2.min.js"></script>
                        <script src="../vendor/datepicker/moment.min.js"></script>
                        <script src="../vendor/datepicker/daterangepicker.js"></script>

                        <!-- Main JS-->
                        <script src="../js/global.js"></script>

</body>

</html>
