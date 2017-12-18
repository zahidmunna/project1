<?php
if (isset($_POST['btn'])) {
    $message = $ob_sup_admin->save_bkash_info($_POST);
}
?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Bkash Form</h2>
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
            <form class="form-horizontal" action="" method="post">
                <fieldset>
<?php if ($_SESSION['access_level'] == 1) { ?>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Customer ID </label>
                            <div class="controls">
                                <input type="number" name="customer_id" class="span6 typeahead" id="typeahead" required=""> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Transaction ID </label>
                            <div class="controls">
                                <input type="text" name="transaction_id" class="span6 typeahead" id="typeahead" required=""> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Total Amount </label>
                            <div class="controls">
                                <input type="number" name="total_amount" class="span6 typeahead" id="typeahead" required=""> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="signup"></label>
                            <div class="col-md-8">
                                <button type="submit" id="btn" name="btn" class="btn btn-primary">Save Bkash</button>
                            </div>
                        </div>
<?php } ?>
                </fieldset>
            </form>   
        </div>
    </div><!--/span-->
</div><!--/row-->

