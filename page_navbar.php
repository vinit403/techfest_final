<?php
$flag=0;
session_start();
if(isset($_SESSION['logged_in']))
{
    if($_SESSION['logged_in'] == 'true')
    {
        $user_id = $_SESSION['user_id'];

        echo '      <header class="transparent">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- logo begin -->
                        <nav>
                        <ul id="mainmenu" class="ms-2">
                                <li><a href="index.php">Home<span></span></a></li>
</ul>

                        </nav>
                    <!-- logo close -->

                    <!-- small button begin -->
                    <span id="menu-btn"></span>
                    <!-- small button close -->

                    <!-- mainmenu begin -->
                        <nav>
                            <ul id="mainmenu" class="ms-2">
                                <li><a href="index.php">Home<span></span></a></li>
                                <li><a href="about_us.php">About<span></span></a></li>
                                <li><a href="Event.php">Events<span></span></a></li>
                                <li><a href="package.php">Packages<span></span></a></li>
                                // <li><a href="howto.php">How to?<span></span></a></li>
                                <li><a href="contact-us.php">Contact us<span></span></a></li>
                                <li><a href="accomodation.php">Accomodation<span></span></a></li>
                                <li><a href="dashboard.php" style="color:#ec167f";>'.$user_id.'<span></span></a></li>
                                <li><a href="logout_user.php" style="color:#ec167f">logout<span></span></a></li>
</ul>
                        </nav>
                        
                        <!-- mainmenu close -->

                </div>
                

            </div>
        </div>
        </header>';
    }
    else{
        $flag=1;
    }
}
else
{
    $flag=1;
}

if($flag == 1)
{
    echo '      <header class="transparent">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- logo begin -->
            
            <!-- logo close -->

            <!-- small button begin -->
            <span id="menu-btn"></span>
            <!-- small button close -->

            <!-- mainmenu begin -->
                <nav style="padding-top:-20px">
                    <ul id="mainmenu" class="ms-2">
                        <li><a href="index.php">Home<span></span></a></li>
                        <li><a href="about_us.php">About<span></span></a></li>
                        <li><a href="Event.php">Events<span></span></a></li>
                        <li><a href="package.php">Packages<span></span></a></li>
                        // <li><a href="howto.php">How to?<span></span></a></li>
                        <li><a href="contact-us.php">Contact us<span></span></a></li>
                        <li><a href="accomodation.php">Accomodation<span></span></a></li>
                        <li><a href="login.php" style="color:#ec167f">LogIn<span></span></a></li>
                        <li><a href="sign_up.php" style="color:#ec167f">SignUp<span></span></a></li>
                    </ul>
                </nav>
                
                <!-- mainmenu close -->

        </div>
        

    </div>
</div>
</header>';
}
