<?php
$bkash_id = $_GET['id'];
$query_result = $ob_sup_admin->select_bkash_info_by_id($bkash_id);
$bkash_info = mysqli_fetch_assoc($query_result);


if (isset($_POST['btn'])) {
    $message = $ob_sup_admin->update_bkash_info($_POST);
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
            <form name="edit_bkash_form" class="form-horizontal" action="" method="post">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">ID</label>
                        <div class="controls">
                            <input type="number" value="<?php echo $bkash_info['id']; ?>" name="id" class="span6 typeahead" id="typeahead" required="">

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Customer ID </label>
                        <div class="controls">
                            <input type="number" value="<?php echo $bkash_info['customer_id']; ?>" name="customer_id" class="span6 typeahead" id="typeahead" required=""> 
                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Transaction ID </label>
                        <div class="controls">
                            
                            <input type="text" value="<?php echo $bkash_info['transaction_id']; ?>" name="transaction_id" class="span6 typeahead" id="typeahead" required=""> 
                            <input type="hidden" value="<?php echo $bkash_info['customer_id']; ?>" name="bkash_id" class="span6 typeahead" id="typeahead"> 
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Total Amount</label>
                        <div class="controls">
                            <input type="number" value="<?php echo $bkash_info['total_amount']; ?>" name="total_amount" class="span6 typeahead" id="typeahead" required="">

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Used</label>
                        <div class="controls">
                            <input type="text" value="<?php echo $bkash_info['used']; ?>" name="used" class="span6 typeahead" id="typeahead">
                        </div>
                    </div>


                    <div class="form-actions">
                        <button type="submit" name="btn" class="btn btn-primary">Update Bkash Info</button>
                        <button type="reset" class="btn">Reset</button>
                    </div>
                </fieldset>
            </form>   
        </div>
    </div><!--/span-->
</div><!--/row-->
<script>
    document.forms['edit_bkash_form'].elements['publication_status'].value = '<?php echo $bkash_info['publication_status']; ?>';
    document.forms['edit_bkash_form'].elements['access_level'].value = '<?php echo $bkash_info['access_level']; ?>';
</script>
