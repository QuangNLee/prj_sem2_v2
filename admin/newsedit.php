<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../controller/newsController.php';
?>
<?php
    $news = new newsController();
    if(!isset($_GET['newsId']) || $_GET['newsId'] == NULL){
        echo "<script>window.location ='news.php'</script>";
    } else {
        $id = $_GET['newsId'];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updateNews = $news->update_news($_POST,$_FILES,$id);
    }
?>
    <script src="js/ckeditor/ckeditor.js"></script>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit news</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <?php
                    if(isset($updateNews)){
                        echo $updateNews;
                    }
                ?>
                <?php
                    $get_news_by_id = $news->get_new_by_id($id);
                    if($get_news_by_id){
                        while($result = $get_news_by_id->fetch_assoc()){
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-25">
                            <label>Title</label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="title" value="<?php echo $result['title'] ?>" placeholder="Enter new title..." />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label>Upload image</label>
                        </div>
                        <div class="col-75">
                            <img src="uploads/news/<?php echo $result['image'] ?>" width="50px"/>
                            <input type="file" name="image" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label style="text-align: center; vertical-align: middle">Content</label>
                        </div>
                        <div class="col-75">
                            <textarea name="content" id="content-box"><?php echo $result['content'] ?></textarea>
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
                        <input type="submit" name="submit" Value="Save" />
                    </div>
                </form>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <script>
        CKEDITOR.replace('content-box');
    </script>
<?php
    include 'inc/footer.php'
?>