<?php
$query_result = $ob_sup_admin->select_all_customer_info_for_dash();
$result = $ob_sup_admin->select_all_order_info_for_dash();
$result2 = $ob_sup_admin->select_total_sales_for_dash();
$result4 = $ob_sup_admin->select_all_recent_order_info();
$result3 = $ob_sup_admin->select_order_info_for_total_price();
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
            <h2><i class="halflings-icon user"></i><span class="break"></span>Dashboard</h2>
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
                <caption><h1><strong>Information About Your Ecommerce Business</strong></h1></caption>
                <thead>
                    <tr>

                        <th>TOTAL ORDERS</th>
                        <th>VIEW ORDERS</th>
                        <th>TOTAL SALES</th>
                        <th>VIEW SALES</th>
                        <th>TOTAL CUSTOMERS</th>
                        <th>VIEW CUSTOMERS</th>


                    </tr>
                </thead>   
                <tbody>
<?php while ($order_info = mysqli_fetch_assoc($query_result)) { ?>
    <?php while ($info = mysqli_fetch_assoc($result)) { ?>
        <?php while ($info2 = mysqli_fetch_assoc($result2)) { ?>
            <?php while ($info3 = mysqli_fetch_assoc($result3)) { ?>

                                    <tr>

                                        <td><h1><strong><?php echo $info['total']; ?></strong></h1></td>
                                        <td class="center">
                                            <a class="btn btn-primary" href="manage_order.php?id=" title="View Orders">
                                                <i class="halflings-icon white zoom-in"></i>  
                                            </a>
                                        </td>
                                        <td><h1><strong><?php echo $info3['sum(order_total)']; ?></strong></h1></td>
                                        <td class="center">
                                            <a class="btn btn-primary" href="manage_order.php?id=" title="View Sales">
                                                <i class="halflings-icon white zoom-in"></i>  
                                            </a>
                                        </td>
                                        <td><h1><strong><?php echo $order_info['total']; ?></strong></h1></td>
                                        <td class="center">
                                            <a class="btn btn-primary" href="customer.php?id=" title="View Customers">
                                                <i class="halflings-icon white zoom-in"></i>  
                                            </a>
                                        </td>

                                    </tr>

            <?php } ?>
        <?php } ?>
    <?php } ?>
<?php } ?>

                </tbody>

            </table>            
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>


                        <th>LATEST ORDERS</th>

                    </tr>
                    <tr>

                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Order Status</th>
                        <th>Payment Date</th>
                        <th>Total</th>

                        <th>Payment Type</th>
                        <th>Actions</th>


                    </tr>
                </thead>   
                <tbody>

<?php while ($info4 = mysqli_fetch_assoc($result4)) { ?>

                        <tr>
                            <td><?php echo $info4['order_id']; ?></td>
                            <td class="center"><?php echo $info4['first_name'] . ' ' . $info4['last_name']; ?></td>
                            <td class="center"><?php echo $info4['order_status']; ?></td>
                            <td class="center"><?php echo $info4['payment_date']; ?></td>
                            <td class="center"><?php echo $info4['order_total']; ?></td>

                            <td class="center"><?php echo $info4['payment_type']; ?></td>
                            <td class="center">
                                <a class="btn btn-primary" href="view_order.php?id=<?php echo $info4['order_id']; ?>" title="View Order">
                                    <i class="halflings-icon white zoom-in"></i>  
                                </a>

                                <?php if ($_SESSION['access_level'] == 1) { ?>
                                    <a class="btn btn-info" href="manage_order.php?id=<?php echo $info4['order_id']; ?>" title="Edit Order">
                                        <i class="halflings-icon white edit"></i>  
                                    </a>
                                    <a class="btn btn-danger" href="?status=delete&&id=<?php echo $info4['order_id']; ?>" title="Delete Order" onclick="return check_delete();">
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