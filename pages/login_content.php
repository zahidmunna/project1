<?php
if (isset($_POST['btn'])) {

    $message = $obj_app->customer_login_check($_POST);
}
?>



<body>
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>You have to login to complete your valuable order. If you are not registered yet then please register <a href="register.php"> <h2><strong>Here</strong></h2></a></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="container-fluid-full">
            <div class="row-fluid">
                <div class="row-fluid">
                    <div class="login-box">
                        <div class="icons">
                            <a href="index.html"><i class="halflings-icon home"></i></a>
                            <a href="#"><i class="halflings-icon cog"></i></a>
                        </div>
                        <br/>
                        <h2 style="color: #5a88ca">Login to your account</h2>
                        
                        <h2 style="color: red;"><?php if (isset($message)) {
                                    echo $message;
                                    unset($message);
                                    } ?></h2>

                        <form class="form-horizontal" action="" method="post">
                            <fieldset>
                                <div class="form-group">
                                        <div class="clearfix"></div>

                                        <div class="col-md-7"> 
                                            <input class="col-md-7 form-control-static"  name="email_address" id="username" type="email" placeholder="Enter your email address"  required=""/>    
                                        </div>

                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <div class="input-prepend" title="Password">
                                        <div class="col-md-7"> 
                                            <input class="col-md-7 form-control-static" name="password" id="password" type="password" placeholder="Enter your password" required=""/>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br/>
                                    <div class="form-group">
                                     <div class="col-md-7"> 
                                            <div class="col-md-7" align="left" > 
                                                
                                                <button type="submit" name="btn" class="btn btn-success">Login</button>
                                            </div>
                                    </div>
                                    
                                    </div>
                                    <div class="clearfix"></div>


                            </fieldset>
                        </form>
	
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
