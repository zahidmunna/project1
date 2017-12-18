<?php
$query_result = $obj_app->select_latest_product_info();
$query_result2 = $obj_app->select_all_published_manufacturer_for_product();
?>
<body>
    <div class="product-big-title-area">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="product-bit-title text-center">
                                            <h2>Our Brands</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
         </div>
                        <div class="brands-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="brand-wrapper">
                        <div class="brand-list">
                            <?php while ($brands_info = mysqli_fetch_assoc($query_result2)) { ?>
                            <h1><strong><li><a href="manufacture.php?id=<?php echo $brands_info['manufacturer_id']; ?>" class=""><?php echo $brands_info['manufacturer_name']; ?></a></li></strong></h1>
                            <?php } ?>                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
                     </div>
    
                        <div class="product-big-title-area">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="product-bit-title text-center">
                                            <h2>Latest Products</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <div class="product-carousel">
                            <?php while ($product_info = mysqli_fetch_assoc($query_result)) { ?> 
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <img src="pages/<?php echo $product_info['product_image']; ?>" style="height: 80;width: 80;"height="80" width="80"  alt="poster_1_up" class="shop_thumbnail"  alt="" />
                                        <div class="product-hover">
                                            <a href="product_details.php?id=<?php echo $product_info['product_id']; ?>" class="view-details-link"><i class="fa fa-link"></i> See details</a>
                                        </div>
                                    </div>
                                    <h2><?php echo $product_info['product_name']; ?></h2>
                                    <div class="product-carousel-price">
                                        <ins>BDT <?php echo $product_info['product_price']; ?></ins> <del></del>
                                    </div> 
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
             </div>
            </div>
        </div>
</body>
