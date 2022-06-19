<?php
    include 'inc/header.php';
    include 'inc/slider.php';
?>
<?php
    if(!isset($_GET['brandId']) || $_GET['brandId'] == NULL){
        echo "<script>window.location = '404.php'</script>";
    } else {
        $id = $_GET['brandId'];
    }
?>
<div class="main">
    <div class="content">
        <div class="content_top">
            <?php
                $getNameBrand = $brand->getNameByBrandId($id);
                if($getNameBrand){
                    while ($result_name = $getNameBrand->fetch_assoc()){
            ?>
            <div class="heading">
                <h3>Brand: <?php echo $result_name['brandName'] ?></h3>
            </div>
            <?php
                    }
                }
            ?>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
                $limit = 12;
                $get_product_by_brand = $product->get_product_by_brand($id);
                $total_product = mysqli_num_rows($get_product_by_brand);
                $current_page_product = isset($_GET['page']) ? $_GET['page'] : 1;
                $product_start = ($current_page_product -1) * $limit;
                $total_page_product = ceil($total_product/$limit);
                $get_pagination_product = $product->get_pagination_product_by_brand($id,$product_start,$limit);
                if($get_pagination_product){
                    while($result = $get_pagination_product->fetch_assoc()){
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php?productId=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
                <h2><?php echo $fm->textShorten($result['productName'], 100) ?></h2>
                <div class="price-details">
                    <div class="price-number">
                        <p><span class="price"><?php echo $fm->format_currency($result['price']) ?> VND</span></p>
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
        <div class="row">
            <div class="col-sm-12 col-md-7">
                <div class="dataTables_paginate paging_simple_numbers">
                    <ul class="pagination">
                        <?php
                            if ($current_page_product -1 > 0){
                        ?>
                        <li class="paginate_button page-item previous">
                            <a href="productbybrand.php?brandId=<?php echo $id; ?>&page=<?php echo $current_page_product-1; ?>"class="page-link">Previous</a>
                        </li>
                        <?php
                            }
                        ?>
                        <?php
                            for($i = 1; $i <= $total_page_product; $i++){
                        ?>
                        <li class="paginate_button page-item <?php echo (($current_page_product == $i)?'active': '') ?>">
                            <a href="productbybrand.php?brandId=<?php echo $id; ?>&page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                        </li>
                        <?php
                            }
                        ?>
                        <?php
                            if($current_page_product +1 <= $total_page_product){
                        ?>
                        <li class="paginate_button page-item next">
                            <a href="productbybrand.php?brandId=<?php echo $id; ?>&page=<?php echo $current_page_product + 1; ?>" class="page-link">Next</a>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include 'inc/footer.php';
?>
