<?php
if (isset($_POST['btn'])) {
    $message = $ob_sup_admin->save_admin_info($_POST);
}
?>
<script>
    var xmlHttp = new XMLHttpRequest();
    function ajax_admin_email_check(given_email, objID) {
        //alert(objID);
        var server_page = 'ajax_admin_email_check.php?email=' + given_email;
        xmlHttp.open('$_GET', server_page);
        xmlHttp.onreadystatechange = function () {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                document.getElementById(objID).innerHTML = xmlHttp.responseText;
                if (xmlHttp.responseText == 'Email Already Exists') {
                    document.getElementById('btn').disabled = true;
                } else {
                    document.getElementById('btn').disabled = false;
                }
            }
        }
        xmlHttp.send(null);
    }
</script>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header" data-original-title>
            <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Admin Form</h2>
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
                            <label class="control-label" for="typeahead">Admin Name </label>
                            <div class="controls">
                                <input type="text" name="admin_name" class="span6 typeahead" id="typeahead"> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Email Address </label>
                            <div class="controls">
                                <input type="text" name="email_address" class="span6 typeahead" id="typeahead"> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">Password </label>
                            <div class="controls">
                                <input type="password" name="password" class="span6 typeahead" id="typeahead"> 
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError3"> Access Level </label>
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
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="signup"></label>
                            <div class="col-md-8">
                                <button type="submit" id="btn" name="btn" class="btn btn-primary">Save Admin</button>
                            </div>
                        </div>
<?php } ?>
                </fieldset>
            </form>   
        </div>
    </div><!--/span-->
</div><!--/row-->

