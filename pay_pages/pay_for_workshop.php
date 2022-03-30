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
    button
    {
        background-color:#8e04d9;
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
        color:white;
        padding: 10px 20px;
        font-size: 18px;
        font-weight: bold;
    }
    #h{
        color:white;
        font-weight:bold;
        font-family: "Times New Roman", Times, serif; 
    }
    body {
            background-image: url('../images-event/bg/3.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        .container {
            background-color: #191C24;
            max-width: 600px;
            margin: auto;
            padding : 0.5px;
        }
        #form{
            background-color: #191C24;
            max-width: 600px;
            opacity : 0.9;
            padding-top : 2px;
            padding-bottom : 25px;
            margin-bottom : 0px;

        }

</style>
<?php
require('../config.php');
require('../razorpay/razorpay-php/Razorpay.php');

session_start();

if(isset($_SESSION['logged_in']))
{
    if($_SESSION['logged_in'] == 'true')
    {
        $user_name = $_SESSION['user_id'];
        
            $name = $_SESSION['name'];
            $phone_number = $_SESSION['phone_number'];
            $mail = $_SESSION['mail'];
            $event = "Purchase workshop";
            $amount = 599;
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


// Create the Razorpay Order


use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//

$orderData = [
    'receipt'         => 3456,
    'amount'          => $amount * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "P P Savani University",
    "description"       => "Payment for event registration",
    "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
    "prefill"           => [
    "name"              => $name,
    "email"             => $mail,
    "contact"           => $phone_number,
    ],
    "notes"             => [
    "plan"           => $event,
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment</title>
</head>
<body>
    <center>
<div class="container my-3" style="opacity:0.9">
    <div class="container my-3">
        <h2 id="h" style="color:#8e04d9">
            Your Details
        </h2>
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
          Amount : <?php echo $amount/100 ?>
      </h3>
    </div>
    <div class="container my-3">
    <h3 id="h">
          Payment for : <?php echo $event ?>
      </h3>
    </div>
    </center>

<center>
<form action="../verify_pages/verify_for_workshop.php" method="POST" class="mx-3" id="form">
  <script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $data['key']?>"
    data-amount="<?php echo $data['amount']?>"
    data-currency="INR"
    data-name="<?php echo $data['name']?>"
    data-image="<?php echo $data['image']?>"
    data-description="<?php echo $data['description']?>"
    data-prefill.name="<?php echo $data['prefill']['name']?>"
    data-prefill.email="<?php echo $data['prefill']['email']?>"
    data-prefill.contact="<?php echo $data['prefill']['contact']?>"
    data-notes.shopping_order_id="<?php echo $razorpayOrderId?>"
    data-notes.event="<?php echo $data['notes']['plan'] ?>"
    data-order_id="<?php echo $data['order_id']?>"
    <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
    <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
  >
  </script>
  <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
  <input type="hidden" name="shopping_order_id" value="3456">
</form>
<div class="container my-3" style="opacity:0.9">
        <form action="../direct_workshop_purchased.php" method="post">
            <h3 style="color:white">
                OR
            </h3>
            <input type="text" name="unique_code" id="uc" placeholder="Enter Unique Code" maxlength="10" style="background-color:white; font-size: 15px; margin-bottom:10px; color:black" required><br>
            <input type="text" name="team_code" id="tc" placeholder="Enter Promotion Team Code" maxlength="10" style="background-color:white; font-size: 15px; margin-bottom:10px; color:black" required><br>

            <button type="submit">
                Pay Cash To Our Team.
            </button>
        </form>
    </div>
</div>
</center>
</div>
    <!-- Javascript Files
    ================================================== -->
 
	<script>
    $(window).on("load", function(){
      $(".twentytwenty-container[data-orientation!='vertical']").twentytwenty({default_offset_pct: 0.7});
      $(".twentytwenty-container[data-orientation='vertical']").twentytwenty({default_offset_pct: 0.3, orientation: 'vertical'});
    });
    </script>

</body>
</html>
