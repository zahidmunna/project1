<?php
$query_result = $ob_sup_admin->select_all_order_info();
?>
<?php
if (isset($_GET['status'])) {
    $order_id = $_GET['id'];
     if ($_GET['status'] == 'delete') {
        $message = $ob_sup_admin->delete_order_by_id($order_id);
    }
}
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
            <h2><i class="halflings-icon user"></i><span class="break"></span>Manage Order Form</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <h2><?php if (isset($message)) {
    echo $message;
    unset($message);
} ?></h2>
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
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Order Total</th>
                        <th>Order Status</th>
                        <th>Payment Type</th>
                        <th>Payment Status</th>
                        <th>Payment Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>   
                <tbody>
<?php while ($order_info = mysqli_fetch_assoc($query_result)) { ?>
                        <tr>
                            <td><?php echo $order_info['order_id']; ?></td>
                            <td class="center"><?php echo $order_info['first_name'] . ' ' . $order_info['last_name']; ?></td>
                            <td class="center"><?php echo $order_info['order_total']; ?></td>
                            <td class="center"><?php echo $order_info['order_status']; ?></td>
                            <td class="center"><?php echo $order_info['payment_type']; ?></td>
                            <td class="center"><?php echo $order_info['payment_status']; ?></td>
                            <td class="center"><?php echo $order_info['payment_date']; ?></td>
                            <td class="center">
                                <a class="btn btn-primary" href="view_order.php?id=<?php echo $order_info['order_id']; ?>" title="View Order">
                                    <i class="halflings-icon white zoom-in"></i>  
                                </a>
                                
                                <a class="btn btn-success" href="database.php?id=<?php echo $order_info['order_id']; ?>" title="Download Invoice">
                                    <i class="halflings-icon white download"></i>  
                                </a>
                                <?php if ($_SESSION['access_level'] == 1) { ?>
                                    <a class="btn btn-info" href="manage_order.php?id=<?php echo $order_info['order_id']; ?>" title="Edit Order">
                                        <i class="halflings-icon white edit"></i>  
                                    </a>
                                    <a class="btn btn-danger" href="?status=delete&&id=<?php echo $order_info['order_id']; ?>" title="Delete Order" onclick="return check_delete();">
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