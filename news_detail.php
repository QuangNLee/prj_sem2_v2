<?php
    include 'inc/header.php';
?>
<?php
    if(!isset($_GET['newsId']) || $_GET['newsId'] == NULL){
        echo "<script>window.location ='404.php'</script>";
    } else {
        $id = $_GET['newsId'];
    }
?>
<div class="main">
    <div class="content">
        <?php
            $get_new = $news->get_new_by_id($id);
            if($get_new){
                while ($result = $get_new->fetch_assoc()) {
        ?>
        <div class="content_top">
            <div class="heading" style="text-align: center">
                <h2><?php echo $result['title'] ?>></h2>
            </div>
            <div class="clear"></div>
        </div>
        <div class="infor">
            <div class="icons">
                <a> <i class="fas fa-calendar"></i> <?php echo $result['createdAt'] ?> </a>
            </div>
        </div><br><br><br>
        <div class="main_content">
            <p><?php echo $result['content'] ?></p>
        </div>
        <?php
                }
            }
        ?>
    </div>
</div>
<?php
    include 'inc/footer.php';
?>
