<?php
$admin_id = $_GET['id'];
$query_result = $ob_sup_admin->select_admin_info_by_id($admin_id);
$admin_info = mysqli_fetch_assoc($query_result);


if (isset($_POST['btn'])) {
    $message = $ob_sup_admin->update_admin_info($_POST);
}
?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Admin Form</h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
            </div>
        </div>
        <h2 style="color: green; "><?php if (isset($message)) {
    echo $message;
} ?></h2>
        <div class="box-content">
            <form name="edit_admin_form" class="form-horizontal" action="" method="post">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Admin Name </label>
                        <div class="controls">
                            <input type="text" value="<?php echo $admin_info['admin_name']; ?>" name="admin_name" class="span6 typeahead" id="typeahead"> 
                            <input type="hidden" value="<?php echo $admin_info['admin_id']; ?>" name="admin_id" class="span6 typeahead" id="typeahead"> 
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Email Address</label>
                        <div class="controls">
                            <input type="text" value="<?php echo $admin_info['email_address']; ?>" name="email_address" class="span6 typeahead" id="typeahead">

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Password</label>
                        <div class="controls">
                            <input type="password" value="<?php echo $admin_info['password']; ?>" name="password" class="span6 typeahead" id="typeahead">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="selectError3">Access Level</label>
                        <div class="controls">
                            <select id="selectError3" name="access_level">
                                <option>---Select Access Level---</option>
                                <option value="1">Admin</option>
                                <option value="2">Guest Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="selectError3">Publication Status </label>
                        <div class="controls">
                            <select id="selectError3" name="publication_status">
                                <option>---Select Publication Status---</option>
                                <option value="1">Published</option>
                                <option value="0">Unpublished</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="btn" class="btn btn-primary">Update Category Info</button>
                        <button type="reset" class="btn">Reset</button>
                    </div>
                </fieldset>
            </form>   
        </div>
    </div><!--/span-->
</div><!--/row-->
<script>
    document.forms['edit_admin_form'].elements['publication_status'].value = '<?php echo $admin_info['publication_status']; ?>';
    document.forms['edit_admin_form'].elements['access_level'].value = '<?php echo $admin_info['access_level']; ?>';
</script>
