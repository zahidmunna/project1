<?php if (isset($_SESSION['customer_id'])) { ?>
<?php
$result = $obj_app->select_cart_product_by_temp_cart_id_for_payment_page($session_id);
$query_result = $obj_app->select_from_bkash();
if (isset($_POST['btn'])) {
    $message=$query_result = $obj_app->save_bkash($_POST);
}
?>     
<?php if (isset($_SESSION['customer_id'])) { ?>
<?php if(isset($_SESSION['order_total'])){?>
<div class="container section-space-padding " >
    <h2 style="color:green" align="center">How does the bKash payment on Fast Shopping works</h2>
    <br/>
    <h4 style="color:blueviolet" >Step 1: Dial *247# to get your bKash Menu</h4>
    <h4 style="color:blueviolet" >Step 2: Press 3 for "Payments"</h4>
    <h4 style="color:blueviolet" >Step 3: Enter the Fast Shopping Merchant Number: 01785876014</h4>
    <h4 style="color:blueviolet" >Step 4: Enter Amount : Total order amount</h4>
    <h4 style="color:blueviolet" >Step 5: Enter your number as reference.</h4>
    <h4 style="color:blueviolet" >Step 6: Enter "1" for the bKash Counter No.</h4>
    <h4 style="color:blueviolet" >Step 7: Verify your payment by entering your PIN</h4>
    <h4 style="color:blueviolet" >Step 8: After Completting the payment successfully by bkash,you will receive a message shortly from bkash with Transaction ID,then fill the Transaction ID field below within 50 minutes with that Transaction ID you have received via sms</h4>
    <h4 style="color:blueviolet" >Step 9: Click Confirm Bkash Payment</h4>
    
    
        <h4 style="color:firebrick" >Cancellation Policy</h4> 
        
    <h4 style="color:firebrick" >After receiving the Transaction ID from bkash,If you failed to fill the Transaction ID field below within 50 minutes,your order will be cancelled.</h4>
    <h4 style="color:firebrick" >Please note that Fast Shopping has the right to cancel any order at any time whether or not the order has been confirmed. In case of cancellation from customer, customer will get refund to the number used to send bkash payment.</h4>
    <br/>
    <h2 style="color:green" >*By clicking "Confirm Bkash Payment" you are agreeing to all Terms & Conditions</h2>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 style="color: #5a88ca">Pay With Bkash <ol class="breadcrumb"></h2>
                    <h3 style="color: red;"><?php
                        if (isset($message)) {
                            echo $message;
                            unset($message);
                        }
                        ?></h3>

                    </div>
                        <div class="panel-body">
                            <div style="max-width:600px;margin: 0 auto;">

                                <form action="" method="POST" class="" >

                                    <div class="form-group">


                                        <td>Transaction ID</td>
                                        <td><input type="text" required="" name="transaction_id" value=""></td>

                                    </div>

                                    <div class="form-group">
                                        <label for="amount" >Total Amount</label>
                                        
                                        <input type="text" name="readonly_amount" id="amount" class="form-control" value="<?php echo $_SESSION['order_total']; ?>" readonly="readonly"/>
                                        
                                        <div id="amount_error" class="validation-error"></div>
                                    </div>

                                    <input type="submit" id="btn" name="btn" class="btn btn-success" value="Confirm bKash Payment" />


                                </form>
                            </div>
                        </div>
                   

                    </div>

                    </div>
<?php }else{ ?>
    <h1 align="center" style="color: red;"><?php echo 'Your Cart is Empty'; }?></h1>
    
<?php } ?>
<?php } else{?>
<h1 align="center" style="color:red"><?php echo'Please Login or Make Your Registration';?></h1>
<?php } ?>


