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
    color: black;
    font-weight: bold;
    font-family: "Poppins", serif;
  }

  body {
    background-image: url('images/ty.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
  }

  .container {
    max-width: 600px;
    height: 450px;
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

  .box {
    margin-top: 60px;
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
  }

  .alert {
    margin-top: -20px;
    background-color: #fff;
    font-size: 25px;
    font-family: sans-serif;
    text-align: center;
    width: 300px;
    height: 240px;
    padding-top: 150px;
    position: relative;
    border: 1px solid #efefda;

  }

  .alert::before {
    width: 100px;
    height: 100px;
    position: absolute;
    border-radius: 100%;
    inset: 20px 0px 0px 100px;
    font-size: 60px;
    line-height: 100px;
    border: 5px solid gray;
    animation-name: reveal;
    animation-duration: 1.5s;
    animation-timing-function: ease-in-out;
  }

  .alert>.alert-body {
    opacity: 0;
    animation-name: reveal-message;
    animation-duration: 1s;
    animation-timing-function: ease-out;
    animation-delay: 1.5s;
    animation-fill-mode: forwards;
  }

  @keyframes reveal-message {
    from {
      opacity: 0;
    }

    to {
      opacity: 1;
    }
  }

  .success {
    color: green;
  }

  .success::before {
    content: '✓';
    /* background-color: #eff; */
    box-shadow: 0px 0px 12px 7px rgba(200, 255, 150, 0.8) inset;
    border: 5px solid green;
  }



  @keyframes reveal {
    0% {
      border: 5px solid transparent;
      color: transparent;
      box-shadow: 0px 0px 12px 7px rgba(255, 250, 250, 0.8) inset;
      transform: rotate(1000deg);
    }

    25% {
      border-top: 5px solid gray;
      color: transparent;
      box-shadow: 0px 0px 17px 10px rgba(255, 250, 250, 0.8) inset;
    }

    50% {
      border-right: 5px solid gray;
      border-left: 5px solid gray;
      color: transparent;
      box-shadow: 0px 0px 17px 10px rgba(200, 200, 200, 0.8) inset;
    }

    75% {
      border-bottom: 5px solid gray;
      color: gray;
      box-shadow: 0px 0px 12px 7px rgba(200, 200, 200, 0.8) inset;
    }

    100% {
      border: 5px solid gray;
      box-shadow: 0px 0px 12px 7px rgba(200, 200, 200, 0.8) inset;
    }
  }
</style>
<?php
header("refresh:3,url=dashboard.php");
session_start();
if (isset($_SESSION['logged_in'])) {
  if ($_SESSION['logged_in'] == 'true') {
    $user_name = $_SESSION['user_id'];

    $name = $_SESSION['name'];
  }
}
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
    <div class="container my-3" style="margin-top: 130px; padding-top: 30px;padding-bottom: 40px;border-radius: 40px;background-image: linear-gradient(347deg, #FFAFBD, #ffc3a0);">
      <div class="container my-3">
        <div class="box">
          <div class="success alert" style="background-color: transparent;border: none;">
            <div class="alert-body">
              <h5 id="h">
                <?php echo $name; ?>, Thanks for participanting.
              </h5>

              <h6 id="h">
                Welcome aboard.
              </h6>
            </div>
          </div>

        </div>
      </div>

  </center>


  </div>

  </div>


</body>

</html>