<?php if (isset($_SESSION['customer_id'])) { ?>

<?php

if (isset($_POST['btn'])) {
    $message=$query_result = $obj_app->save_cash_on_delivery($_POST);
}
?>     
<?php if (isset($_SESSION['customer_id'])) { ?>
<?php if(isset($_SESSION['order_total'])){?>
<div class="container section-space-padding " >
    <h2 style="color:green" align="center">Pay cash at your doorstep at the time of order delivery.</h2>
    <br/>
    <h3 style="color:green" align="center"><strong>Important:</strong> Please have the exact amount available as our delivery driver may not be carrying sufficient change. </h3>
    <br/>
    <h4 style="color:blueviolet" ><strong>Caution:</strong> Final Step This is the final step. Once you click "Confirm Cash on Delivery Payment", you will not be able to change or edit your order. 

        To cancel, edit or change your order go back to cart page <a href="cart.php"><strong>click here</strong></a></h4>
    <h4 style="color:firebrick" ><strong>Cancellation Policy</strong></h4> 
        
    
    <h4 style="color:firebrick" >Please note that Fast Shopping has the right to cancel any order at any time whether or not the order has been confirmed. In case of cancellation of prepaid orders (fully or partially), full amount paid by the customer will be refunded within 2-3 business days of cancelling the orders.</h4>
    <h2 style="color:green" >*By clicking "Confirm Cash on Delivery Payment" you are agreeing to all Terms & Conditions</h2>
    <div class="panel panel-default">
  
                        <div class="panel-body">
                            <div style="max-width:600px;margin: 0 auto;">

                                <form action="" method="POST" class="" >

                                    <input type="submit" id="btn" name="btn" class="btn btn-success" value="Confirm Cash on Delivery Payment" />


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


