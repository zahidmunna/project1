

<?php

$paypal = new DPayPal(); //Create an DPayPal object
//Making SetExpressCheckout API call
//All available parameters for SetExpressCheckout are available at https://developer.paypal.com/docs/classic/api/merchant/SetExpressCheckout_API_Operation_NVP/

$requestParams = array(
    'RETURNURL' => "", //Enter URL of the page where you want to redirect your user after user enters PayPal login data and confirms order on PayPal page
    'CANCELURL' => ""//Page you want to redirect user to, if user press cancel button on PayPal website
);
//Order settings
$orderParams = array(
    'LOGOIMG' => "", //URL of your website logo. This image which will be displayed to the customer on the PayPal checkout page
    "MAXAMT" => "100", //Set maximum amount of transaction
    "NOSHIPPING" => "1", //I do not want shipping
    "ALLOWNOTE" => "0", //I do not want to allow notes
    "BRANDNAME" => "Here enter your brand name",
    "GIFTRECEIPTENABLE" => "0", //Disable gift receipt widget on the PayPal pages
    "GIFTMESSAGEENABLE" => "0"//Disables the gift message widget on the PayPal pages
);

//Item settings
$item = array(
    'PAYMENTREQUEST_0_AMT' => "20",
    'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR',
    'PAYMENTREQUEST_0_ITEMAMT' => "20",
    'L_PAYMENTREQUEST_0_NAME0' => 'Item name',
    'L_PAYMENTREQUEST_0_DESC0' => 'Item description',
    'L_PAYMENTREQUEST_0_AMT0' => "20",
    'L_PAYMENTREQUEST_0_QTY0' => '1',
        //"PAYMENTREQUEST_0_INVNUM" => $transaction->id - This field is useful if you want to send your internal transaction ID
);


//Now we will call SetExpressCheckout API operation. 
$response = $paypal->SetExpressCheckout($requestParams + $orderParams + $item);

//Response is also accessible by calling  $paypal->getLastServerResponse()

if (is_array($response) && $response['ACK'] == 'Success') { //Request successful
    //Now we have to redirect user to the PayPal
    //This is the point where user will be redirected to the PayPal page in order to provide Login details
    //After providing Login details, and after he confirms order in PayPal, user will be redirected to the page which you specified in RETURNURL field
    $token = $response['TOKEN'];

    header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' . urlencode($token));
} else if (is_array($response) && $response['ACK'] == 'Failure') {
    var_dump($response);
    exit;
}
