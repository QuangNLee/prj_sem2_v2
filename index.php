<?php
    include 'inc/header.php';
    include 'inc/slider.php';
?>
    <div class="main">
        <div class="content">
            <div class="content_top">
                <div class="heading">
                <h3>New Products</h3>
                </div>
                <div class="clear"></div>
            </div><br>
            <div class="section group">
                <?php
                    $product_new = $product->getproduct_new();
                    if($product_new){
                        while($result_new = $product_new->fetch_assoc()){
                ?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="details.php?productId=<?php echo $result_new['productId'] ?>"><img src="admin/uploads/products/<?php echo $result_new['image'] ?>" alt="" /></a>
                    <h2><?php echo $result_new['productName'] ?></h2>
                    <span class="tooltiptext"><?php echo $result_new['productName'] ?></span>
                    <div class="price-details">
                        <div class="price-number">
                            <p><span class="price"><?php echo $fm->format_currency($result_new['price'])." VND" ?></span></p>
                        </div>
                        <div class="add-cart">
                            <h4><a href="details.php?productId=<?php echo $result_new['productId'] ?>">Details</a></h4>
                        </div>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
            <div class="content_bottom">
                <div class="heading">
                    <h3>Feature Products</h3>
                </div>
                <div class="clear"></div>
            </div><br>
            <div class="section group box">
                <?php
                    $product_featured = $product->getproduct_featured();
                    if($product_featured){
                        while($result = $product_featured->fetch_assoc()){
                ?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="details.php"><img src="admin/uploads/products/<?php echo $result['image'] ?>" alt="" /></a>
                    <h2><?php echo $result['productName'] ?></h2>
                    <span class="tooltiptext"><?php echo $result['productName'] ?></span>
                    <div class="price-details">
                        <div class="price-number">
                            <p><span class="price"><?php echo $fm->format_currency($result['price'])." VND" ?></span></p>
                        </div>
                        <div class="add-cart">
                            <h4><a href="details.php?productId=<?php echo $result['productId'] ?>">Details</a></h4>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
<?php
    include 'inc/footer.php';
?>