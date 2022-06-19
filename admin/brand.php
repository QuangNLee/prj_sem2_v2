<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/brandController.php';
?>
<?php
    $brand = new brandController();
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Brand</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="brandadd.php" style="cursor: pointer" class="m-0 font-weight-bold text-primary">Add new brand</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th style="text-align: center; vertical-align: middle">ID</th>
                            <th style="text-align: center; vertical-align: middle">Brand name</th>
                            <th style="text-align: center; vertical-align: middle">Status</th>
                            <th style="text-align: center; vertical-align: middle">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $limit = 10;
                                $get_brand = $brand->show_brand();
                                $total_brand = mysqli_num_rows($get_brand);
                                $current_page_brand = isset($_GET['page']) ? $_GET['page'] : 1;
                                $brand_start = ($current_page_brand -1) * $limit;
                                $total_page_brand = ceil($total_brand/$limit);
                                $get_pagination_brand = $brand->show_pagination_brand($brand_start,$limit);
                                if($get_pagination_brand){
                                    while($result = $get_pagination_brand->fetch_assoc()){
                            ?>
                            <tr>
                                <td style="text-align: center; vertical-align: middle"><?php echo $result['brandId'] ?></td>
                                <td style="text-align: center; vertical-align: middle"><?php echo $result['brandName'] ?></td>
                                <td style="text-align: center; vertical-align: middle">
                                    <?php
                                    if($result['status'] == 1){
                                        echo '<span style="color: green">Available</span>';
                                    } else {
                                        echo '<span style="color: red">Not available</span>';
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center; vertical-align: middle"><a href="brandedit.php?brandId=<?php echo $result['brandId'] ?>">Edit</a>
                                </td>
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
                                    if ($current_page_brand -1 > 0){
                                ?>
                                <li class="paginate_button page-item previous">
                                    <a href="brand.php?page=<?php echo $current_page_brand-1; ?>"class="page-link">Previous</a>
                                </li>
                                <?php
                                    }
                                ?>
                                <?php
                                    for($i = 1; $i <= $total_page_brand; $i++){
                                ?>
                                <li class="paginate_button page-item <?php echo (($current_page_brand == $i)?'active': '') ?>">
                                    <a href="brand.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                                </li>
                                <?php
                                    }
                                ?>
                                <?php
                                    if($current_page_brand +1 <= $total_page_brand){
                                ?>
                                <li class="paginate_button page-item next">
                                    <a href="brand.php?page=<?php echo $current_page_brand + 1; ?>" class="page-link">Next</a>
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