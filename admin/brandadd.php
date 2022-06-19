<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/brandController.php';
?>
<?php
    $brand = new brandController();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $brandName = $_POST['brandName'];
        $insertbrand = $brand->insert_brand($brandName);
    }
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add new brand</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <?php
                    if(isset($insertbrand)){
                        echo $insertbrand;
                    }
                ?>
                <form action="brandadd.php" method="post">
                    <div class="row">
                        <div class="col-25">
                            <label>Branch Name</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="brandName" placeholder="Enter new brand name..." />
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" name="submit" Value="Save" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
<?php
    include 'inc/footer.php';
?>