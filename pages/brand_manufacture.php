<?php
$manufacturer_id = $_GET['id'];
$query_result = $obj_app->select_published_product_info_by_manufacturer_id($manufacturer_id);
?>
<body>
    <section>

        <div class="product-big-title-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="product-bit-title text-center">
                            <h2>Brand Wized Products</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-sidebar">
                        </br>
                        
                    </div>

                </div>


                <div class="maincontent-area">

                    <div class="latest-product">
                        <div class="product-carousel">
                            <?php while ($product_info = mysqli_fetch_assoc($query_result)) { ?> 
                                <div class="single-product">
                                    <div class="product-f-image">
                                        <div class="thubmnail-recent">
                                            <div class="product-image-wrapper">
                                                <div class="productinfo text-center">
                                                    <img src="assets/<?php echo $product_info['product_image']; ?>" alt="" />
                                                </div>
                                            </div>
                                        </div>
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
    </section>

</body>
