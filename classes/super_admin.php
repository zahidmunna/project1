<?php

class Super_admin {

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

    public function admin_email_check($email_address) {
        $sql = "SELECT * FROM tbl_admin WHERE email_address='$email_address' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function save_admin_info($data) {
        $password = md5($data['password']);
        $sql = "INSERT INTO tbl_admin (admin_name, email_address, password,access_level,publication_status) VALUES ('$data[admin_name]', '$data[email_address]', '$password','$data[access_level]','$data[publication_status]' )";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = "Congratulation ! Admin info create successfully";
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function save_bkash_info($data) {

        $sql = "INSERT INTO bkash_transaction (customer_id,transaction_id, total_amount, used) VALUES ('$data[customer_id]','$data[transaction_id]', '$data[total_amount]', '0' )";
        if (mysqli_query($this->db_connect, $sql)) {
            header('Location: view_bkash.php');
            $message = "Congratulation ! Bkash info create successfully";
            return $message;
            
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function unpublished_admin_by_id($admin_id) {
        $sql = "UPDATE tbl_admin SET publication_status=0 WHERE admin_id='$admin_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = "Admin info unpublished successfully";
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function published_admin_by_id($admin_id) {
        $sql = "UPDATE tbl_admin SET publication_status=1 WHERE admin_id='$admin_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = "Admin info published successfully";
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function delete_admin_by_id($admin_id) {
        $sql = "DELETE FROM tbl_admin WHERE admin_id='$admin_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = 'Admin info delete successfully';
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function delete_bkash_by_id($bkash_id) {
        $sql = "DELETE FROM bkash_transaction WHERE customer_id='$bkash_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = 'Bkash info delete successfully';
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_all_admin_info() {
        $sql = "SELECT * FROM tbl_admin";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_all_bkash_info() {
        $sql = "SELECT * FROM bkash_transaction";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_admin_info_by_id($admin_id) {
        $sql = "SELECT * FROM tbl_admin WHERE admin_id='$admin_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_bkash_info_by_id($bkash_id) {
        $sql = "SELECT * FROM bkash_transaction WHERE id='$bkash_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function update_admin_info($data) {
        $password = md5($data['password']);
        $sql = "UPDATE tbl_admin SET admin_name='$data[admin_name]', email_address='$data[email_address]',password='$password',access_level='$data[access_level]', publication_status='$data[publication_status]' WHERE admin_id='$data[admin_id]' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $_SESSION['message'] = 'Admin info update successfully';
            header('Location: manage_admin.php');
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function update_bkash_info($data) {

        $sql = "UPDATE bkash_transaction SET customer_id='$data[customer_id]',transaction_id='$data[transaction_id]', total_amount='$data[total_amount]',used='$data[used]' WHERE id='$data[id]' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $_SESSION['message'] = 'Bkash info update successfully';
            header('Location: view_bkash.php');
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function save_category_info($data) {
        $sql = "INSERT INTO tbl_category (category_name, category_description, publication_status) VALUES ('$data[category_name]', '$data[category_description]', '$data[publication_status]' )";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = "Congratulation ! category info create successfully";
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_all_category_info() {
        $sql = "SELECT * FROM tbl_category";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function unpublished_category_by_id($category_id) {
        $sql = "UPDATE tbl_category SET publication_status=0 WHERE category_id='$category_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = "Category info unpublished successfully";
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function published_category_by_id($category_id) {
        $sql = "UPDATE tbl_category SET publication_status=1 WHERE category_id='$category_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = "Category info published successfully";
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_category_info_by_id($category_id) {
        $sql = "SELECT * FROM tbl_category WHERE category_id='$category_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function update_category_info($data) {
        $sql = "UPDATE tbl_category SET category_name='$data[category_name]', category_description='$data[category_description]', publication_status='$data[publication_status]' WHERE category_id='$data[category_id]' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $_SESSION['message'] = 'Category info update successfully';
            header('Location: manage_category.php');
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function delete_category_by_id($category_id) {
        $sql = "DELETE FROM tbl_category WHERE category_id='$category_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = 'Category info delete successfully';
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function save_manufacturer_info($data) {
        $sql = "INSERT INTO tbl_manufacturer (manufacturer_name, manufacturer_description, publication_status) VALUES ('$data[manufacturer_name]', '$data[manufacturer_description]', '$data[publication_status]' )";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = "Congratulation ! manufacturer info create successfully";
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_all_manufacturer_info() {
        $sql = "SELECT * FROM tbl_manufacturer";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function unpublished_manufacturer_by_id($manufacturer_id) {
        $sql = "UPDATE tbl_manufacturer SET publication_status=0 WHERE manufacturer_id='$manufacturer_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = "Manufacturer info unpublished successfully";
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function published_manufacturer_by_id($manufacturer_id) {
        $sql = "UPDATE tbl_manufacturer SET publication_status=1 WHERE manufacturer_id='$manufacturer_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = "Manufacturer info published successfully";
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_manufacturer_info_by_id($manufacturer_id) {
        $sql = "SELECT * FROM tbl_manufacturer WHERE manufacturer_id='$manufacturer_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function update_manufacturer_info($data) {
        $sql = "UPDATE tbl_manufacturer SET manufacturer_name='$data[manufacturer_name]', manufacturer_description='$data[manufacturer_description]', publication_status='$data[publication_status]' WHERE manufacturer_id='$data[manufacturer_id]' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $_SESSION['message'] = "Manufacturer info update successfully";
            header('Location: manage_manufacturer.php');
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function delete_manufacturer_by_id($manufacturer_id) {
        $sql = "DELETE FROM tbl_manufacturer WHERE manufacturer_id='$manufacturer_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = 'Manufacturer info delete successfully';
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function save_product_info($data) {

        $directory = '../assets/product_images/';
        $target_file = $directory . $_FILES['product_image']['name'];
        $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
        $file_size = $_FILES['product_image']['size'];
        $image = getimagesize($_FILES['product_image']['tmp_name']);
        if ($image) {
            if (file_exists($target_file)) {
                die('This image already exists');
            } else {
                if ($file_size > 5242880) {
                    die('File sise is too large');
                } else {
                    if ($file_type != 'jpg' && $file_type != 'JPG' && $file_type != 'png' && $file_type != 'PNG') {
                        die('File type is not valid');
                    } else {
                        $sql = "INSERT INTO tbl_product (product_name, category_id, manufacturer_id, product_price, stock_amount, minimum_stock_amount, product_short_description, product_long_description, product_image, publication_status) VALUES ('$data[product_name]', '$data[category_id]', '$data[manufacturer_id]', '$data[product_price]', '$data[stock_amount]', '$data[minimum_stock_amount]', '$data[product_short_description]', '$data[product_long_description]', '$target_file', '$data[publication_status]' )";

                        if (mysqli_query($this->db_connect, $sql)) {
//                        $product_id= mysqli_insert_id($this->db_connect);
//                    $result="INSERT INTO product_stock (product_id,product_stock_quantity) VALUES ('$product_id','$data[stock_amount]' )";
//                    mysqli_query($this->db_connect, $result );
//                    
                            move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file);
                            $message = "Product info save successfully";
                            return $message;
                        } else {
                            die('Query problem' . mysqli_error($this->db_connect));
                        }
                    }
                }
            }
        } else {
            die('This upload file not an image. Please use a image file');
        }
    }

    public function select_all_product_info() {
        $sql = "SELECT p.product_id, p.product_name, p.category_id, p.manufacturer_id, p.product_price, p.stock_amount,p.minimum_stock_amount, p.publication_status, c.category_name, m.manufacturer_name FROM tbl_product as p, tbl_category as c, tbl_manufacturer as m WHERE p.category_id=c.category_id AND p.manufacturer_id=m.manufacturer_id   ";
//      $sql="SELECT p.product_id, p.product_name, p.category_id, p.manufacturer_id, p.product_price, p.stock_amount, p.publication_status, c.category_name, m.manufacturer_name, o.product_quantity FROM tbl_product as p, tbl_category as c, tbl_manufacturer as m, tbl_order_details as o WHERE p.category_id=c.category_id AND p.manufacturer_id=m.manufacturer_id AND p.product_id=o.product_id   ";
//      include '../classes/application.php';
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_product_info_by_id($product_id) {
        $sql = "SELECT p.*, c.category_name, m.manufacturer_name FROM tbl_product as p, tbl_category as c, tbl_manufacturer as m WHERE p.category_id=c.category_id AND p.manufacturer_id=m.manufacturer_id AND p.product_id='$product_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function update_product_info($data) {
        $directory = '../assets/product_images/';
        $target_file = $directory . $_FILES['product_image']['name'];
        $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
        $file_size = $_FILES['product_image']['size'];
        $image = getimagesize($_FILES['product_image']['tmp_name']);
        if ($image) {
            if (file_exists($target_file)) {
                die('This image already exists');
            } else {
                if ($file_size > 5242880) {
                    die('File sise is too large');
                } else {
                    if ($file_type != 'jpg' && $file_type != 'JPG' && $file_type != 'png' && $file_type != 'PNG') {
                        die('File type is not valid');
                    } else {
                        $sql = "UPDATE tbl_product SET product_name='$data[product_name]',product_price='$data[product_price]', stock_amount='$data[stock_amount]',minimum_stock_amount='$data[minimum_stock_amount]',product_short_description='$data[product_short_description]',product_long_description='$data[product_long_description]',product_image='$target_file',publication_status='$data[publication_status]' WHERE product_id='$data[product_id]' ";
                        if (mysqli_query($this->db_connect, $sql)) {
                            move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file);
                            $_SESSION['message'] = 'Product info update successfully';
                            header('Location: manage_product.php');
                        } else {
                            die('Query problem' . mysqli_error($this->db_connect));
                        }
                    }
                }
            }
        } else {
            die('This upload file not an image. Please use a image file');
        }
    }

    public function unpublished_product_by_id($product_id) {
        $sql = "UPDATE tbl_product SET publication_status=0 WHERE product_id='$product_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = "Product info unpublished successfully";
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function published_product_by_id($product_id) {
        $sql = "UPDATE tbl_product SET publication_status=1 WHERE product_id='$product_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = "Product info published successfully";
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function delete_product_by_id($product_id) {
        $sql = "DELETE FROM tbl_product WHERE product_id='$product_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = 'Product info delete successfully';
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_all_order_info() {
        $sql = "SELECT o.*, c.first_name, c.last_name, p.payment_type, p.payment_status,p.payment_date FROM tbl_order as o, tbl_customer as c, tbl_payment as p WHERE o.customer_id=c.customer_id AND o.order_id=p.order_id";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function delete_order_by_id($order_id) {
        $sql = "DELETE FROM tbl_order WHERE order_id='$order_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = 'Order info delete successfully';
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_all_customer_info() {
        $sql = "SELECT * FROM tbl_customer";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function delete_customer_by_id_from_admin($customer_id) {
        $sql = "DELETE FROM tbl_customer WHERE customer_id='$customer_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = 'Customer info delete successfully';
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function select_all_customer_info_for_bkash_id() {
        $sql = "SELECT * FROM tbl_customer";
        if (mysqli_query($this->db_connect, $sql)) {
            $result = mysqli_query($this->db_connect, $sql);
            return $result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function select_customer_info_by_id_for_edit($customer_id) {
        $sql = "SELECT * FROM tbl_customer WHERE customer_id='$customer_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function update_customer_profile_info_from_admin($data) {
        $password = md5('$data[text]');
        $sql = "UPDATE tbl_customer SET first_name='$data[first_name]',last_name='$data[last_name]', email_address='$data[email_address]',password='$password', phone_number='$data[phone_number]',address='$data[address]',city='$data[city]',district='$data[district]' WHERE customer_id='$data[customer_id]' ";
        if (mysqli_query($this->db_connect, $sql)) {
            header('Location: customer.php');
            $message= 'Customer Profile Update Successfully';
            return $message;
            
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_all_recent_order_info() {
        $sql = "SELECT o.*, c.first_name, c.last_name, p.payment_type, p.payment_status,p.payment_date FROM tbl_order as o, tbl_customer as c, tbl_payment as p WHERE o.customer_id=c.customer_id AND o.order_id=p.order_id ORDER BY order_id DESC LIMIT 5";
        if (mysqli_query($this->db_connect, $sql)) {
            $result4 = mysqli_query($this->db_connect, $sql);
            return $result4;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_order_info_for_total_price() {
        $sql = "SELECT sum(order_total) FROM tbl_order";
        if (mysqli_query($this->db_connect, $sql)) {
            $result3 = mysqli_query($this->db_connect, $sql);
            return $result3;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_all_order_info_for_dash() {
        $sql = "SELECT count(order_id) as total FROM tbl_order";
        if (mysqli_query($this->db_connect, $sql)) {
            $result = mysqli_query($this->db_connect, $sql);
            return $result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_total_sales_for_dash() {
        $sql = "SELECT count(payment_id) as total FROM tbl_payment";
        if (mysqli_query($this->db_connect, $sql)) {
            $result2 = mysqli_query($this->db_connect, $sql);
            return $result2;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_all_customer_info_for_dash() {
        $sql = "SELECT *,count(customer_id) as total FROM tbl_customer";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_customer_info_by_order_id($order_id) {
        $sql = "SELECT o.order_id, o.customer_id, c.* FROM tbl_order as o, tbl_customer as c WHERE o.customer_id=c.customer_id AND o.order_id='$order_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function select_all_message_info() {
        $sql = "SELECT * FROM tbl_msg";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function select_all_from_message($message_info) {
        $sql = "SELECT * FROM tbl_msg WHERE id='$message_info'";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }
    public function delete_message_by_id($product_id) {
        $sql = "DELETE FROM tbl_msg WHERE id='$product_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $message = 'Message delete successfully';
            return $message;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_shipping_info_by_order_id($order_id) {
        $sql = "SELECT o.order_id, o.shipping_id, s.* FROM tbl_order as o, tbl_shipping as s WHERE o.shipping_id=s.shipping_id AND o.order_id='$order_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function select_payment_info_by_order_id($order_id) {
        $sql = "SELECT o.order_id,  p.* FROM tbl_order as o, tbl_payment as p WHERE o.order_id=p.order_id AND o.order_id='$order_id' ";
        if (mysqli_query($this->db_connect, $sql)) {
            $query_result = mysqli_query($this->db_connect, $sql);
            return $query_result;
        } else {
            die('Query problem' . mysqli_error($this->db_connect));
        }
    }

    public function logout() {
        unset($_SESSION['admin_name']);
        unset($_SESSION['admin_id']);

        header('Location: index.php');
    }

}
