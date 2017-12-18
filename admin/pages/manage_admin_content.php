<?php
if (isset($_GET['status'])) {
    $admin_id = $_GET['id'];
    if ($_GET['status'] == 'unpublished') {
        $message = $ob_sup_admin->unpublished_admin_by_id($admin_id);
    } else if ($_GET['status'] == 'published') {
        $message = $ob_sup_admin->published_admin_by_id($admin_id);
    } else if ($_GET['status'] == 'delete') {
        $message = $ob_sup_admin->delete_admin_by_id($admin_id);
    }
}





$query_result = $ob_sup_admin->select_all_admin_info();
?>
<div class="row-fluid sortable">		
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon user"></i><span class="break"></span>Manage Admin Form</h2>
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
                        <th>Admin ID</th>
                        <th>Admin Name</th>
                        <th>Email Address</th>
                        <?php if ($_SESSION['access_level'] == 1) { ?>
                        <th>Password</th>
                        <?php }?>
                        <th>Access Level</th>
                        <?php if ($_SESSION['access_level'] == 1) { ?>
                        <th>Publication Status</th>
                        <th>Actions</th>
                        <?php }?>
                    </tr>
                </thead>   
                <tbody>
<?php while ($admin_info = mysqli_fetch_assoc($query_result)) { ?>
                        <tr>
                            <td><?php echo $admin_info['admin_id']; ?></td>
                            <td><?php echo $admin_info['admin_name']; ?></td>
                            <td><?php echo $admin_info['email_address']; ?></td>
                            <?php if ($_SESSION['access_level'] == 1) { ?>
                            <td><?php echo $admin_info['password']; ?></td>
                            <?php }?>
                            <td><?php
                                if ($admin_info['access_level'] == 1) {
                                    echo 'Admin';
                                } else {
                                    echo 'Guest Admin';
                                }


                                ;
                                ?>
                            </td>
                                <?php if ($_SESSION['access_level'] == 1) { ?>
                                <td class="center">
                                    <?php
                                    if ($admin_info['publication_status'] == 1) {
                                        echo 'Published';
                                    } else {
                                        echo 'Unpublished';
                                    }
                                    ?>
                                </td>
        <?php if ($admin_info['publication_status'] == 1) { ?>
                                    <td class="center">


                                        <a class="btn btn-success" href="?status=unpublished&&id=<?php echo $admin_info['admin_id']; ?>" title="Unpublished">
                                            <i class="halflings-icon white arrow-down"></i>  
                                        </a>
        <?php } else { ?>
                                        <a class="btn btn-danger" href="?status=published&&id=<?php echo $admin_info['admin_id']; ?>" title="Published">
                                            <i class="halflings-icon white arrow-up"></i>  
                                        </a>
        <?php } ?>


                                    <a class="btn btn-info" href="edit_admin.php?id=<?php echo $admin_info['admin_id']; ?>" title="Edit">
                                        <i class="halflings-icon white edit"></i>  
                                    </a>
                                    <a class="btn btn-danger" href="?status=delete&&id=<?php echo $admin_info['admin_id']; ?>" title="Delete" onclick="return check_delete();">
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