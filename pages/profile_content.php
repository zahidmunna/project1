<?php if (isset($_SESSION['customer_id'])) { ?>
<?php
if (isset($_POST['btn'])) {
    $message = $obj_app->update_customer_profile_info($_POST);
}
?>
<?php
$customer_id = $_SESSION['customer_id'];
$query_result=$obj_app->select_customer_info_for_profile($customer_id);
?>
<script>
    var xmlHttp = new XMLHttpRequest();
    function ajax_email_check(given_email, objID) {
        //alert(objID);
        var server_page = 'ajax_email_check.php?email=' + given_email;
        xmlHttp.open('$_GET', server_page);
        xmlHttp.onreadystatechange = function () {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                document.getElementById(objID).innerHTML = xmlHttp.responseText;
                if (xmlHttp.responseText == 'Email Already Exists') {
                    document.getElementById('signup').disabled = true;
                } else {
                    document.getElementById('signup').disabled = false;
                }
            }
        }
        xmlHttp.send(null);
    }
</script>
<body>
    <?php while ($profile = mysqli_fetch_assoc($query_result)) { ?>
    <br/>
    <h1 style="color: #5a88ca" align="center" >YOUR PROFILE</h1>
    <br/>
                                    
                                        <h3 align="center" style="color: green"><?php
                                            if (isset($message)) {
                                                echo $message;
                                                unset($message);
                                            }
                                        ?></h3>
                                    
            <div class="container">
            <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
    <div class="panel-body">
    <form class="form-horizontal" action="" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="name">First Name</label>  
                                    <div class="col-md-8">
                                        <input id="name" name="first_name" value="<?php echo $profile['first_name']; ?>" type="text" placeholder="Enter your name" class="form-control input-md" required="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="name">Last Name</label>  
                                    <div class="col-md-8">
                                        <input id="name" name="last_name" value="<?php echo $profile['last_name']; ?>" type="text" placeholder="Enter your name" class="form-control input-md" required="">
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="email">Email</label>  
                                    <div class="col-md-8">
                                        <input id="email" name="email_address" value="<?php echo $profile['email_address']; ?>" name="email_address" type="email" placeholder="Enter your email id" class="form-control input-md" required="" onblur="ajax_email_check(this.value, 'res');">
                                        <span id="res"></span>
                                    </div>
                                </div>



                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="contact">Phone Number</label>  
                                    <div class="col-md-8">
                                        <input id="contact" name="phone_number" value="<?php echo $profile['phone_number']; ?>" name="phone_number" type="number" placeholder="Enter your contact no." class="form-control input-md" required="">

                                    </div>
                                </div>

                                <!-- Select Basic -->



                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="street">Address</label>  
                                    <div class="col-md-8">
                                        <textarea class="form-control" name="address"><?php echo $profile['address']; ?></textarea>
                                    </div>
                                </div>
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="city">City</label>  
                                    <div class="col-md-8">
                                        <input id="city" name="city" value="<?php echo $profile['city']; ?>" name="city" type="text" placeholder="Enter your city" class="form-control input-md" required="">
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="dist">District</label>  
                                    <div class="col-md-8">
                                        <input id="dist" name="district" value="<?php echo $profile['district']; ?>" name="district" type="text" placeholder="Enter your district" class="form-control input-md" required="">
                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="signup"></label>
                                    <div class="col-md-8">
                                        <button type="submit" id="signup" name="btn" class="btn btn-success btn-block">Update Profile</button>
                                    </div>
                                </div>

                            </fieldset>
                        </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    <?php } ?>
</body>

<?php } ?>