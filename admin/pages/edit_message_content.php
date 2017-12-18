<?php
$message_id = $_GET['id'];
$query_result = $ob_sup_admin->select_all_from_message($message_id);

?>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Message Form</h2>
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
            <form name="edit_message_form" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <fieldset>
                    <div class="control-group">
                        <?php while ($message_info = mysqli_fetch_assoc($query_result)) { ?>
                        <label class="control-label" for="typeahead">Message</label>
                        <div class="controls">
                            <textarea class="form-control" name="message"><?php echo $message_info['message']; ?></textarea> 
                        </div>
                    </div>
                        <?php }?>
                    
<!--                    <div class="form-actions">
                        <button type="submit" name="btn" class="btn btn-primary">Reply</button>
                        <button type="reset" class="btn">Reset</button>
                    </div>-->
                </fieldset>
            </form>   
        </div>
    </div><!--/span-->
</div><!--/row-->
<script>
    document.forms['edit_product_form'].elements['publication_status'].value = '<?php echo $product_info['publication_status']; ?>';
    document.forms['edit_product_form'].elements['category_id'].value = '<?php echo $product_info['category_id']; ?>';
    document.forms['edit_product_form'].elements['manufacturer_id'].value = '<?php echo $product_info['manufacturer_id']; ?>';
</script>
