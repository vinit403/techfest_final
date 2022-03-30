<style>
    input{
        background-color:#8e04d9;
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
        color:white;
        padding: 10px 20px;
        font-size: 28px;
        font-weight: bold;
    }
    #h{
        color:white;
        font-weight:bold;
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
            height: 450px;
            margin: auto;       
            padding : 0.5px;
        }
        #form{
            background-color: #191C24;
            max-width: 600px;
            opacity : 0.9;
            padding-top : 2px;
            padding-bottom : 25px;
        }

        .box{
  margin-top:60px;
  display:flex;
  justify-content:space-around;
  flex-wrap:wrap;
}

.alert{
  margin-top:-20px;
  background-color:#fff;
  font-size:25px;
  font-family:sans-serif;
  text-align:center;
  width:300px;
  height:240px;
  padding-top: 150px;
  position:relative;
  border: 1px solid #efefda;
  border-radius: 2%;
  box-shadow:0px 0px 3px 1px #ccc;
}

.alert::before{
  width:100px;
  height:100px;
  position:absolute;
  border-radius: 100%;
  inset: 20px 0px 0px 100px;
  font-size: 60px;
  line-height: 100px;
  border : 5px solid gray;
  animation-name: reveal;
  animation-duration: 1.5s;
  animation-timing-function: ease-in-out;
}

.alert>.alert-body{
  opacity:0;
  animation-name: reveal-message;
  animation-duration:1s;
  animation-timing-function: ease-out;
  animation-delay:1.5s;
  animation-fill-mode:forwards;
}

@keyframes reveal-message{
  from{
    opacity:0;
  }
  to{
    opacity:1;
  }
}

.success{
  color:green;
}

.success::before{
  content: '✓';
  /* background-color: #eff; */
  box-shadow: 0px 0px 12px 7px rgba(200,255,150,0.8) inset;
  border : 5px solid green;
}



@keyframes reveal {
  0%{
    border: 5px solid transparent;
    color: transparent;
    box-shadow: 0px 0px 12px 7px rgba(255,250,250,0.8) inset;
    transform: rotate(1000deg);
  }
  25% {
    border-top:5px solid gray;
    color: transparent;
    box-shadow: 0px 0px 17px 10px rgba(255,250,250,0.8) inset;
    }
  50%{
    border-right: 5px solid gray;
    border-left : 5px solid gray;
    color:transparent;
    box-shadow: 0px 0px 17px 10px rgba(200,200,200,0.8) inset;
  }
  75% {
    border-bottom: 5px solid gray;
    color:gray;
    box-shadow: 0px 0px 12px 7px rgba(200,200,200,0.8) inset;
    }
  100%{
    border: 5px solid gray;
    box-shadow: 0px 0px 12px 7px rgba(200,200,200,0.8) inset;
  }
}



</style>
<?php
  header("refresh:3,url=dashboard.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.6.0/css/font-awesome.min.css">
    <title>Purchase Successfully</title>
</head>
<body>
    <center style="vertical-align: center;">
<div class="container my-3" style="opacity:0.9;margin-top: 130px; padding-top: 30px;padding-bottom: 40px;border-top-left-radius: 40px;border-bottom-right-radius: 40px;">
    <div class="container my-3">
        <div class="box"> 
            <div class="success alert" style="background-color: transparent;border: none;">
              <div class="alert-body">
                    <h1 id="h">
                        Registered Successfully 
                    </h1>
          
                  <h4 id="h">
                        . . . Thank You . . . 
                  </h4>
              </div>
            </div>
              <!-- <div class="error alert">
                <div class="alert-body">
                  Error !
                </div>
            </div> -->
          </div>
        </div>
   
    </center>


</div>

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
    $(window).on("load", function(){
      $(".twentytwenty-container[data-orientation!='vertical']").twentytwenty({default_offset_pct: 0.7});
      $(".twentytwenty-container[data-orientation='vertical']").twentytwenty({default_offset_pct: 0.3, orientation: 'vertical'});
    });
    </script>

</body>
</html>
