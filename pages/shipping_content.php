<?php if (isset($_SESSION['customer_id'])) { ?>
<?php
$customer_id = $_SESSION['customer_id'];

//echo $customer_id;

if (isset($_POST['btn'])) {
    $obj_app->save_shipping_info($_POST);
}

$query_result = $obj_app->select_customer_info_by_id($customer_id);
$customer_info = mysqli_fetch_assoc($query_result);
?>

<body>
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">

                        <h2>Welcome <strong><?php echo $_SESSION['customer_name']; ?></strong></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2 class="text-center "><h2 align="center" style="color: #5a88ca">Shipping to a another address?</h2>
                        <hr/>
                        <form class="form-horizontal" action="" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="name">Full Name</label>  
                                    <div class="col-md-8">
                                        <input id="name" name="full_name" value="<?php echo $customer_info['first_name'] . " " . $customer_info['last_name']; ?>" type="text" placeholder="Enter your name" class="form-control input-md" required="">
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="email">Email</label>  
                                    <div class="col-md-8">
                                        <input id="email" value="<?php echo $customer_info['email_address']; ?>" name="email_address" type="email" placeholder="Enter your email id" class="form-control input-md" required="" onblur="ajax_email_check(this.value, 'res');">
                                        <span id="res"></span>
                                    </div>
                                </div>



                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="contact">Phone Number</label>  
                                    <div class="col-md-8">
                                        <input id="contact" value="<?php echo $customer_info['phone_number']; ?>" name="phone_number" type="number" placeholder="Enter your contact no." class="form-control input-md" required="">

                                    </div>
                                </div>

                                <!-- Select Basic -->



                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="street">Address</label>  
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="address"><?php echo $customer_info['address']; ?></textarea>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="city">City</label>  
                                    <div class="col-md-8">
                                        <input id="city" value="<?php echo $customer_info['city']; ?>" name="city" type="text" placeholder="Enter your city" class="form-control input-md" required="">
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="dist">District</label>  
                                    <div class="col-md-8">
                                        <input id="dist" value="<?php echo $customer_info['district']; ?>" name="district" type="text" placeholder="Enter your district" class="form-control input-md" required="">
                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="signup"></label>
                                    <div class="col-md-8">
                                        <button type="submit" id="signup" name="btn" class="btn btn-success btn-block">Save Shipping Info</button>
                                    </div>
                                </div>

                            </fieldset>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
<?php } else{?>
<h1 align="center" style="color:red"><?php echo'Please Login or Make Your Registration';?></h1>
<?php } ?>