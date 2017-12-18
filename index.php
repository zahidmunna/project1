<?php
    ob_start();
    
    
    
    session_start(); 

        
    require './classes/application.php';
    $obj_app=new Application();
    
    
    

?>
<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
        <meta name="author" content="">
    <title>Fast Shopping</title>
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/front_end_assets/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/front_end_assets/css/font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/front_end_assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/front_end_assets/css/style.css">
    <link rel="stylesheet" href="assets/front_end_assets/css/responsive.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

    <body>
        <header id="header"><!--header-->
            <?php include './includes/header-area.php'; ?>
            
            <?php include './includes/header_bottom.php'; ?>
            <?php include './includes/site-branding-area.php'; ?>
            <?php include './includes/header_middle.php'; ?>
        </header><!--/header-->
        
        
        
        <?php
            if(isset($pages)) {
                if($pages == 'shop') {
                    include './pages/shop_content.php';
                }
                
                else if ($pages == 'product-details') {
                    include './pages/product_details_content.php';
                }
                else if ($pages == 'pdf') {
                    include './pages/database.php';
                }
                else if ($pages == 'cart') {
                    include './pages/cart_content.php';
                }else if ($pages == 'login') {
                    include './pages/login_content.php';
                }else if ($pages == 'register') {
                    include './pages/register_content.php';
                }
                else if ($pages == 'contact_us') {
                    include './pages/contact_us_content.php';
                }
                else if ($pages == 'bkash') {
                    include './pages/bkash_content.php';
                }
                else if ($pages == 'cash') {
                    include './pages/cash_content.php';
                }
                
                else if ($pages == 'customer') {
                    include './pages/customer_login.php.php';
                }
                else if ($pages == 'profile') {
                    include './pages/profile_content.php';
                }
                else if ($pages == 'category') {
                    include './pages/category_content.php';
                }
                else if ($pages == 'manufacture') {
                                include './pages/brand_manufacture.php';
                            }
                else if ($pages == 'checkout') {
                    include './pages/checkout_content.php';
                }
                else if ($pages == 'shipping') {
                    include './pages/shipping_content.php';
                }
                else if ($pages == 'payment') {
                    include './pages/payment_content.php';
                }
                else if ($pages == 'customer_home') {
                    include './pages/customer_home_content.php';
                }
                else if ($pages == 'customer_cash') {
                    include './pages/customer_cash_content.php';
                }
                
            } else {
                include './pages/home_content.php';
            }
        
        ?>
        
        
        
        
        
        
        
        <footer id="footer"><!--Footer-->
            <?php include './includes/footer-top-area.php'; ?>
            
            <?php include './includes/footer-bottom-area.php'; ?>
        </footer><!--/Footer-->
        
      	
 <!-- End footer top area -->

     <!-- End footer bottom area -->

    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>

    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- jQuery sticky menu -->
    <script src="assets/front_end_assets/js/owl.carousel.min.js"></script>
    <script src="assets/front_end_assets/js/jquery.sticky.js"></script>

    <!-- jQuery easing -->
    <script src="assets/front_end_assets/js/jquery.easing.1.3.min.js"></script>

    <!-- Main Script -->
    <script src="assets/front_end_assets/js/main.js"></script>
    
    <!-- Slider -->
    <script type="text/javascript" src="assets/front_end_assets/js/bxslider.min.js"></script>
    <script type="text/javascript" src="assets/front_end_assets/js/script.slider.js"></script>


        
    </body>
</html>