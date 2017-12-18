<?php
if (isset($_GET['status'])) {
$product_id = $_GET['id'];
if ($_GET['status'] == 'delete') {
        $message = $ob_sup_admin->delete_message_by_id($product_id);
    }
}
$query_result = $ob_sup_admin->select_all_message_info();
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
            <h2><i class="halflings-icon user"></i><span class="break"></span>Message</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <h2 style="color: green"><?php if (isset($message)) {
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Actions</th>
                        


                    </tr>
                </thead>   
                <tbody>
<?php while ($message_info = mysqli_fetch_assoc($query_result)) { ?>

                                    <tr>

                                        <td><?php echo $message_info['id']; ?></td>
                                       
                                        <td><?php echo $message_info['name']; ?></td>
                                        
                                        <td><?php echo $message_info['email']; ?></td>
                                        <td><?php echo $message_info['subject']; ?></td>
                                        <td><strong><h1><?php echo $message_info['message']; ?></strong></h1></td>
                                        <td><a class="btn btn-info" href="edit_message.php?id=<?php echo $message_info['id']; ?>" title="View">
                                        <i class="halflings-icon white edit"></i>  
                                        </a>
                                            <?php if ($_SESSION['access_level'] == 1) { ?>
                                            <a class="btn btn-danger" href="?status=delete&&id=<?php echo $message_info['id']; ?>" title="Delete" onclick="return check_delete();">
                                    <i class="halflings-icon white trash"></i> 
                                </a>
                                            <?php }?>
                                        </td>

                                    </tr>

<?php } ?>

                </tbody>

            </table>            
            
        </div>
    </div><!--/span-->
</div>