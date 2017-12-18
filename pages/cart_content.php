<?php
if (isset($_POST['btn'])) {
    $message = $obj_app->update_cart_product_info($_POST);
}
if (isset($_GET['status'])) {
    $cart_product_id = $_GET['id'];
    $message = $obj_app->delete_cart_product_info_by_id($cart_product_id);
}

$session_id = session_id();
$query_result2 = $obj_app->select_cart_product_by_temp_cart_id_for_cart_page($session_id);
$query_result = $obj_app->select_cart_product_by_session_id($session_id);
$result = $obj_app->select_latest_product_info_for_product_details();
//    $cart_product_id=$_GET['id'];
?>
<body>
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->


    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    

                    <div class="single-sidebar">
                       
                    </div>

                    <div class="single-sidebar">
                        
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">
                            <form method="post" action="#">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                    <ol class="breadcrumb">
                                        <h3><?php
                                            if (isset($message)) {
                                                echo $message;
                                                unset($message);
                                            }
                                            ?></h3>
                                    </ol>
                                    <tr>
                                        <th class="product-remove">Delete</th>
                                        <th class="product-thumbnail">Item</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $quan = 0; ?>
                                        <?php
                                        $sum = 0;
                                        while ($cart_product = mysqli_fetch_assoc($query_result)) {
                                            ?>

                                            <tr class="cart_item">
                                                <td class="product-remove">
                                                    <a title="Remove this item" class="remove" href="?status=delete&&id=<?php echo $cart_product['temp_cart_id']; ?>">×</a> 
                                                </td>

                                                <td class="product-thumbnail">
                                                    <a href="single-product.html"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="assets/<?php echo $cart_product['product_image']; ?>"></a>
                                                </td>

                                                <td class="product-name">
                                                    <a href=""><?php echo $cart_product['product_name']; ?></a> 
                                                    <p>Product ID: <?php echo $cart_product['product_id']; ?></p> 
                                                </td>

                                                <td class="product-price">
                                                    <span class="amount">BDT <?php echo $cart_product['product_price']; ?></span> 
                                                </td>
                                                <?php $quan = 0; ?>
                                                <td class="cart_quantity">
                                                    <form action="" name="btn" method="post">
                                                        <div class="cart_quantity_button">
                                                            <input class="cart_quantity_input" type="text" name="product_quantity" value="<?php echo $quan = $cart_product['product_quantity']; ?>" autocomplete="off" size="2">
                                                            <input class="cart_quantity_input" type="hidden" name="temp_cart_id" value="<?php echo $cart_product['temp_cart_id']; ?>" autocomplete="off" size="2">
                                                            <input type="submit" name="btn" class="btn-success" value="Update">
                                                        </div>

                                                    </form>
                                                </td>

                                                <td class="product-subtotal">
                                                    <span class="amount"><h2> <?php
                                                            $total = $cart_product['product_price'] * $cart_product['product_quantity'];
                                                            echo 'BDT ' . $total;
                                                            ?>
                                                        </h2></span> 
                                                </td>
                                            </tr>

                                            <?php
                                            $sum = $sum + $total;
                                        }
                                        ?>
<!--                                        <tr>
                                            <td class="actions" colspan="6">
                                                <div class="coupon">
                                                    <label for="coupon_code">Coupon:</label>
                                                    <input type="text" placeholder="Coupon code" value="" id="coupon_code" class="input-text" name="coupon_code">
                                                    <input type="submit" value="Apply Coupon" name="apply_coupon" class="button">
                                                </div>

                                            </td>
                                        </tr>-->
                                    </tbody>
                                </table>
                            </form>

                            <div class="cart-collaterals">




                                <form method="post" action="" class="shipping_calculator">
                                    <?php if ($sum == NULL) { ?>
                                    <h2 align="right"><a href="index.php"><strong>Continue Shopping</strong></a></h2>

                                    <?php } else { ?>
                                        <?php
                                        $customer_id = isset($_SESSION['customer_id']);
                                        $shipping_id = isset($_SESSION['shipping_id']);
                                        if ($customer_id == NULL && $shipping_id == NULL) {
                                            ?>
                                    <h2 align="right"><a  href="checkout.php" type="submit"><strong>Checkout</strong></a></h2>
                                        <?php } else if ($customer_id != NULL && $shipping_id == NULL) { ?>
                                    <h2 align="right"><a  href="shipping.php" type="submit"><strong>Checkout</strong></a></h2>
                                        <?php } else if ($customer_id != NULL && $shipping_id != NULL) { ?>
                                    <h2 align="right"><a  href="payment.php" type="submit"><strong>Checkout</strong></a></h2>
                                    <?php } ?>

                                    <h2 align="right"><a href="index.php" type="submit"><strong>Continue Shopping</strong></a></h2>
                                    <?php } ?>
                                </form>

                                <div class="cart_totals ">
                                    <h2>Cart Totals</h2>
                                    <table cellspacing="0">
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <?php if ($total_quantity = mysqli_fetch_assoc($query_result2)) { ?>
                                                <th>Total Quantity</th>
                                                <?php echo $quan_total = $cart_product['product_quantity']; ?>
                                                <td><span class="amount"><?php echo $total_quantity['sum(product_quantity)']; ?></span></td>
                                                <?php }?>
                                            </tr>
                                            <tr class="cart-subtotal">
                                                <th>Cart Subtotal</th>
                                                <td><span class="amount">BDT <?php echo $sum; ?></span></td>
                                            </tr>

                                            <tr class="shipping">
                                                <th>VAT Total</th>
                                                <td><span><?php
                                            $vat = ($sum * 1) / 100;
                                            echo 'BDT ' . $vat;
                                            ?></span></td>
                                            </tr>

                                            <tr class="order-total">
                                                <th>Grand Total</th>
                                                <td><strong><span class="amount"><h3>BDT 
                                                                <?php
                                                                $grand_total = $sum + $vat;
                                                                $_SESSION['order_total'] = $grand_total;
                                                                echo $grand_total;
                                                                ?>
                                                            </h3></span></strong> </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="related-products-wrapper">
                                <h2 class="related-products-title" style="color: #5a88ca">Other Products</h2>

                                <div class="product-carousel">
<?php while ($info = mysqli_fetch_assoc($result)) { ?> 
                                        <div class="single-product">
                                            <div class="product-f-image">

                                                <img src="pages/<?php echo $info['product_image']; ?>"  alt="poster_1_up" class="shop_thumbnail"  alt="" height="225 width="225" />
                                                <div class="product-hover">

                                                    <a href="product_details.php?id=<?php echo $info['product_id']; ?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>


                                                </div>
                                            </div>

                                            <h2><?php echo $info['product_name']; ?></h2>

                                            <div class="product-carousel-price">
                                                <ins>BDT <?php echo $info['product_price']; ?></ins> <del></del>
                                            </div> 
                                        </div>
<?php } ?>
                                </div>                                 
                            </div>    
                        </div>                        
                    </div>                    
                </div>
            </div>
        </div>
    </div>

</body>








