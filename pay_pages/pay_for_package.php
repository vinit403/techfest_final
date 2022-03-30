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
        $event = "Purchase Package";
        $amount = 499;

        $sql = "SELECT * FROM `package_purchased` WHERE user_id = '$user_name'";
        $result = mysqli_query($connect, $sql);
        $sql = "SELECT * FROM `premium_package_purchased` WHERE user_id='$user_name'";
        $result2 = mysqli_query($connect, $sql);
        $sql = "SELECT * FROM `package_purchased_on_cash` WHERE user_id='$user_name'";
        $result3 = mysqli_query($connect, $sql);
        $sql = "SELECT * FROM `premium_package_purchased_on_cash` WHERE user_id='$user_name'";
        $result4 = mysqli_query($connect, $sql);

        $row3 = mysqli_num_rows($result3);
        $row4 = mysqli_num_rows($result4);
        $row2 = mysqli_num_rows($result2);
        $row = mysqli_num_rows($result);

        if($row == 1 || $row2 == 1 || $row3 == 1 || $row4 == 1)
        {
            echo '<div id="simpleModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Customer Details Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        You have already purchased package or premium package
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"/>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script type="text/javascript">
window.onload = function () {
OpenBootstrapPopup();
};
function OpenBootstrapPopup() {
$("#simpleModal").modal("show");
}
</script>'; 
           
           echo '  <center>
           <div class="container my-3" style="opacity:0.9">
               <div class="container my-3">
                   <h2 id="h" style="color:#8e04d9">
                       Your Details
                   </h2>
                   </div>
               <div class="container my-3">
                 <h3 id="h">
                     Name : '.$name.'
                 </h3>
             </div>
             <div class="container my-3">
               <h3 id="h">
                     Mail id :'.$mail.'
               </h3>
               </div>
               <div class="container my-3">
               <h3 id="h">
                     Phone Number :'.$phone_number.'
                 </h3>
               </div>
               <div class="container my-3">
               <h3 id="h">
                     Amount : '.$amount.'/100 
                 </h3>
               </div>
               <div class="container my-3">
               <h3 id="h">
                     Payment for : '.$event.'
                 </h3>
               </div>
               <div class="container my-3">
               <h3 id="h" style="color:yellow">
               You Have Already Purchased a package / premium package
                </h3>
                </div>
               </center>';

               exit;
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
<form action="../verify_pages/verify_for_package.php" method="POST" class="mx-3" id="form">
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
        <form action="../direct_package_purchased.php" method="post">
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
