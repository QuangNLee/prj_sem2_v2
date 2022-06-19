<?php
    include 'inc/header.php';
?>
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>New Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <div class="add-cart row" style="justify-content: space-between; float: left; margin-top: 10px; margin-bottom: 10px; padding-left: 2px">
                <?php
                    $list_brand = $brand->list_brand();
                    if($list_brand){
                        while ($result = $list_brand->fetch_assoc()){
                ?>
                <h4><a href="productbybrand.php?brandId=<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></a></h4>
                <?php
                        }
                    }
                ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<?php
    include 'inc/footer.php';
?>
