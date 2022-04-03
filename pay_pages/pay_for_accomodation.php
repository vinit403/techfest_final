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
        color: white;
        font-weight: bold;
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
        padding: 0.5px;
    }

    #form {
        background-color: #191C24;
        max-width: 600px;
        opacity: 0.9;
        padding-top: 2px;
        padding-bottom: 25px;
    }
</style>

<?php

require('../config.php');
require('../razorpay/razorpay-php/Razorpay.php');
session_start();

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $phone_number = $_POST['phone_number'];
    $amount = $_POST["amount"];
    $count = $_POST['count'];

    $name_member2 = $_POST['name_member2'];
    $phone_number2 = $_POST['phone_number2'];
    $mail_member2 = $_POST['mail_member2'];

    $name = test_input($name);
    $mail = test_input($mail);
    $name_member2 = test_input($name_member2);
    $mail_member2 = test_input($mail_member2);

    if ($count == 4) {
        $name_member3 = $_POST['name_member3'];
        $phone_number3 = $_POST['phone_number3'];
        $mail_member3 = $_POST['mail_member3'];

        $name_member4 = $_POST['name_member4'];
        $phone_number4 = $_POST['phone_number4'];
        $mail_member4 = $_POST['mail_member4'];

        $name_member3 = test_input($name_member3);
        $mail_member3 = test_input($mail_member3);

        $name_member4 = test_input($name_member4);
        $mail_member4 = test_input($mail_member4);
    }
} else {
    exit;
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

if ($displayCurrency !== 'INR') {
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
        "payment_for"           => "Accomodation",
    ],
    "theme"             => [
        "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR') {
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
    <div class="container my-3" style="opacity:0.9">
        <center>
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
                    Amount : <?php echo $amount / 100 ?>
                </h3>
            </div>
            <div class="container my-3">
                <h3 id="h">
                    Payment for : <?php echo "Accomodation" ?>
                </h3>
            </div>
        </center>
        <div>
            <center>
                <form action="../verify_pages/verify_for_accomodation.php" method="POST" class="mx-3" id="form">
                    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $data['key'] ?>" data-amount="<?php echo $data['amount'] ?>" data-currency="INR" data-name="<?php echo $data['name'] ?>" data-image="<?php echo $data['image'] ?>" data-description="<?php echo $data['description'] ?>" data-prefill.name="<?php echo $data['prefill']['name'] ?>" data-prefill.email="<?php echo $data['prefill']['email'] ?>" data-prefill.contact="<?php echo $data['prefill']['contact'] ?>" data-notes.shopping_order_id="<?php echo $razorpayOrderId ?>" data-notes.event="<?php echo $data['notes']['payment_for'] ?>" data-order_id="<?php echo $data['order_id'] ?>" <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount'] ?>" <?php } ?> <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency'] ?>" <?php } ?>>
                    </script>
                    <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
                    <input type="hidden" name="shopping_order_id" value="3456">
                    <input type="hidden" name="order_id" value="<?php echo $razorpayOrderId ?>">

                    <input type="hidden" name="count" value="<?php echo $count ?>">
                    <input type="hidden" name="amount" value="<?php echo $amount ?>">

                    <input type="hidden" name="name" value="<?php echo $name ?>">
                    <input type="hidden" name="mail" value="<?php echo $mail ?>">
                    <input type="hidden" name="phone_number" value="<?php echo $phone_number ?>">

                    <input type="hidden" name="name_member2" value="<?php echo $name_member2 ?>">
                    <input type="hidden" name="mail_member2" value="<?php echo $mail_member2 ?>">
                    <input type="hidden" name="phone_number2" value="<?php echo $phone_number2 ?>">

                    <?php
                    if ($count == 4) {
                        echo '<input type="hidden" name="name_member3" value="' . $name_member3 . '">';
                        echo '<input type="hidden" name="mail_member3" value="' . $mail_member3 . '">';
                        echo '<input type="hidden" name="phone_number3" value="' . $phone_number3 . '">';

                        echo '<input type="hidden" name="name_member4" value="' . $name_member4 . '">';
                        echo '<input type="hidden" name="mail_member4" value="' . $mail_member4 . '">';
                        echo '<input type="hidden" name="phone_number4" value="' . $phone_number4 . '">';
                    }
                    ?>


                </form>
        </div>
        </center>
    </div>
</body>

</html>