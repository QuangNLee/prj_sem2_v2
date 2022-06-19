<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/categoryController.php';
?>
<?php
    $cat = new categoryController();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $catName = $_POST['catName'];
        $insertCat = $cat->insert_category($catName);
    }
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add new category</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <?php
                    if(isset($insertCat)){
                        echo $insertCat;
                    }
                ?>
                <form action="categoryadd.php" method="post">
                    <div class="row">
                        <div class="col-25">
                            <label>Category Name</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="catName" placeholder="Enter new category name..." />
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