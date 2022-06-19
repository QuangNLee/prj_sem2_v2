<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/brandController.php';
    include '../controller/categoryController.php';
    include '../controller/productController.php';
?>
<?php
    $prod = new productController();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $insertProduct = $prod->insert_product($_POST,$_FILES);
    }
?>
    <script src="js/ckeditor/ckeditor.js"></script>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add new product</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <?php
                    if(isset($insertProduct)){
                        echo $insertProduct;
                    }
                ?>
                <form action="productadd.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-25">
                            <label>Product name</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="productName" placeholder="Enter new product name..." />
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
                                <option value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
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
                                <option value="">Select Brand</option>
                                <?php
                                    $brand = new brandController();
                                    $brandlist = $brand->show_brand();
                                    if($brandlist){
                                        while($result = $brandlist->fetch_assoc()){
                                ?>
                                <option value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
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
                            <textarea name="product_description" id="description-box"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Price</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="price" placeholder="Enter Price..."/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Upload image</label>
                        </div>
                        <div class="col-75">
                            <input type="file" name="image" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Origin</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="origin" placeholder="Origin..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Size</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="size" placeholder="Size..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Product weigh</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="productWeight" placeholder="Product weigh..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Material</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="material" placeholder="Material..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Radiators</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="radiators" placeholder="Radiators..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>CPU</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="cpu" placeholder="CPU..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>RAM</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="ram" placeholder="RAM..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Type of RAM</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="typeOfRam" placeholder="Type of RAM..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>RAM speed</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="ramSpeed" placeholder="RAM speed..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Number of RAM slots</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="numberOfRamSlot" placeholder="Number of RAM slots..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Maximum Ram support</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="maximumRamSupport" placeholder="Maximum Ram support..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Screen size</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="screenSize" placeholder="Screen size..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Resolution screen</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="resolution" placeholder="Resolution screen..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Screen ratio</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="screenRatio" placeholder="Screen ratio..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Onboard card</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="onboardCard" placeholder="Onboard card..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Removable card</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="removableCard" placeholder="Removable card..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Storage</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="storage" placeholder="storage..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>The web of communication</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="webCommunication" placeholder="The web of communication..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Wifi</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="wifi" placeholder="Wifi..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Bluetooth</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="bluetooth" placeholder="Bluetooth..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Camera</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="camera" placeholder="Camera..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Keyboard type</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="keyboardType" placeholder="Keyboard type..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Pin</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="pin" placeholder="Pin..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>OS version</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="osVersion" placeholder="OS version..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Water/Dirt resistance standard</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="waterResistance" placeholder="Water/Dirt resistance standard..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Internal memory</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="internalMemory" placeholder="Internal memory..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>SIM type</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="simType" placeholder="SIM type..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Network support</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="networkSupport" placeholder="Network support..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Product Type</label>
                        </div>
                        <div class="col-75">
                            <select id="select" name="type">
                                <option value="1" selected>Featured</option>
                                <option value="0">Non-Featured</option>
                            </select>
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
    <script>
        CKEDITOR.replace('description-box');
    </script>
<?php
    include 'inc/footer.php';
?>