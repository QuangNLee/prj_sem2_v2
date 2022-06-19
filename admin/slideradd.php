<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/sliderController.php';
?>
<?php
    $slider = new sliderController();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $insertSlider = $slider->insertSlider($_POST,$_FILES);
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
                if(isset($insertSlider)){
                    echo $insertSlider;
                }
            ?>
            <form action="slideradd.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-25">
                        <label>Title</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="name" placeholder="Enter Slider Title..." />
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
                        <label>Type</label>
                    </div>
                    <div class="col-75">
                        <select name="type">
                            <option value="1" selected>On</option>
                            <option value="0">Off</option>
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