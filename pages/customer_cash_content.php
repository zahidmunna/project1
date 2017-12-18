<?php
$query_result = $obj_app->select_order_table();
$result = $obj_app->select_order_details_table();

?>

<?php if (isset($_SESSION['customer_id'])) { ?>
<body>
    <?php if (isset($_SESSION['customer_id'])) { ?>
    <h1 align="center" style="color: green">Congratulations</h1>
    <h1 align="center" style="color:blue"><?php echo ($_SESSION['customer_name']) ?></h1>
    <?php if ($order = mysqli_fetch_assoc($query_result)) { ?>
    <h3 style="color:green" align="center"><strong>Important:</strong> Please have the exact amount available as our delivery driver may not be carrying sufficient change. </h3>
    <br/>
    <h3 align="center" style="color: green"> Your Shopping Details is available in PDF Link below,Download from there,Show it to our delivery driver at the time of receiving the products</h3>
    <br/>
    
    <a href="database.php"><h1 align="center">PDF</h1></a>
        <?php } ?>
    
<?php } ?>


</body>

<?php } else { ?>
    <h1 align="center" style="color:red"><?php echo'Please Login or Make Your Registration'; ?></h1>
<?php } ?>