<?php
$result = $obj_app->select_all_published_category_for_showing_in_front();
$query_result = $obj_app->select_all_published_manufacturer();

?>
<body>
    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2>FAST <span>SHOPPING</span></h2>
                        <p>Fast Shopping is a ecommerce website where you can buy any product without any hamper & you can save your valuable time</p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Our Brands</h2>
                        <ul>
                            <?php while ($brands_info = mysqli_fetch_assoc($query_result)) { ?>
                                <li><a href="manufacture.php?id=<?php echo $brands_info['manufacturer_id']; ?>" class=""><?php echo $brands_info['manufacturer_name']; ?></a></li>
                            <?php } ?>
                        </ul>                        
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Our Categories</h2>
                        <ul>

                            <?php while ($category_info = mysqli_fetch_assoc($result)) { ?>
                                <li><a href="category.php?id=<?php echo $category_info['category_id']; ?>" class=""><?php echo $category_info['category_name']; ?></a></li>
                            <?php } ?>
                        </ul>                        
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</body>
