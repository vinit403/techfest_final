<!DOCTYPE html>
<html lang="en">

<head>

  
    <meta charset="utf-8">
    <title>Contact-us</title>
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

	<!-- custom font -->
	<link rel="stylesheet" href="css/font-style.css" type="text/css">
</head>


<?php
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
     $name = $_POST['name'];
     $email = $_POST['email'];
     $subject = $_POST['subject'];
     $message = $_POST['message'];

     $name = str_replace("<","&lt;","$name");
     $name= str_replace(">", "&gt;", "$name");

     $email = str_replace("<","&lt;","$email");
     $email= str_replace(">", "&gt;", "$email");

     $subject = str_replace("<","&lt;","$subject");
     $subject= str_replace(">", "&gt;", "$subject");

     $message = str_replace("<","&lt;","$message");
     $message= str_replace(">", "&gt;", "$message");

     require "database_connection.php";

     $sql = "INSERT INTO `contact_us` (`name`, `email`, `subject`, `message`) VALUES ('$name','$email','$subject','$message')";
     $result = mysqli_query($connect, $sql);

     header("location: index.php");

 }
?>

<body id="homepage">

    <div id="wrapper">

        <!-- header begin -->
        <?php
        require "page_navbar.php";
        ?>
        <!-- header close -->


        <!-- section begin -->
        <section id="section-sponsors ftco-section" >
                <div class="wm wm-border dark wow fadeInDown " style="padding-top:50px;">Contact</div>
                <div class="container">
                <div class="row">
				<div class="col-md-6 offset-md-3 text-center wow fadeInUp">
                            <h1>Contact</h1>
                            <div class="separator"><span><i class="fa fa-square"></i></span></div>
                            <div class="spacer-single"></div>
                        </div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-10">
					<div class="wrapper">
						<div class="row no-gutters">
							<div class="col-md-6 d-flex align-items-stretch">
								<div class="contact-wrap w-100 p-md-5 p-4 py-5">
									<h3 class="mb-4">HELP CENTER</h3>
									<div id="form-message-warning" class="mb-4"></div> 
				      		<div id="form-message-success" class="mb-4">
                              We are here to help you
				      		</div>
									<form action="contact-us.php" method="POST" id="contactForm" name="contactForm" class="contactForm">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<input type="text" class="form-control" name="name" id="name" placeholder="Name" maxlength="30" required>
												</div>
											</div>
											<div class="col-md-12"> 
												<div class="form-group">
													<input type="email" class="form-control" name="email" id="email" placeholder="Email" maxlength="30" required>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" maxlength="50" required>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<textarea name="message" class="form-control" id="message" cols="30" rows="6" placeholder="Message" maxlength="500" required></textarea>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
                                                <input type="submit" value="Send Message" class="btn btn-primary" >
													<div class="submitting"></div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="col-md-6 d-flex align-items-stretch">
								<div class="info-wrap w-100 p-md-5 p-4 py-5 img" style="display: block;">
									<h3>Contact information</h3>
									<p class="mb-4">We are open to any suggestions or just to have a chat.</p>
				        	<div class="dbox w-100 d-flex align-items-start">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-map-marker" style="padding-top:5px"></span>
				        		</div>
				        		<div class="text pl-3">
					            <p><span>Address:</span><a href="https://www.google.com/maps/place/P+P+Savani+University/@21.4982445,73.0058995,17z/data=!3m1!4b1!4m5!3m4!1s0x3be03c88456d850b:0x30dc0473d5cd8b53!8m2!3d21.4982445!4d73.0080882"> NH 8, GETCO, Near Biltech,Village: Dhamdod, Kosamba,Dist.: Surat - 394125,Gujarat.</a></p>
					          </div>
				          </div>
				        	
				        	<div class="dbox w-100 d-flex align-items-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-paper-plane" style="padding-bottom:17px"></span>
				        		</div>
				        		<div class="text pl-3">
					            <p><span>Email:</span> <a href="mailto:info@yoursite.com">hello@techpulse.co.in</a></p>
					          </div>
				          </div>
				        	<!-- <div class="dbox w-100 d-flex align-items-center">
				        		<div class="icon d-flex align-items-center justify-content-center">
				        			<span class="fa fa-globe" style="padding-bottom:17px"></span>
				        		</div>
				        		<div class="text pl-3">
					            <p><span>Website</span> <a href="#">yoursite.com</a></p>
					          </div>
				          </div> -->
			          </div>
							</div>
						</div>
					</div>
				</div>
			</div>
                </div>
            </section>
            <!-- section close -->


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
    $(window).on("load", function(){
      $(".twentytwenty-container[data-orientation!='vertical']").twentytwenty({default_offset_pct: 0.7});
      $(".twentytwenty-container[data-orientation='vertical']").twentytwenty({default_offset_pct: 0.3, orientation: 'vertical'});
    });
    </script>


</body>

</html>