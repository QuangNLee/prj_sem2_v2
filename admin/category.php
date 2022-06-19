<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/categoryController.php';
?>
<?php
    $cat = new categoryController();
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="categoryadd.php" style="cursor: pointer" class="m-0 font-weight-bold text-primary">Add new category</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle">ID</th>
                                <th style="text-align: center; vertical-align: middle">Category name</th>
                                <th style="text-align: center; vertical-align: middle">Status</th>
                                <th style="text-align: center; vertical-align: middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $limit = 10;
                            $get_cat = $cat->show_category();
                            $total_cat = mysqli_num_rows($get_cat);
                            $current_page_cat = isset($_GET['page']) ? $_GET['page'] : 1;
                            $cat_start = ($current_page_cat -1) * $limit;
                            $total_page_cat = ceil($total_cat/$limit);
                            $get_pagination_cat = $cat->show_pagination_category($cat_start,$limit);
                            if($get_pagination_cat){
                                $i = 0;
                                while($result = $get_pagination_cat->fetch_assoc()){
                                    $i++;
                        ?>
                        <tr>
                            <td style="text-align: center; vertical-align: middle"><?php echo $result['catId'] ?></td>
                            <td style="text-align: center; vertical-align: middle"><?php echo $result['catName'] ?></td>
                            <td style="text-align: center; vertical-align: middle">
                                <?php
                                if($result['status'] == 1){
                                    echo '<span style="color: green">Available</span>';
                                } else {
                                    echo '<span style="color: red">Not available</span>';
                                }
                                ?>
                            </td>
                            <td style="text-align: center; vertical-align: middle"><a href="categoryedit.php?catId=<?php echo $result['catId'] ?>">Edit</a>
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
                                    if ($current_page_cat -1 > 0){
                                ?>
                                <li class="paginate_button page-item previous">
                                    <a href="category.php?page=<?php echo $current_page_cat-1; ?>"class="page-link">Previous</a>
                                </li>
                                <?php
                                    }
                                ?>
                                <?php
                                    for($i = 1; $i <= $total_page_cat; $i++){
                                ?>
                                <li class="paginate_button page-item <?php echo (($current_page_cat == $i)?'active': '') ?>">
                                    <a href="category.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                                </li>
                                <?php
                                    }
                                ?>
                                <?php
                                    if($current_page_cat +1 <= $total_page_cat){
                                ?>
                                <li class="paginate_button page-item next">
                                    <a href="category.php?page=<?php echo $current_page_cat + 1; ?>" class="page-link">Next</a>
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