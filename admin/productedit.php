<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/brandController.php';
    include '../controller/categoryController.php';
    include '../controller/productController.php';
?>
<?php
    $prod = new productController();
    if(!isset($_GET['productId']) || $_GET['productId'] == NULL){
        echo "<script>window.location ='productlist.php'</script>";
    } else {
        $id = $_GET['productId'];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updateProduct = $prod->update_product($_POST,$_FILES,$id);
    }
?>
    <script src="js/ckeditor/ckeditor.js"></script>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit product</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <?php
                    if(isset($updateProduct)){
                        echo $updateProduct;
                    }
                ?>
                <?php
                    $getproductbyId = $prod->getproductbyId($id);
                    if($getproductbyId){
                    while($result_product = $getproductbyId->fetch_assoc()){
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-25">
                            <label>Product name</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="productName" value="<?php echo $result_product['productName'] ?>" placeholder="Enter New Product Name..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Category</label>
                        </div>
                        <div class="col-75">
                            <select id="select" name="category">
                                <option value="">Select Category</option>
                                <?php
                                    $cat = new categoryController();
                                    $catlist = $cat->show_category();
                                    if($catlist){
                                        while($result = $catlist->fetch_assoc()){
                                ?>
                                <option
                                    <?php
                                      if($result['catId'] == $result_product['catId']){ echo 'selected'; }
                                    ?>
                                    value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?>
                                </option>
                                    <?php
                                        }
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Brand</label>
                        </div>
                        <div class="col-75">
                            <select id="select" name="brand">
                                <option>Select Brand</option>
                                <?php
                                    $brand = new brandController();
                                    $brandlist = $brand->show_brand();
                                    if($brandlist){
                                        while($result = $brandlist->fetch_assoc()){
                                ?>
                                    <option
                                        <?php
                                            if($result['brandId'] == $result_product['brandId']){ echo 'selected'; }
                                        ?>
                                        value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label style="text-align: center; vertical-align: middle">Description</label>
                        </div>
                        <div class="col-75">
                            <textarea name="product_description" id="description-box"><?php echo $result_product['product_description'] ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Price</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="price" value="<?php echo $result_product['price'] ?>" placeholder="Enter Price..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Upload image</label>
                        </div>
                        <div class="col-75">
                            <img src="uploads/<?php echo $result_product['image'] ?>" width="50px"/>
                            <input type="file" name="image" />
                        </div>
                    </div>
                    <?php
                        $get_pro_spec = $prod->get_value_pro_spec($id);
                        if($get_pro_spec){
                            while($result_pro_spec = $get_pro_spec->fetch_assoc()){
                    ?>
                    <div class="row">
                        <div class="col-25">
                            <label><?php echo $result_pro_spec['name'] ?></label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="<?php echo $result_pro_spec['id'] ?>" value="<?php echo $result_pro_spec['value'] ?>" placeholder="<?php echo $result_pro_spec['name'] ?>..." />
                        </div>
                    </div>
                    <?php
                            }
                        }
                    ?>
                    <div class="row">
                        <div class="col-25">
                            <label>Product Type</label>
                        </div>
                        <div class="col-75">
                            <select id="select" name="type">
                                <?php
                                    if($result_product['type'] == 1){
                                ?>
                                <option selected value="1">Featured</option>
                                <option value="0">Non-Featured</option>
                                <?php
                                    }else{
                                ?>
                                <option value="1">Featured</option>
                                <option selected value="0">Non-Featured</option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Status</label>
                        </div>
                        <div class="col-75">
                            <select id="select" name="status">
                                <?php
                                    if($result_product['status'] == 1){
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
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <script>
        CKEDITOR.replace('description-box');
    </script>
<?php
include 'inc/footer.php';
?>