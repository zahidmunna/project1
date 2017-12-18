<?php
$query_result = $obj_app->select_all_published_category();

?>
<body>
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                            <?php while ($category_info = mysqli_fetch_assoc($query_result)) { ?>
                            <li class="dropdown"><a href="category.php?id=<?php echo $category_info['category_id']; ?>" class=""><?php echo $category_info['category_name']; ?></a>
                            </li>
                            <?php } ?>
                            
                        <li><a href="contact_us.php">Help Desk</a></li>
                    </ul>
                    
                </div>  
            </div>
        </div>
    </div>
</body>
