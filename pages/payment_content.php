<?php
if (isset($_POST['btn'])) {
    $query_result = $obj_app->save_order_info($_POST);
}
$query_result = $obj_app->select_cart_product_by_session_id($session_id);
$result = $obj_app->select_cart_product_by_temp_cart_id_for_payment_page($session_id);

$result2 = $obj_app->select_cart_product_by_session_id($session_id);
?>
<?php if (isset($_SESSION['customer_id'])) { ?>
    <body>
        <?php if(isset($_SESSION['order_total'])){?>
        <div class="product-big-title-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-bit-title text-center">

                            <h2>Your Order</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php while ($cart_product = mysqli_fetch_assoc($result2)) { ?>
    <center><img src="assets/<?php echo $cart_product['product_image']; ?>" style=""height="15" width="120"/></center>
        <?php } ?>
        <div id="order_review" style="position: relative;">
            <?php while ($products = mysqli_fetch_assoc($result)) { ?>
                <table class="shop_table">
                    <thead>
                        <tr>
                            <th class="product-name">Product</th>
                            <th class="product-total">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="cart_item">
                            <td class="product-name">
                                <strong class="product-quantity"><?php echo $products['product_name']; ?> </strong> </td>
                            <td class="product-total">
                                <span class="amount">Quantity:<?php echo $products['product_quantity']; ?></span> </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <?php if ($cart_product = mysqli_fetch_assoc($query_result)) { ?>
                        <tr class="cart-subtotal">
                            <th>Total</th>
                            <td><span class="amount">BDT <?php echo $cart_product['product_price'] * $cart_product['product_quantity']; ?></span>
                        </tr>
                        <?php } ?>
                    </tfoot>
                </table>
            <?php } ?>
            <h1 align="center" style="color:mediumseagreen">TOTAL <?php echo $_SESSION['order_total'] ;?>TK(including vat)</h1>



            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <hr/>

                            <form class="" action="" method="post">

                                <?php
                                $result = $obj_app->select_cart_product_by_temp_cart_id_for_payment_page($session_id);
                                $query_result = $obj_app->select_from_bkash();
                                if (isset($_POST['btn'])) {
                                    $query_result = $obj_app->save_bkash($_POST);
                                }
                                ?>     
                                <div class="container section-space-padding " >

                                    <div class="panel panel-default">
                                        

                                        <div class="panel-body">
                                            <div style="max-width:600px;margin: 0 auto;">
                                                  
                                                <form action="" method="POST" class="" >
                                                    <h1><a  href="bkash.php" type="submit"></a></h1>
                                                    <h1><a  href="#" type="submit"></a></h1>
                                                    <h1><a  href="#" type="submit"></a></h1>
                                                </form>
                                                <div class="woocommerce-info">
                                                    <h1><a class="showcoupon" data-toggle="collapse" href="#coupon-collapse-wrap" aria-expanded="false" aria-controls="coupon-collapse-wrap">Select Your Payment Method</a></h1>
                                                </div>

                            <form id="coupon-collapse-wrap" method="post" class="checkout_coupon collapse">

                                <p class="form-row form-row-first">
                                    <h4 align="left">Pay With </h4><h1><a  href="bkash.php" type="submit">Bkash</a></h1>
                                </p>
<!--                                <p class="form-row form-row-first">
                                    <h4 align="left">Pay With </h4><h1><a  href="#" type="submit">Paypal</a></h1>
                                </p>-->
                                <p class="form-row form-row-first">
                                <h4 align="left">Pay With </h4><h1><a  href="cash.php" type="submit">Cash on Delivery</a></h1>
                                </p>

                                <div class="clear"></div>
                            </form>
                                            </div>

                                        </div>


                                    </div>

                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
        <?php }else{ ?>
    <h1 align="center" style="color: red;"><?php echo 'Your Cart is Empty'; }?></h1>
    </body>
<?php } else { ?>
    <h1 align="center" style="color:red"><?php echo'Please Login or Make Your Registration'; ?></h1>
<?php } ?>