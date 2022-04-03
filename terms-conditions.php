<!DOCTYPE html>
<html lang="en">

<head>

  
    <meta charset="utf-8">
    <title>About Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">


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
	
	<!-- custom font -->
	<link rel="stylesheet" href="css/font-style.css" type="text/css">
</head>
<style> 
@media only screen and (max-width : 768px) {
    #info{
        top: -10px;
    }
}

</style>

<body id="homepage">

    <div id="wrapper">

        <!-- header begin -->
      <?php
        require "page_navbar.php";
      ?>
        <!-- header close -->

        <section id="section-about" data-bg="fixed no-repeat">
        <center>
            <h4>
            Terms & Conditions 
            </h4><br>
            <p style="color:white">
            1. Payment once done is done, it won't be refunded under any circumstances. <br>

2. Participant's details will be emailed to them before the event begins. <br>

3. Participant needs to check their spam folder if they don't get the email within an hour of registration. <br>

4. Participant's entry won't be transferred to anyone else. <br>

5. Entries won't be canceled under any circumstances. <br>

6. If found that there are more than one person to scan the same QR code for entry into the campus, the participant will be disqualified from all the events automatically. <br>

7. All the details filled while filling the form will be considered final for all the official documents in TechPulse. <br>

8. TechPulse team deserves the right to decline entry if discrepancy is found. <br>

9. Participant needs to show their QR code whenever required and whenever asked by TechPulse team. <br>

10. TechPulse team reserves the rights to change any rules without prior notice.  <br>

11. By submitting this registration form, you are liable to make payment in full prior to the event. <br>

12. TechPulse team is not liable for any of your belongings if they are lost during the event. <br>

13. Smoking is strictly prohibited inside the campus. <br>

14. All the items which are banned by The Gujarat State Government aren't allowed inside the campus. <br>

15. In the event that the candidate is found in the violation of point 13 or 14, TechPulse team deserves the right to take appropriate action. <br>

All Rights Reserved To TechPulse Team. <br>
</p>
        </center>

</section>
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