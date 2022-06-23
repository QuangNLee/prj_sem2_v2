<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/brandController.php';
    include '../controller/categoryController.php';
    include '../controller/productController.php';
    include_once '../helpers/format.php';
?>
<?php
    $product = new productController();
    $fm = new Format();
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Product</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="productadd.php" style="cursor: pointer" class="m-0 font-weight-bold text-primary">Add new product</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th style="text-align: center; vertical-align: middle">ID</th>
                            <th style="text-align: center; vertical-align: middle">Product name</th>
                            <th style="text-align: center; vertical-align: middle">Category</th>
                            <th style="text-align: center; vertical-align: middle">Brand</th>
                            <th style="text-align: center; vertical-align: middle">Description</th>
                            <th style="text-align: center; vertical-align: middle">Type</th>
                            <th style="text-align: center; vertical-align: middle">Price</th>
                            <th style="text-align: center; vertical-align: middle">Image</th>
                            <th style="text-align: center; vertical-align: middle">Status</th>
                            <th style="text-align: center; vertical-align: middle">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $limit = 10;
                                $get_product = $product->show_product();
                                $total_product = mysqli_num_rows($get_product);
                                $current_page_product = isset($_GET['page']) ? $_GET['page'] : 1;
                                $product_start = ($current_page_product -1) * $limit;
                                $total_page_product = ceil($total_product/$limit);
                                $get_pagination_product = $product->get_pagination_product($product_start,$limit);
                                if($get_pagination_product){
                                    while($result = $get_pagination_product->fetch_assoc()){
                            ?>
                            <tr>
                                <td style="text-align: center; vertical-align: middle"><?php echo $result['productId'] ?></td>
                                <td style="text-align: center; vertical-align: middle"><?php echo $result['productName'] ?></td>
                                <td style="text-align: center; vertical-align: middle"><?php echo $result['catName'] ?></td>
                                <td style="text-align: center; vertical-align: middle"><?php echo $result['brandName'] ?></td>
                                <td style="text-align: center; vertical-align: middle"><?php echo $fm->textShorten($result['product_description'], 30) ?></td>
                                <td style="text-align: center; vertical-align: middle"><?php
                                    if($result['type'] == 1){
                                        echo '<span style="color: blue">Featured</span>';
                                    } else {
                                        echo 'Non-Featured';
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center; vertical-align: middle"><?php echo $fm->format_currency($result['price']) ?> VND</td>
                                <td style="text-align: center; vertical-align: middle"><img src="uploads/products/<?php echo $result['image'] ?>" width="50px"/></td>
                                <td style="text-align: center; vertical-align: middle">
                                    <?php
                                        if($result['status'] == 1){
                                            echo '<span style="color: green">Available</span>';
                                        } else {
                                            echo '<span style="color: red">Not available</span>';
                                        }
                                    ?>
                                </td>
                                <td style="text-align: center; vertical-align: middle"><a href="productedit.php?productId=<?php echo $result['productId'] ?>">Edit</a></td>
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers">
                            <ul class="pagination">
                                <?php
                                    if ($current_page_product -1 > 0){
                                ?>
                                <li class="paginate_button page-item previous">
                                    <a href="product.php?page=<?php echo $current_page_product-1; ?>"class="page-link">Previous</a>
                                </li>
                                <?php
                                    }
                                ?>
                                <?php
                                    for($i = 1; $i <= $total_page_product; $i++){
                                ?>
                                <li class="paginate_button page-item <?php echo (($current_page_product == $i)?'active': '') ?>">
                                    <a href="product.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                                </li>
                                <?php
                                    }
                                ?>
                                <?php
                                    if($current_page_product +1 <= $total_page_product){
                                ?>
                                <li class="paginate_button page-item next">
                                    <a href="product.php?page=<?php echo $current_page_product + 1; ?>" class="page-link">Next</a>
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
    </div>
    <!-- /.container-fluid -->
<?php
    include 'inc/footer.php';
?>