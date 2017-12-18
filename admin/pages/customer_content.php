<?php
if (isset($_GET['status'])) {
    $customer_id = $_GET['id'];
     if ($_GET['status'] == 'delete') {
        $message = $ob_sup_admin->delete_customer_by_id_from_admin($customer_id);
    }
}
$query_result = $ob_sup_admin->select_all_customer_info();
?>
<script>
    function check_delete() {
        var check = confirm('Are you sure to delete this');
        if (check) {
            return true;
        } else {
            return false;
        }
    }
</script>
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Customers Form</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <h2><?php
                if (isset($message)) {
                    echo $message;
                    unset($message);
                }
                ?></h2>
            <h2>
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
                ?>
            </h2>
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email Address</th>
                        <th>Password</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>District</th>
                        <?php if ($_SESSION['access_level'] == 1) { ?>
                        <th>Actions</th>
                        <?php }?>
                    </tr>
                </thead>   
                <tbody>
<?php while ($customer_info = mysqli_fetch_assoc($query_result)) { ?>
                        <tr>
                            <td><?php echo $customer_info['customer_id']; ?></td>
                            <td class="center"><?php echo $customer_info['first_name']; ?></td>
                            <td class="center"><?php echo $customer_info['last_name']; ?></td>
                            <td class="center"><?php echo $customer_info['email_address']; ?></td>
                            <td class="center"><?php echo $customer_info['password']; ?></td>
                            <td class="center"><?php echo $customer_info['phone_number']; ?></td>
                            
                            <td class="center"><?php echo $customer_info['address']; ?></td>
                            <td class="center"><?php echo $customer_info['city']; ?></td>
                            <td class="center"><?php echo $customer_info['district']; ?></td>
                            <td class="center">
                                
                                <?php if ($_SESSION['access_level'] == 1) { ?>
                                <a class="btn btn-info" href="edit_customer.php?id=<?php echo $customer_info['customer_id']; ?>" title="Edit Customer">
                                        <i class="halflings-icon white edit"></i>  
                                    </a>
                                    <a class="btn btn-danger" href="?status=delete&&id=<?php echo $customer_info['customer_id']; ?>" title="Delete Customer" onclick="return check_delete();">
                                        <i class="halflings-icon white trash"></i> 
                                    </a>
                                        <?php } ?>
                            </td>
                        </tr>
<?php } ?>
                </tbody>
            </table>            
        </div>
    </div><!--/span-->
</div>