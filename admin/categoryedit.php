<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/categoryController.php';
?>
<?php
    $cat = new categoryController();
    if(!isset($_GET['catId']) || $_GET['catId'] == NULL){
        echo "<script>window.location ='category.php'</script>";
    } else {
        $id = $_GET['catId'];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catName = $_POST['catName'];
        $status = $_POST['status'];
        $updateCat = $cat->update_category($catName,$status,$id);
    }
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit category</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <?php
                    if(isset($updateCat)){
                        echo $updateCat;
                    }
                ?>
                <?php
                    $get_cate_name = $cat->getcatbyId($id);
                    if($get_cate_name){
                        while($result = $get_cate_name->fetch_assoc()){
                ?>
                <div class="container-form">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-25">
                                <label>Category name</label>
                            </div>
                            <div class="col-75">
                                <input type="text" value="<?php echo $result['catName'] ?>" name="catName" placeholder="Enter new category name..." />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label>Status</label>
                            </div>
                            <div class="col-75">
                                <select id="select" name="status">
                                    <?php
                                        if($result['status'] == 1){
                                    ?>
                                    <option selected value="1">Available</option>
                                    <option value="0">Not available</option>
                                    <?php
                                        }else{
                                    ?>
                                    <option value="1">Available</option>
                                    <option selected value="0">Not available</option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <input type="submit" name="submit" Value="Update" />
                        </div>
                    </form>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    </div>
    <!-- /.container-fluid -->
<?php
    include 'inc/footer.php';
?>