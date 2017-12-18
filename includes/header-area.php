<?php
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'logout') {
        $obj_app->customer_logout();
    }
}
?>
<body>
    <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            <li><a href="index.php"><i class="fa fa-user"></i> My Account</a></li>
                            <?php if (isset($_SESSION['customer_id'])) { ?>
                                <li><a href="cart.php"><i class="fa fa-user"></i> My Cart</a></li>
                            <?php } else { ?>
                                <li><a href="cart.php"><i class="fa fa-user"></i> Cart</a></li>
                            <?php } ?>
                            <?php if (isset($_SESSION['customer_id'])) { ?>
                                
                                
                                    <?php } else { ?>
                                <li><a href="register.php"><i class="fa fa-shopping-cart"></i> Register</a></li>
                            <?php } ?>
                            
                                <?php if (isset($_SESSION['customer_id'])) { ?>
                                <li><a href="profile.php" ><i class="fa fa-user"></i>Profile</a></li>
                                <?php } ?>
                                    <?php if (isset($_SESSION['customer_id'])) { ?>



                                <li class="dropdown dropdown-small">
                                    <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key" style="color: #5a88ca"><strong><?php echo ($_SESSION['customer_name']) ?></strong></span><span class="value"></span><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="?status=logout" style="color:#5a88ca">Logout</a></li>
                                    </ul>
                                </li>



                            <?php } else { ?>

                                <li><a href="login.php"><i class="fa fa-user"></i> Login</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="header-right">
                        <ul class="list-unstyled list-inline">
                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">currency :</span><span class="value">Taka </span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Taka</a></li>
                                    <li><a href="#">USD</a></li>
                                    <li><a href="#">INR</a></li>
                                    <li><a href="#">GBP</a></li>
                                </ul>
                            </li>

                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">language :</span><span class="value">English </span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">German</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
