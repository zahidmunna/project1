<?php
if (isset($_GET['status'])) {
    $bkash_id = $_GET['id'];
     if ($_GET['status'] == 'delete') {
        $message = $ob_sup_admin->delete_bkash_by_id($bkash_id);
    }
}
$query_result = $ob_sup_admin->select_all_bkash_info();
?>
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>View Bkash Form</h2>
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
                        <th>ID</th>
                        <th>Customer ID</th>
                        <th>Transaction ID</th>
                        <th>Total Amount</th>
                        <th>Used</th>

                    </tr>
                </thead>   
                <tbody>
                    <?php while ($bkash_info = mysqli_fetch_assoc($query_result)) { ?>
                        <tr>
                            <td><?php echo $bkash_info['id']; ?></td>
                            <td><?php echo $bkash_info['customer_id']; ?></td>
                            <td><?php echo $bkash_info['transaction_id']; ?></td>
                            <td><?php echo $bkash_info['total_amount']; ?></td>
                            <td><?php echo $bkash_info['used']; ?></td>

                            <?php if ($_SESSION['access_level'] == 1) { ?>



                                <td class="center">
                                    <a class="btn btn-info" href="edit_bkash.php?id=<?php echo $bkash_info['id']; ?>" title="Edit">
                                        <i class="halflings-icon white edit"></i>  
                                    </a>
                                    <a class="btn btn-danger" href="?status=delete&&id=<?php echo $bkash_info['customer_id']; ?>" title="Delete" onclick="return check_delete();">
                                        <i class="halflings-icon white trash"></i> 
                                    </a>

                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>            
        </div>
    </div><!--/span-->
</div>