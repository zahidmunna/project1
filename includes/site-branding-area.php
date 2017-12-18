<?php
$session_id = session_id();
$query_result = $obj_app->select_cart_product_by_temp_cart_id($session_id);

?>    

<body>
    <div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="index.php"><img src="">FAST <span>SHOPPING</span></a></h1>
                    </div>
                </div>
                <?php if ($product = mysqli_fetch_assoc($query_result)) { ?>
                    
                        <div class="col-sm-6">
                            <div class="shopping-item">

                                <a href="cart.php">Cart -BDT <?php echo $product['sum(product_price*product_quantity)']; ?> <span></span> <i class="fa fa-shopping-cart"></i> <span  class="product-count"><?php echo $product['sum(product_quantity)']; ?></span></a>
                                
                        </div>
                    </div>
               
                <?php }?>        
                

            </div>
        </div>
    </div>
</body>

