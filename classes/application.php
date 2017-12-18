<?php

class Application {

    private $db_connect;

    public function __construct() {
        $host_name = 'localhost';
        $user_name = 'root';
        $password = '';
        $db_name = 'db_fast_shopping';
        $this->db_connect = mysqli_connect($host_name, $user_name, $password, $db_name);
        if (!$this->db_connect) {
            die('Connection Fail' . mysqli_error($this->db_connect));
        }
    }

    public function customer_login_check($data) {
        $email_address = $data['email_address'];
        $password = md5($data['password']);

        $sql = "SELECT * FROM tbl_customer WHERE email_address='$email_address' AND password='$password' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            $customer_info = mysqli_fetch_assoc($query_result);

            if ($customer_info) {
                session_start();
                $_SESSION['customer_name'] = $customer_info['first_name'] . " " . $customer_info['last_name'];
                $_SESSION['customer_id'] = $customer_info['customer_id'];
//                $_SESSION['activation_status']=$customer_info['activation_status'];

                $customer_id = $_SESSION['customer_id'];
                if ($customer_id == NULL) {
                    $customer_id = isset($_SESSION['customer_id']);
                }
                $customer_info = mysqli_insert_id($this->db_connect);
                $_SESSION['customer_id'] = $customer_info;
                $_SESSION['customer_id'] = $customer_id;
                header('Location: cart.php');
            } else {
                $message = "Your email address or password invalid";
                return $message;
            }
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_all_published_category() {
        $sql = 'SELECT * FROM tbl_category WHERE publication_status = 1';
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_all_published_category_for_showing_in_front() {
        $sql = 'SELECT * FROM tbl_category WHERE publication_status = 1';
        if (mysqli_query($this->db_connect, $sql)) {
            $result = mysqli_query($this->db_connect, $sql);
            return $result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_all_published_manufacturer() {
        $sql = 'SELECT * FROM tbl_manufacturer WHERE publication_status = 1';
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function select_all_published_manufacturer_for_product() {
        $sql = 'SELECT * FROM tbl_manufacturer WHERE publication_status = 1 ORDER BY manufacturer_id DESC';
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result2 = mysqli_query($this->db_connect, $sql);
            return $query_result2;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    

    public function select_latest_product_info() {
        $sql = 'SELECT * FROM tbl_product WHERE publication_status = 1 ORDER BY product_id DESC ';
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function select_manufacturer_info() {
        $sql = 'SELECT * FROM tbl_manufacturer WHERE publication_status = 1 ORDER BY manufacturer_id DESC ';
        if (mysqli_query($this->db_connect, $sql)) {
            $result = mysqli_query($this->db_connect, $sql);
            return $result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function update_customer_profile_info($data) {
        $sql = "UPDATE tbl_customer SET first_name='$data[first_name]',last_name='$data[last_name]', email_address='$data[email_address]', phone_number='$data[phone_number]',address='$data[address]',city='$data[city]',district='$data[district]' WHERE customer_id='$_SESSION[customer_id]' ";
        if (mysqli_query($this->db_connect, $sql)) {
            
            $message= 'Your Profile Update Successfully';
            return $message;
            header('Location: profile.php');
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function select_latest_product_info_for_product_details() {
        $sql = 'SELECT * FROM tbl_product WHERE publication_status = 1 ORDER BY product_id DESC ';
        if (mysqli_query($this->db_connect, $sql)) {
            $result = mysqli_query($this->db_connect, $sql);
            return $result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_product_info_by_id($product_id) {
        $sql = "SELECT p.*, c.category_name, m.manufacturer_name FROM tbl_product as p, tbl_category as c, tbl_manufacturer as m WHERE p.category_id=c.category_id AND p.manufacturer_id=m.manufacturer_id AND product_id='$product_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function add_to_cart($data) {
        if ($data['product_quantity'] > 0) {

            $product_id = $data['product_id'];
            $sql = "SELECT stock_amount FROM tbl_product WHERE product_id='$product_id' ";
            $query_result = mysqli_query($this->db_connect, $sql);
            $result = mysqli_fetch_assoc($query_result);
            if ($data['product_quantity'] > $result['stock_amount']) {
                $message = "Sorry, This Product no more available in stock";
                return $message;
            } else {

                $product_id = $data['product_id'];
                $sql = "SELECT product_name, product_price, product_image FROM tbl_product WHERE product_id='$product_id' ";
                $query_result = mysqli_query($this->db_connect, $sql);
                $product_info = mysqli_fetch_assoc($query_result);
//        session_start();
                $session_id = session_id();
                $sql = "SELECT t.product_id, t.session_id FROM tbl_temp_cart as t WHERE product_id='$product_id' AND session_id='$session_id' ";
                $query_result = mysqli_query($this->db_connect, $sql);
                $result = mysqli_fetch_assoc($query_result);
                if ($data['product_id'] = $result['product_id']) {
                    $message = "Sorry, This Product Already Added in cart, You Can Update it in Cart";
                    return $message;
                } else {
                    $sql = "INSERT INTO tbl_temp_cart (session_id, product_id, product_name, product_price, product_quantity, product_image) VALUES ('$session_id', '$product_id', '$product_info[product_name]', '$product_info[product_price]', '$data[product_quantity]', '$product_info[product_image]')";
                    mysqli_query($this->db_connect, $sql);
                    header('Location: cart.php');
                }
            }
        } else {
            $message = 'Sorry,This is Abnormal data';
            return $message;
        }
    }

    public function select_cart_product_by_session_id($session_id) {
        $sql = "SELECT * FROM tbl_temp_cart WHERE session_id='$session_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }


    public function select_cart_product_by_temp_cart_id($session_id) {
//        $sql="SELECT temp_cart_id,session_id,product_id,product_price,product_quantity, sum(product_price+product_price,product_quantity+product_quantity) AS total FROM tbl_temp_cart WHERE session_id='$session_id' AND  ";
        $sql = "SELECT *,sum(product_quantity),sum(product_price),sum(product_price*product_quantity) FROM tbl_temp_cart WHERE session_id='$session_id'";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function select_cart_product_by_temp_cart_id_for_cart_page($session_id) {
//        $sql="SELECT temp_cart_id,session_id,product_id,product_price,product_quantity, sum(product_price+product_price,product_quantity+product_quantity) AS total FROM tbl_temp_cart WHERE session_id='$session_id' AND  ";
        $sql = "SELECT *,sum(product_quantity),sum(product_price) FROM tbl_temp_cart WHERE session_id='$session_id'";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result2 = mysqli_query($this->db_connect, $sql);
            return $query_result2;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_cart_product_by_temp_cart_id_for_payment_page($session_id) {
        $sql = "SELECT * FROM tbl_temp_cart WHERE session_id='$session_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $result = mysqli_query($this->db_connect, $sql);
            return $result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
   
    public function select_order_table(){
        $sql = "SELECT * FROM tbl_order ORDER BY order_id DESC LIMIT 1";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function select_order_details_table(){
        $sql = "SELECT * FROM tbl_order_details ORDER BY order_details_id DESC LIMIT 1 ";
        if (mysqli_query($this->db_connect, $sql)) {
            $result = mysqli_query($this->db_connect, $sql);
            return $result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_from_bkash() {
        $sql = "SELECT * FROM bkash_transaction WHERE used='0' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function save_bkash($data) {
        $transaction_id = $data['transaction_id'];
        $sql = "SELECT * FROM bkash_transaction WHERE used='1'";
        $query_result = mysqli_query($this->db_connect, $sql);
        while ($info = mysqli_fetch_assoc($query_result)) {
            if ($transaction_id == $info['transaction_id']) {
                $message='Sorry,this Transaction ID is already used';
                return $message;
                }
        }
        $sql = "SELECT * FROM bkash_transaction WHERE used='0'";
        $query_result = mysqli_query($this->db_connect, $sql);
        while ($info = mysqli_fetch_assoc($query_result)) {
            if ($transaction_id == $info['transaction_id'] && $_SESSION['order_total'] == $info['total_amount']) {
                $sql = "UPDATE bkash_transaction SET used=1 WHERE id ='$info[id]'";
                mysqli_query($this->db_connect, $sql);
                header('Location: customer_home.php');
                $payment_type = $data['btn'];
                if ($payment_type == 'Confirm bKash Payment') {

                    session_start();
                    $customer_id = $_SESSION['customer_id'];
                    $product_id = $_SESSION['product_id'];
                    $shipping_id = $_SESSION['shipping_id'];
                    $order_total = $_SESSION['order_total'];
                    $sql = "INSERT INTO tbl_order (customer_id, shipping_id, order_total) VALUES ('$customer_id', '$shipping_id', '$order_total')";
                    if (mysqli_query($this->db_connect, $sql)) {
                        $order_id = mysqli_insert_id($this->db_connect);
                        $sql = "INSERT INTO tbl_payment (order_id, payment_type) VALUES ('$order_id', '$payment_type')";
                        if (mysqli_query($this->db_connect, $sql)) {
                            $session_id = session_id();
                            $sql = "SELECT * FROM tbl_temp_cart WHERE session_id='$session_id' ";
                            $query_result = mysqli_query($this->db_connect, $sql);
                            while ($product_info = mysqli_fetch_assoc($query_result)) {
                                $sql = "INSERT INTO tbl_order_details (order_id, product_id, product_name, product_price, product_quantity, product_image) VALUES ('$order_id', '$product_info[product_id]', '$product_info[product_name]', '$product_info[product_price]', '$product_info[product_quantity]', '$product_info[product_image]')";
                                mysqli_query($this->db_connect, $sql);
                            }

                            $sql = "SELECT * FROM tbl_temp_cart WHERE session_id='$session_id'";
                            $query_result = mysqli_query($this->db_connect, $sql);
                            while ($info = mysqli_fetch_assoc($query_result)) {
                                $sql = "UPDATE tbl_product SET stock_amount=stock_amount-'$info[product_quantity]'  WHERE product_id ='$info[product_id]'";
                                mysqli_query($this->db_connect, $sql);
                            }

//                  

                            $sql = "DELETE FROM tbl_temp_cart WHERE session_id='$session_id' ";
                            mysqli_query($this->db_connect, $sql);
                            unset($_SESSION['order_total']);
                        }
                    } else {
                        die('Query problem' . mysqli_error($this->db_connect));
                    }
                } else {
                    die('Query problem' . mysqli_error($this->db_connect));
                }
            }else{$message='Please Provide Valid Transaction ID';
            return $message;}
        }
    }
    public function save_cash_on_delivery($data) {
                $payment_type = $data['btn'];
                if ($payment_type == 'Confirm Cash on Delivery Payment') {

                    session_start();
                    $customer_id = $_SESSION['customer_id'];
                    $product_id = $_SESSION['product_id'];
                    $shipping_id = $_SESSION['shipping_id'];
                    $order_total = $_SESSION['order_total'];
                    $sql = "INSERT INTO tbl_order (customer_id, shipping_id, order_total) VALUES ('$customer_id', '$shipping_id', '$order_total')";
                    if (mysqli_query($this->db_connect, $sql)) {
                        $order_id = mysqli_insert_id($this->db_connect);
                        $sql = "INSERT INTO tbl_payment (order_id, payment_type) VALUES ('$order_id', '$payment_type')";
                        if (mysqli_query($this->db_connect, $sql)) {
                            $session_id = session_id();
                            $sql = "SELECT * FROM tbl_temp_cart WHERE session_id='$session_id' ";
                            $query_result = mysqli_query($this->db_connect, $sql);
                            while ($product_info = mysqli_fetch_assoc($query_result)) {
                                $sql = "INSERT INTO tbl_order_details (order_id, product_id, product_name, product_price, product_quantity, product_image) VALUES ('$order_id', '$product_info[product_id]', '$product_info[product_name]', '$product_info[product_price]', '$product_info[product_quantity]', '$product_info[product_image]')";
                                mysqli_query($this->db_connect, $sql);
                            }

                            $sql = "SELECT * FROM tbl_temp_cart WHERE session_id='$session_id'";
                            $query_result = mysqli_query($this->db_connect, $sql);
                            while ($info = mysqli_fetch_assoc($query_result)) {
                                $sql = "UPDATE tbl_product SET stock_amount=stock_amount-'$info[product_quantity]'  WHERE product_id ='$info[product_id]'";
                                mysqli_query($this->db_connect, $sql);
                            }
                            $sql = "DELETE FROM tbl_temp_cart WHERE session_id='$session_id' ";
                            mysqli_query($this->db_connect, $sql);
                            unset($_SESSION['order_total']);
                            header('Location: customer_cash.php');
                        }
                    } else {
                        die('Query problem' . mysqli_error($this->db_connect));
                    }
                } else {
                    die('Query problem' . mysqli_error($this->db_connect));
                }
            
        
    }

    public function update_cart_product_info($data) {
        if ($data['product_quantity'] > 0) {

            $sql = "SELECT tbl_product.stock_amount,tbl_temp_cart.product_quantity,tbl_temp_cart.product_id,tbl_product.product_id FROM tbl_product INNER JOIN tbl_temp_cart ON tbl_product.product_id=tbl_temp_cart.product_id";
            $query_result = mysqli_query($this->db_connect, $sql);
            $product = mysqli_fetch_assoc($query_result);
            if ($data['product_quantity'] > $product['stock_amount']) {
                $message = 'Sorry, This Product no more available in stock';
                return $message;
            } else {

                $sql = "UPDATE tbl_temp_cart SET product_quantity='$data[product_quantity]' WHERE temp_cart_id='$data[temp_cart_id]' ";
                if (mysqli_query($this->db_connect, $sql)) {

                    $message = "Cart product info update successfully";
                    return $message;
                } else {
                    die('Query problem' . mysqli_error($this->db_connect));
                }
            }
        } else {

            $message = 'Sorry,This is Abnormal data';
            return $message;
        }
    }

    public function delete_cart_product_info_by_id($cart_product_id) {
        $sql = "DELETE FROM tbl_temp_cart WHERE temp_cart_id='$cart_product_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = "Cart product info delete successfully";
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_published_product_info_by_category_id($category_id) {
        $sql = "SELECT * FROM tbl_product WHERE category_id='$category_id' AND publication_status=1 ORDER BY product_id DESC";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function select_published_product_info_by_manufacturer_id($manufacturer_id){
        $sql = "SELECT * FROM tbl_product WHERE manufacturer_id='$manufacturer_id' AND publication_status=1 ORDER BY product_id DESC";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function save_customer_info($data) {
        $password = md5($data['password']);
        $sql = "INSERT INTO tbl_customer (first_name, last_name, email_address, password, phone_number, blood_group, address, city, district,activation_status) VALUES ('$data[first_name]', '$data[last_name]', '$data[email_address]' ,'$password', '$data[phone_number]', '$data[blood_group]', '$data[address]', '$data[city]', '$data[district]', '1')";

        if (mysqli_query($this->db_connect, $sql)) {
            $customer_id = mysqli_insert_id($this->db_connect);
            //session_start();
            $_SESSION['customer_id'] = $customer_id;
            $_SESSION['customer_name'] = $data['first_name'] . ' ' . $data['last_name'];
            /* Email varification start */
            $to = $data['email_address'];
            $subject = "Customer email verification";
            $en_customer_id = base64_encode($customer_id);
            header('Location: cart.php');
            $message = "
                <span>Dear $data[last_name]. Thanks for join our community.</span> <br/>
                <span>Your login information goes here.</span> <br/>
                <span>Email Address: </span> $data[email_address]<br/>
                <span>Password: </span> $data[password]<br/>
                <span>To activate your account click on bellow</span><br/>
                <a href='http://localhost/Ecommerce/Fast_Shopping/update_customer_status.php?id=$en_customer_id'>http://localhost/Ecommerce/Fast_Shopping/update_customer_status.php?id=$en_customer_id</a>    
                    ";
            $headers = 'Form: info@Fast_Shopping.com';
            mail($to, $subject, $message, $headers);
            echo $message;
            exit();

            /* Email varification end */
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_customer_info($data) {
        $email_address = $data['email_address'];
        $password = md5($data['password']);
        $sql = "SELECT * FROM tbl_customer WHERE email_address='$email_address' AND password='$password' ";
        if (mysqli_query($this->db_connect, $sql)) {

            $customer_id = mysqli_insert_id($this->db_connect);
            //session_start();
            $_SESSION['customer_id'] = $customer_id;

            echo $message;
            exit();
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

//            $customer_info=mysqli_fetch_assoc($query_result);
//    }else{
//        $message="Your email address or password invalid";
//                return $message;
//    }
//    }

    public function update_customer_status($customer_id) {
        $sql = "UPDATE tbl_customer SET activation_status=1 WHERE customer_id='$customer_id' ";
        if (mysqli_query($this->db_connect, $sql)) {

            header('Location: shipping.php');
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_customer_info_by_id($customer_id) {
        $sql = "SELECT * FROM tbl_customer WHERE customer_id='$customer_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function save_customer_message($data) {
        $sql = "INSERT INTO tbl_msg (name,email,subject,message) VALUES ('$data[name]','$data[email]','$data[subject]','$data[message]')";
        if (mysqli_query($this->db_connect, $sql)) {
            $message='Your Info posted successfully,We will reply to your Email';
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function save_shipping_info($data) {
        $sql = "INSERT INTO tbl_shipping (full_name, email_address, phone_number, address, city, district) VALUES ('$data[full_name]', '$data[email_address]', '$data[phone_number]', '$data[address]', '$data[city]', '$data[district]')";
        if (mysqli_query($this->db_connect, $sql)) {
            $shipping_id = mysqli_insert_id($this->db_connect);
            session_start();
            $_SESSION['shipping_id'] = $shipping_id;

            header('Location: payment.php');
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function save_order_info($data) {
        $payment_type = $data['payment_type'];
        if ($payment_type == NULL) {
            echo 'Sorry, No Payment Method is Selected';
            header('Location: payment.php');
        }
        $payment_type = $data['payment_type'];
        if ($payment_type == 'cash_on_delivery') {
            session_start();
            $customer_id = $_SESSION['customer_id'];
            $product_id = $_SESSION['product_id'];
            $shipping_id = $_SESSION['shipping_id'];
            $order_total = $_SESSION['order_total'];
            $sql = "INSERT INTO tbl_order (customer_id, shipping_id, order_total) VALUES ('$customer_id', '$shipping_id', '$order_total')";
            if (mysqli_query($this->db_connect, $sql)) {
                $order_id = mysqli_insert_id($this->db_connect);
                $sql = "INSERT INTO tbl_payment (order_id, payment_type) VALUES ('$order_id', '$payment_type')";
                if (mysqli_query($this->db_connect, $sql)) {
                    $session_id = session_id();
                    $sql = "SELECT * FROM tbl_temp_cart WHERE session_id='$session_id' ";
                    $query_result = mysqli_query($this->db_connect, $sql);
                    while ($product_info = mysqli_fetch_assoc($query_result)) {
                        $sql = "INSERT INTO tbl_order_details (order_id, product_id, product_name, product_price, product_quantity, product_image) VALUES ('$order_id', '$product_info[product_id]', '$product_info[product_name]', '$product_info[product_price]', '$product_info[product_quantity]', '$product_info[product_image]')";
                        mysqli_query($this->db_connect, $sql);
                    }

                    $sql = "SELECT * FROM tbl_temp_cart WHERE session_id='$session_id'";
                    $query_result = mysqli_query($this->db_connect, $sql);
                    while ($info = mysqli_fetch_assoc($query_result)) {
                        $sql = "UPDATE tbl_product SET stock_amount=stock_amount-'$info[product_quantity]'  WHERE product_id ='$info[product_id]'";
                        mysqli_query($this->db_connect, $sql);
                    }

//                    $sql="SELECT * FROM product_stock WHERE session_id='$session_id' ";
//                    $query_result=mysqli_query($this->db_connect, $sql);
//                    while ($stock=  mysqli_fetch_assoc($query_result)) {
//                    $sql="UPDATE product_stock SET product_stock_quantity=product_stock_quantity-'$stock[product_quantity]'  WHERE product_id ='$stock[product_id]'";
//                    mysqli_query($this->db_connect, $sql);
//                    }
//                    

                    $sql = "DELETE FROM tbl_temp_cart WHERE session_id='$session_id' ";
                    mysqli_query($this->db_connect, $sql);
                    unset($_SESSION['order_total']);

                    header('Location: customer_home.php');
                } else {
                    die('Query problem' . mysqli_error($this->db_connect));
                }
            } else {
                die('Query problem' . mysqli_error($this->db_connect));
            }
        }
        $payment_type = $data['payment_type'];
        if ($payment_type == 'paypal') {
            session_start();
            $customer_id = $_SESSION['customer_id'];
            $product_id = $_SESSION['product_id'];
            $shipping_id = $_SESSION['shipping_id'];
            $order_total = $_SESSION['order_total'];
            $sql = "INSERT INTO tbl_order (customer_id, shipping_id, order_total) VALUES ('$customer_id', '$shipping_id', '$order_total')";
            if (mysqli_query($this->db_connect, $sql)) {
                $order_id = mysqli_insert_id($this->db_connect);
                $sql = "INSERT INTO tbl_payment (order_id, payment_type) VALUES ('$order_id', '$payment_type')";
                if (mysqli_query($this->db_connect, $sql)) {
                    $session_id = session_id();
                    $sql = "SELECT * FROM tbl_temp_cart WHERE session_id='$session_id' ";
                    $query_result = mysqli_query($this->db_connect, $sql);
                    while ($product_info = mysqli_fetch_assoc($query_result)) {
                        $sql = "INSERT INTO tbl_order_details (order_id, product_id, product_name, product_price, product_quantity, product_image) VALUES ('$order_id', '$product_info[product_id]', '$product_info[product_name]', '$product_info[product_price]', '$product_info[product_quantity]', '$product_info[product_image]')";
                        mysqli_query($this->db_connect, $sql);
                    }

                    $sql = "SELECT * FROM tbl_temp_cart WHERE session_id='$session_id'";
                    $query_result = mysqli_query($this->db_connect, $sql);
                    while ($info = mysqli_fetch_assoc($query_result)) {
                        $sql = "UPDATE tbl_product SET stock_amount=stock_amount-'$info[product_quantity]'  WHERE product_id ='$info[product_id]'";
                        mysqli_query($this->db_connect, $sql);
                    }

//                    $sql="SELECT * FROM product_stock WHERE session_id='$session_id' ";
//                    $query_result=mysqli_query($this->db_connect, $sql);
//                    while ($stock=  mysqli_fetch_assoc($query_result)) {
//                    $sql="UPDATE product_stock SET product_stock_quantity=product_stock_quantity-'$stock[product_quantity]'  WHERE product_id ='$stock[product_id]'";
//                    mysqli_query($this->db_connect, $sql);
//                    }
//                    

                    $sql = "DELETE FROM tbl_temp_cart WHERE session_id='$session_id' ";
                    mysqli_query($this->db_connect, $sql);
                    unset($_SESSION['order_total']);

                    header('Location: customer_home.php');
                } else {
                    die('Query problem' . mysqli_error($this->db_connect));
                }
            } else {
                die('Query problem' . mysqli_error($this->db_connect));
            }
        }
        $payment_type = $data['payment_type'];
        if ($payment_type == 'bkash') {

            session_start();
            $customer_id = $_SESSION['customer_id'];
            $product_id = $_SESSION['product_id'];
            $shipping_id = $_SESSION['shipping_id'];
            $order_total = $_SESSION['order_total'];
            $sql = "INSERT INTO tbl_order (customer_id, shipping_id, order_total) VALUES ('$customer_id', '$shipping_id', '$order_total')";
            if (mysqli_query($this->db_connect, $sql)) {
                $order_id = mysqli_insert_id($this->db_connect);
                $sql = "INSERT INTO tbl_payment (order_id, payment_type) VALUES ('$order_id', '$payment_type')";
                if (mysqli_query($this->db_connect, $sql)) {
                    $session_id = session_id();
                    $sql = "SELECT * FROM tbl_temp_cart WHERE session_id='$session_id' ";
                    $query_result = mysqli_query($this->db_connect, $sql);
                    while ($product_info = mysqli_fetch_assoc($query_result)) {
                        $sql = "INSERT INTO tbl_order_details (order_id, product_id, product_name, product_price, product_quantity, product_image) VALUES ('$order_id', '$product_info[product_id]', '$product_info[product_name]', '$product_info[product_price]', '$product_info[product_quantity]', '$product_info[product_image]')";
                        mysqli_query($this->db_connect, $sql);
                    }

                    $sql = "SELECT * FROM tbl_temp_cart WHERE session_id='$session_id'";
                    $query_result = mysqli_query($this->db_connect, $sql);
                    while ($info = mysqli_fetch_assoc($query_result)) {
                        $sql = "UPDATE tbl_product SET stock_amount=stock_amount-'$info[product_quantity]'  WHERE product_id ='$info[product_id]'";
                        mysqli_query($this->db_connect, $sql);
                    }

//                    $sql="SELECT * FROM product_stock WHERE session_id='$session_id' ";
//                    $query_result=mysqli_query($this->db_connect, $sql);
//                    while ($stock=  mysqli_fetch_assoc($query_result)) {
//                    $sql="UPDATE product_stock SET product_stock_quantity=product_stock_quantity-'$stock[product_quantity]'  WHERE product_id ='$stock[product_id]'";
//                    mysqli_query($this->db_connect, $sql);
//                    }
//                    

                    $sql = "DELETE FROM tbl_temp_cart WHERE session_id='$session_id' ";
                    mysqli_query($this->db_connect, $sql);
                    unset($_SESSION['order_total']);

                    header('Location: customer_home.php');
                } else {
                    die('Query problem' . mysqli_error($this->db_connect));
                }
            } else {
                die('Query problem' . mysqli_error($this->db_connect));
            }
        }
    }

    public function customer_email_check($email_address) {
        $sql = "SELECT * FROM tbl_customer WHERE email_address='$email_address' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function select_customer_info_for_profile($customer_id){
        $sql = "SELECT * FROM tbl_customer WHERE customer_id='$customer_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function customer_logout() {
        unset($_SESSION[customer_id]);
        unset($_SESSION[customer_name]);
        unset($_SESSION[shipping_id]);

        header('Location: index.php');
    }

}
