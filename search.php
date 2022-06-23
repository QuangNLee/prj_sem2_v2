<?php
    include 'inc/header.php';
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($_POST['keyword'] == ""){
            echo '';
        } else {
            $keyword = $_POST['keyword'];
        }
    }
?>
    <div class="main">
        <div class="content">
            <div class="content_top">
                <?php
                    $search_product = $product->search_product($keyword);
                ?>
                <div class="heading">
                    <h3>Keyword: <?php echo $keyword ?></h3>
                </div>
                <div class="clear"></div>
            </div>
            <div class="section group">
                <?php
                    $limit = 200;
                    $total_product = mysqli_num_rows($search_product);
                    $current_page_product = isset($_GET['page']) ? $_GET['page'] : 1;
                    $product_start = ($current_page_product -1) * $limit;
                    $total_page_product = ceil($total_product/$limit);
                    $get_pagination_product = $product->search_product_pagination($keyword,$product_start,$limit);
                    if($get_pagination_product){
                        while($result = $get_pagination_product->fetch_assoc()){
                ?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="details.php?productId=<?php echo $result['productId'] ?>"><img src="admin/uploads/products/<?php echo $result['image'] ?>" alt="" /></a>
                    <h2><?php echo $result['productName'] ?></h2>
                    <span class="tooltiptext"><?php echo $result['productName'] ?></span>
                    <div class="price-details">
                        <div class="price-number">
                            <p><span class="price"><?php echo $fm->format_currency($result['price'])." VND" ?></span></p>
                        </div>
                        <div class="add-cart">
                            <h4><a href="details.php?productId=<?php echo $result['productId'] ?>">Add to Cart</a></h4>
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
                                    <a href="search.php?page=<?php echo $current_page_product-1; ?>"class="page-link">Previous</a>
                                </li>
                                <?php
                            }
                            ?>
                            <?php
                            for($i = 1; $i <= $total_page_product; $i++){
                                ?>
                                <li class="paginate_button page-item <?php echo (($current_page_product == $i)?'active': '') ?>">
                                    <a href="search.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                                </li>
                                <?php
                            }
                            ?>
                            <?php
                            if($current_page_product +1 <= $total_page_product){
                                ?>
                                <li class="paginate_button page-item next">
                                    <a href="search.php?page=<?php echo $current_page_product + 1; ?>" class="page-link">Next</a>
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