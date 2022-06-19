<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/brandController.php';
?>
<?php
    $brand = new brandController();
    if(!isset($_GET['brandId']) || $_GET['brandId'] == NULL){
        echo "<script>window.location ='brandlist.php'</script>";
    } else {
        $id = $_GET['brandId'];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $brandName = $_POST['brandName'];
        $status = $_POST['status'];
        $updateBrand = $brand->update_brand($brandName,$status,$id);
    }
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit brand</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <?php
                    if(isset($updateBrand)){
                        echo $updateBrand;
                    }
                ?>
                <?php
                    $get_brand_name = $brand->getbrandbyId($id);
                    if($get_brand_name){
                        while($result = $get_brand_name->fetch_assoc()){
                ?>
                <div class="container-form">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-25">
                                <label>Branch Name</label>
                            </div>
                            <div class="col-75">
                                <input type="text" value="<?php echo $result['brandName'] ?>" name="brandName" placeholder="Enter new brand name..." />
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