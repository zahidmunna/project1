<?php

$email_address = $_GET['email'];
require './classes/super_admin.php';
$ob_sup_admin = new Super_admin();
$query_result = $ob_sup_admin->admin_email_check($email_address);
$admin_info = mysqli_fetch_assoc($query_result);
if ($admin_info) {
    echo 'Email Already Exists';
} else {
    echo 'Available';
}

