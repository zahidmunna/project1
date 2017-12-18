<?php
if (isset($_POST['btn'])) {
    $message = $obj_app->add_to_cart($_POST);
}


$product_id = $_GET['id'];
$query_result = $obj_app->select_product_info_by_id($product_id);
$product_info = mysqli_fetch_assoc($query_result);

$result = $obj_app->select_latest_product_info_for_product_details();
?>

<body>


    <!-- End site branding area -->

    <!-- End mainmenu area -->

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>See Details</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                   

                    <div class="single-sidebar">
                        
                    </div>

                </div>

                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
<?php if ($product_info['stock_amount'] == 0) { ?>
                                            <img src="assets/<?php echo $product_info['product_image']; ?>" alt="" />
                                            <img src="assets/front_end_assets/img/sold_out.png" alt="" />
<?php } else { ?>
                                            <img src="assets/<?php echo $product_info['product_image']; ?>" alt="" />
                                        <?php } ?>
                                    </div>
                                    <ol class="breadcrumb">
                                        <h2><?php if (isset($message)) {
                                            echo $message;
                                            unset($message);
                                        } ?></h2>
                                    </ol>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h3><p>Product ID: <?php echo $product_info['product_id']; ?></p></h3>
                                    <h3><p>Product Name: <?php echo $product_info['product_name']; ?></p></h3>
                                    <div class="product-inner-price">
                                        <h1 style="color: #5a88ca"><ins>BDT <?php echo $product_info['product_price']; ?></ins></h1>
                                    </div>    
<?php if ($product_info['stock_amount'] == 0) { ?>
                                        <label><h2><p>Availability:<b>Not in Stock</b> </p></h2></label>
                                        <label><h2><p>Quantity Available: <b><?php echo $product_info['stock_amount']; ?></b></p></h2></label>
<?php } else { ?>
                                        <label><h2><p>Availability: <b>In Stock</b></p></h2></label>
 

                                        <form action="" class="cart" method="post">
                                            <div class="quantity">
                                                <label><h2><p><b>Quantity:</b></p></h2></label>
                                                <input type="text" name="product_quantity" value="1" />
                                                <input type="hidden" name="product_id" value="<?php echo $product_info['product_id']; ?>" />
                                            </div>
                                            <br/>
                                            <br/>
                                            <button class="add_to_cart_button" type="submit" name="btn">Add to cart</button>

                                        </form>
<?php } ?>

                                    </form>
                                    <br/>


                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                               <h3>Product Short Description</h3>
                                                <p><?php echo $product_info['product_short_description']; ?></p>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h3>Product Long Description</h3>
                                                <p><?php echo $product_info['product_long_description']; ?></p>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                <h2>Reviews</h2>
                                                <div class="submit-review">
                                                    <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                    <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                    <div class="rating-chooser">
                                                        <p>Your rating</p>

                                                        <div class="rating-wrap-post">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                    <p><input type="submit" value="Submit"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
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

</body>