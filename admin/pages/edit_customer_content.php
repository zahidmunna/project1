<?php
$customer_id = $_GET['id'];
$query_result = $ob_sup_admin->select_customer_info_by_id_for_edit($customer_id) ;
$customer_info = mysqli_fetch_assoc($query_result);

if (isset($_POST['btn'])) {
    $message = $ob_sup_admin->update_customer_profile_info_from_admin($_POST);
}
?>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Customer Form</h2>
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
            <form name="edit_customer_form" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Customer ID </label>
                        <div class="controls">
                            <input type="number" value="<?php echo $customer_info['customer_id']; ?>" name="customer_id" class="span6 typeahead" id="typeahead"> 
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">First Name </label>
                        <div class="controls">
                            <input type="text" value="<?php echo $customer_info['first_name']; ?>" name="first_name" class="span6 typeahead" id="typeahead"> 
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Last Name </label>
                        <div class="controls">
                            <input type="text" value="<?php echo $customer_info['last_name']; ?>" name="last_name" class="span6 typeahead" id="typeahead"> 
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="typeahead">Email Address</label>
                        <div class="controls">
                            <input type="text" value="<?php echo $customer_info['email_address']; ?>" name="email_address" class="span6 typeahead" id="typeahead">

                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Password</label>
                        <div class="controls">
                            <input type="password" value="<?php echo $customer_info['password']; ?>" name="password" class="span6 typeahead" id="typeahead">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Phone Number </label>
                        <div class="controls">
                            <input type="number" value="<?php echo $customer_info['phone_number']; ?>" name="phone_number" class="span6 typeahead" id="typeahead"> 
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Address </label>
                        <div class="controls">
                            <textarea class="form-control" name="address"><?php echo $customer_info['address']; ?></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">City </label>
                        <div class="controls">
                            <input type="text" value="<?php echo $customer_info['city']; ?>" name="city" class="span6 typeahead" id="typeahead"> 
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">District</label>
                        <div class="controls">
                            <input type="text" value="<?php echo $customer_info['district']; ?>" name="district" class="span6 typeahead" id="typeahead"> 
                        </div>
                    </div>
                    
                    
                    <div class="form-actions">
                        <button type="submit" name="btn" class="btn btn-primary">Update Customer Info</button>
                        <button type="reset" class="btn">Reset</button>
                    </div>
                </fieldset>
            </form>   
        </div>
        
    </div><!--/span-->
</div><!--/row-->
<script>
    document.forms['edit_customer_form'].elements['publication_status'].value = '<?php echo $customer_info['customer_id']; ?>';
    </script>

