<?php
$product_id = $_GET['id'];
$query_result = $ob_sup_admin->select_product_info_by_id($product_id);
$product_info = mysqli_fetch_assoc($query_result);


require '../classes/application.php';
$obj_app = new Application();
$category_query_result = $obj_app->select_all_published_category();
$category_info = mysqli_fetch_assoc($query_result);
//    
//    $category_id=$_GET['id'];
//    $query_result=$ob_sup_admin->select_category_info_by_id($category_id);
$manufacturer_query_result = $obj_app->select_all_published_manufacturer();
$manufacturer_info = mysqli_fetch_assoc($query_result);
if (isset($_POST['btn'])) {
    $message = $ob_sup_admin->update_product_info($_POST);
}
?>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Product Form</h2>
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
            <form name="edit_product_form" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Product ID </label>
                        <div class="controls">
                            <input type="text" value="<?php echo $product_info['product_id']; ?>" name="product_id" class="span6 typeahead" id="typeahead"> 
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Product Name </label>
                        <div class="controls">
                            <input type="text" value="<?php echo $product_info['product_name']; ?>" name="product_name" class="span6 typeahead" id="typeahead"> 
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="selectError3">Category Name</label>
                        <div class="controls">
                            <select id="selectError3" name="category_id">
                                <option>---Select Category Name---</option>
                                <?php while ($category_info = mysqli_fetch_assoc($category_query_result)) { ?>
                                    <option value="<?php echo $category_info['category_id']; ?>"><?php echo $category_info['category_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="selectError3">Manufacturer Name</label>
                        <div class="controls">
                            <select id="selectError3" name="manufacturer_id">
                                <option>---Select Manufacturer Name---</option>
                                <?php while ($manufacturer_info = mysqli_fetch_assoc($manufacturer_query_result)) { ?>
                                    <option value="<?php echo $manufacturer_info['manufacturer_id']; ?>"><?php echo $manufacturer_info['manufacturer_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Product Price </label>
                        <div class="controls">
                            <input type="number" value="<?php echo $product_info['product_price']; ?>" name="product_price" class="span6 typeahead" id="typeahead"> 
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Stock Amount</label>
                        <div class="controls">
                            <input type="number" value="<?php echo $product_info['stock_amount']; ?>" name="stock_amount" class="span6 typeahead" id="typeahead"> 
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Minimum Stock Amount</label>
                        <div class="controls">
                            <input type="number" value="<?php echo $product_info['minimum_stock_amount']; ?>" name="minimum_stock_amount" class="span6 typeahead" id="typeahead"> 
                        </div>
                    </div>
                    <div class="control-group hidden-phone">
                        <label class="control-label" for="textarea2">Product Short Description</label>
                        <div class="controls">
                            <textarea class="cleditor"  name="product_short_description" id="textarea2" rows="3"><?php echo $product_info['product_short_description']; ?></textarea>
                        </div>
                    </div>
                    <div class="control-group hidden-phone">
                        <label class="control-label" for="textarea2">Product Long Description</label>
                        <div class="controls">
                            <textarea class="cleditor" name="product_long_description" id="textarea2" rows="3"><?php echo $product_info['product_long_description']; ?></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="typeahead">Product Image</label>
                        <div class="controls">
                            <input type="file" name="product_image" <table><tr><td> <img src="<?php echo $product_info['product_image']; ?>" alt="<?php echo $product_info['product_name']; ?>" width="150" height="150"> </td></tr></table>
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
                        <button type="submit" name="btn" class="btn btn-primary">Update Product Info</button>
                        <button type="reset" class="btn">Reset</button>
                    </div>
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
