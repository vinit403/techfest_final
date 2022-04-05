<style>
    input {

        /* background-image: linear-gradient(180deg, #FC466B , #3F5EFB); */
        background-color: #D3CCE3;
        font-weight: 700;
        border-radius: 25px;
        border: none;
        padding: 10px 20px;

    }

    #btn {

        background-color: #D3CCE3;
        font-weight: 700;
        border-radius: 25px;
        border: none;
        padding: 10px 20px;
    }

    body {
        background-image: url('../images/ty.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }

    .modal-content {
        background-image: linear-gradient(90deg, #FFAFBD, #ffc3a0);

    }

    .modal-content1 {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        pointer-events: auto;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, .2);
        border-radius: 0.3rem;
        outline: 0;
        background-image: linear-gradient(45deg, #642B73, #C6426E);

    }

    .py-51 {
        padding: 0px;
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
        $amount = 399;

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
        $err = "";

        if($row == 1 || $row2 == 1 || $row3 == 1 || $row4 == 1)
        {
            if ($row == 1 ){
                $err = "You already purchase standard package!";
            }
            elseif($row2 == 1){
                $err = "You already purchase premium package!";
            }
            elseif($row3 == 1){
                $err = "You already purchase standard package via cash!";
            }
            elseif($row4 == 1){
                $err = "You already purchase premium package via cash!";
            }
            echo ' <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
                   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
                   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

                      <div class="modal-dialog">
                           <div class="modal-content">
                               <div class="modal-body ">
                                   <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i> </div>
                                   <div class="px-4 py-5">
                                       <h5 class="text-uppercase"> Dear ' . $name . '</h5>
                                       <h4 class="mt-5 theme-color mb-5">'.$err.'</h4> <span class="theme-color">You can purchase add-on for more events.</span>
                            
                               </div>
                           </div>
                       </div>
                   </div>';
             header("refresh:7,url=../package.php");

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body ">
                <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i> </div>
                <div class="px-4 py-5">
                    <h5 class="text-uppercase"><?php echo $name ?></h5>
                    <h4 class="mt-5 theme-color mb-5">Standard has a class that premium never understand.</h4> <span class="theme-color">Payment Summary</span>
                    <div class="mb-3">
                        <hr class="new1">
                    </div>
                    <h6>All the details will send to your Email.</h6>
                    <p>If you haven't receive email. Check your spam box</p>
                    <div class="d-flex justify-content-between"> <span class="font-weight-bold">Standard Package</span> <span class="text-muted">₹399.00</span> </div>

                    <div class="d-flex justify-content-between mt-3"> <span class="font-weight-bold">Total</span> <span class="font-weight-bold theme-color">₹399.00</span> </div>
                    <!-- <div class="text-center mt-5"> <button class="btn btn-primary">Pay now</button> </div> -->
                </div>
            </div>
        </div>
    </div>

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
  <input type="hidden" name="order_id" value="<?php echo $razorpayOrderId ?>">
  <input type="hidden" name="amount" value="<?php echo $amount ?>">

</form>
</center>
<div class="modal-dialog">
            <div class="modal-content1">
                <div class="modal-body ">
                    <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i> </div>
                    <div class="px-4 py-51">
                        <h4 class="mt-5 theme-color mb-5">Only for cash payment</h4>
                        <center>
                        <form action="../direct_package_purchased.php" method="post">

                            <input type="text" name="unique_code" id="uc" placeholder="Enter Unique Code" maxlength="8" style="background-color:white; font-size: 13px; margin-bottom:10px; color:black" required><br>
                            <input type="text" name="team_code" id="tc" placeholder="Enter campaigning Team Code" maxlength="4" style="background-color:white; font-size: 13px; margin-bottom:10px; color:black" required><br>

                            <button type="submit" id="btn">
                                Pay Cash To Our Team.
                            </button>
                        </form>
                        </center>
                    </div>
                </div>
            </div>

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
