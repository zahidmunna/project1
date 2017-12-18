<?php
if (isset($_POST['btn'])) {
    $message=$obj_app->save_customer_message($_POST);
}
?>
<body>
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Help Desk</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="contact-page" class="container">
        <div class="bg">
               		
                <div class="col-sm-8">
                    <div class="contact-form">
                        <h3 class="title text-center" style="color: #5a88ca">GET IN TOUCH</h3>
                        <h3 style="color: green"><?php
                                            if (isset($message)) {
                                                echo $message;
                                                unset($message);
                                            }
                                            ?></h3>
                        <div class="status alert alert-success" style="display: none"></div>
                        <form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
                            </div>                        
                            <div class="form-group col-md-12">
                                <input type="submit"id="submit" name="btn" class="btn btn-success pull-right" value="Submit">
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">
                        <h3 class="title text-center" style="color: #5a88ca">CONTACT INFO</h3>
                        <address>
                            <p>Mohammed Nahian</p>
                            <p>Phone : 01785876014</p>
                            <p>Email: nahi.789@gmail.com</p>
                            <p>Zahidur Rahman</p>
                            <p>Phone : 01824120673</p>
                            <p>Email: zahidurrahman@gmail.com</p>
                            <p>Mohammed Ismail</p>
                            <p>Phone : 01616742844</p>
                            <p>Email: mohammedismail@gmail.com</p>
                        </address>
                        <div class="social-networks">
                            <h3 class="title text-center" style="color: #5a88ca">SOCIAL NETWORKING</h3>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>    			
            
        </div>	
    </div>
</body>