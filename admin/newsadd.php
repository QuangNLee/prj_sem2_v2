<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/newsController.php';
?>
<?php
    $news = new newsController();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $insertNews = $news->insert_news($_POST,$_FILES);
    }
?>
    <script src="js/ckeditor/ckeditor.js"></script>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add news</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <?php
                    if(isset($insertNews)){
                        echo $insertNews;
                    }
                ?>
                <form action="newsadd.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-25">
                            <label>Title</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="title" placeholder="Enter new title..." />
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
                            <label style="text-align: center; vertical-align: middle">Content</label>
                        </div>
                        <div class="col-75">
                            <textarea name="content" id="content-box"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <input type="submit" name="submit" Value="Save" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        CKEDITOR.replace('content-box');
    </script>
<?php
    include 'inc/footer.php'
?>