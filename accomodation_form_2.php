<!DOCTYPE html>
<html lang="en">

<head>

  
    <meta charset="utf-8">
    <title>Accomodation Form</title>
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

    <!-- color scheme -->
    <link rel="stylesheet" href="css/colors/magenta.css" type="text/css" id="colors">
    <link rel="stylesheet" href="css/color.css" type="text/css">

    <!-- load fonts -->
    <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="fonts/elegant_font/HTML_CSS/style.css" type="text/css">
    <link rel="stylesheet" href="fonts/et-line-font/style.css" type="text/css">

    <!-- RS5.0 Stylesheet -->
    <link rel="stylesheet" href="revolution/css/settings.css" type="text/css">
    <link rel="stylesheet" href="revolution/css/layers.css" type="text/css">
    <link rel="stylesheet" href="revolution/css/navigation.css" type="text/css">
    <link rel="stylesheet" href="css/rev-settings.css" type="text/css">
    
    <style>
    body {
    background-image: url('images-event/bg/main-lobby.jpeg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
}
#div1 {
    opacity: 0.9;
}
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
}

.registration-form {
    padding: 50px 0;
}

.registration-form form {
    background-color: #191C24;
    max-width: 600px;
    margin: auto;
    padding: 50px 70px;
    border-top-left-radius: 30px;
    border-top-right-radius: 30px;
    border-bottom-left-radius: 30px;
    border-bottom-right-radius: 30px;
    box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.075);
}

#image {
    font-size: 40px;
    color: white;
    height: 110px;
    width: 110px;
}

.registration-form .item {
    border-radius: 20px;
    margin-bottom: 25px;
    padding: 10px 20px;
}

select{
    border-radius: 20px;
    margin-bottom: 25px;
    padding: 10px 20px;
}

.registration-form .register {
    border-radius: 30px;
    padding: 10px 20px;
    font-size: 18px;
    font-weight: bold;
    background-color: #8e04d9;
    border: none;
    color: white;
    margin-top: 20px;
}

#p1 {
    text-align: center;
    font-size: small;
    font-style: italic;
}

#p2 {
    text-align: left;
    font-size: medium;
}

p {
    text-align: center;
    font-size: large;
}

.form-group {
    color: #495057;
}

strong {
    color: #8e04d9;
}

@media (max-width: 456px) {
    .registration-form form {
        padding: 50px 20px;
    }
    .registration-form .form-icon {
        width: 70px;
        height: 70px;
        font-size: 30px;
        line-height: 70px;
    }
}
</style>
<body>

    <div id="wrapper">

        <!-- header begin -->
                <?php
        require "page_navbar.php";
        ?>
        <!-- header close -->

        <div class="registration-form" id="div1" style="margin-top:50px">
            <form action="pay_pages/pay_for_accomodation.php" method="post">
                <div class="form-group">
                    <center>
                    <img src="img/ppsu_logo.png" alt="something wrong" id="image">
                    </center>
                </div>
                <div class="form-group">
                <p>
                        <h3>
                        <strong>
                            <center style="color:red">
                                Accomodation
                            </center>
                        </strong>
                        </h3>
                        </p>
                        <div class="dropdown">
                </div>
                <div>
                    <p id="p2">
                        <strong style="color:red">
                            Person 1
                        </strong>
                    </p>
                </div>
                <div class="form-group">
                    <input type="text" name="name" class="form-control item" id="Full name" placeholder="Full name" maxlength="50" required>
                </div>
                <div class="form-group">
                    <input type="email" name="mail" class="form-control item" id="email" placeholder="Email" maxlength="50" required>
                </div>
                <div class="form-group">
                    <input type="number" name="phone_number" class="form-control item" id="phone-number" placeholder="Phone Number" min="1000000000" max="9999999999" required>
                </div>

                <div>
                    <p id="p2">
                        <strong style="color:red">
                            Person 2
                        </strong>
                    </p>
                </div>
                <div class="form-group">
                    <input type="text" name="name_member2" class="form-control item" id="Full name" placeholder="Full name" maxlength="50" required>
                </div>
                <div class="form-group">
                    <input type="email" name="mail_member2" class="form-control item" id="email" placeholder="Email" maxlength="50" required>
                </div>
                <div class="form-group">
                    <input type="number" name="phone_number2" class="form-control item" id="phone-number" placeholder="Phone Number" min="1000000000" max="9999999999" required>
                </div>
                
                <div class="form-group">
                    <h4 style="color:red">
                    <strong style="color:red">
                    Accomodation time
                    </strong>
                    </h4>
                </div>
                <center>
                <select id="selection" onchange="func()">
                <option value="2000">One day</option>
                <option value="4000">Two days</option>
                </select>
                </center>
                <input type="hidden" name="amount" id ="valu" value="2000" readonly="readonly" />
                <script>
        function func() {
    var option = document.getElementById("selection").value;
    if (option =='2000')
    {
    $('#valu').val(2000);
    }
        if (option =='4000')
    {
    $('#valu').val(4000);
    }
};

    </script>
                <!-- <div class="form-group">
                    <input type="hidden" name="amount" value="1300">
                </div> -->
                <div class="form-group">
                    <input type="hidden" name="count" value="2">
                </div>
                <div class="form-group">
                    <p id="p1" style="color:white">
                    *Note: Information about the accommodation will be provided either in your email or message. 
                    <br>
                    Kindly enter the correct information.
                    <br>
                                    
                    </p>
                </div>
                <div class="form-group">
                <input type="checkbox" id="checkbox" name="checkbox" value=" " required>
                <label for="checkbox" style="color:white"> I have read and I agree to the terms and conditions.</label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block register" id="submit" style="background-color:red">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
            <!-- section close -->


            <!-- footer begin -->
            <footer class="style-2">
            <div class="container">
                <div class="row align-items-middle">
                    <div class="col-md-3">
                    <a href="index.php"><img class="logo" src="images-event/techpulse-logo.png" alt="" style="height: 50px;width: 190px;"><br></a>
                    </div>

                    <div class="col-md-6" style="text-align: center;">
                        © <span class="id-color"> Tech-Pulse 2022-23 </span>All rights reserved.<br><a href="https://www.google.com/maps/place/P+P+Savani+University/@21.4982445,73.0058995,17z/data=!3m1!4b1!4m5!3m4!1s0x3be03c88456d850b:0x30dc0473d5cd8b53!8m2!3d21.4982445!4d73.0080882">NH 8, GETCO, Near Biltech,Village: Dhamdod, Kosamba,Dist.: Surat - 394125,Gujarat.</a>
                    </div>
                </div>
            </div>


            <a href="#" id="back-to-top" class="custom-1"></a>
        </footer>
        <!-- footer close -->
       
   

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
    $(window).on("load", function(){
      $(".twentytwenty-container[data-orientation!='vertical']").twentytwenty({default_offset_pct: 0.7});
      $(".twentytwenty-container[data-orientation='vertical']").twentytwenty({default_offset_pct: 0.3, orientation: 'vertical'});
    });
    </script>


</body>

</html>
