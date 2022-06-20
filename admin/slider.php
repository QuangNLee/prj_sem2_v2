<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/sliderController.php';
?>
<?php
    $slider = new sliderController();
    if(isset($_GET['change_type']) && isset($_GET['type'])){
        $id = $_GET['change_type'];
        $type = $_GET['type'];
        $update_type = $slider->update_type($id,$type);
    }
    if(isset($_GET['del_slider'])){
        $id = $_GET['del_slider'];
        $del_slider = $slider->del_slider($id);
    }
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Slider</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="slideradd.php" style="cursor: pointer" class="m-0 font-weight-bold text-primary">Add new slider</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?php
                        if(isset($del_slider)){
                            echo $del_slider;
                        }
                    ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle">ID</th>
                                <th style="text-align: center; vertical-align: middle">Slider Title</th>
                                <th style="text-align: center; vertical-align: middle">Slider Image</th>
                                <th style="text-align: center; vertical-align: middle">Slider Status</th>
                                <th style="text-align: center; vertical-align: middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $limit = 5;
                                $get_slider = $slider->show_slider_admin();
                                $total_slider = mysqli_num_rows($get_slider);
                                $current_page_slider = isset($_GET['page']) ? $_GET['page'] : 1;
                                $slider_start = ($current_page_slider -1) * $limit;
                                $total_page_slider = ceil($total_slider/$limit);
                                $get_pagination_slider = $slider->show_pagination_slider($slider_start,$limit);
                                if($get_pagination_slider){
                                    while($result_slider = $get_pagination_slider->fetch_assoc()){
                            ?>
                            <tr>
                                <td style="text-align: center; vertical-align: middle"><?php echo $result_slider['id'] ?></td>
                                <td style="text-align: center; vertical-align: middle"><?php echo $result_slider['sliderName'] ?></td>
                                <td style="text-align: center; vertical-align: middle"><img src="uploads/<?php echo $result_slider['image'] ?>" height="120px" width="400px"/></td>
                                <td style="text-align: center; vertical-align: middle">
                                    <?php
                                        if($result_slider['type'] == 1){
                                    ?>
                                    <a href="?change_type=<?php echo $result_slider['id'] ?>&type=0" style="color: green">ON</a>
                                    <?php
                                        } else {
                                    ?>
                                    <a href="?change_type=<?php echo $result_slider['id'] ?>&type=1" style="color: red">OFF</a>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td style="text-align: center; vertical-align: middle">
                                    <a onclick="return confirm('Do you want to delete?');" style="color: red" href="?del_slider=<?php echo $result_slider['id'] ?>">Delete</a>
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
                                    if ($current_page_slider -1 > 0){
                                ?>
                                <li class="paginate_button page-item previous">
                                    <a href="slider.php?page=<?php echo $current_page_slider-1; ?>"class="page-link">Previous</a>
                                </li>
                                <?php
                                    }
                                ?>
                                <?php
                                    for($i = 1; $i <= $total_page_slider; $i++){
                                ?>
                                <li class="paginate_button page-item <?php echo (($current_page_slider == $i)?'active': '') ?>">
                                    <a href="slider.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                                </li>
                                <?php
                                    }
                                ?>
                                <?php
                                    if($current_page_slider +1 <= $total_page_slider){
                                ?>
                                <li class="paginate_button page-item next">
                                    <a href="slider.php?page=<?php echo $current_page_slider + 1; ?>" class="page-link">Next</a>
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