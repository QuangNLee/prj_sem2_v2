<?php
    include 'inc/header.php';
?>
    <div class="main">
        <div class="content">
            <?php
                $limit = 3;
                $get_news_index = $news->get_news_index();
                $total_news = mysqli_num_rows($get_news_index);
                $current_page_news = isset($_GET['page']) ? $_GET['page'] : 1;
                $news_start = ($current_page_news -1) * $limit;
                $total_page_news = ceil($total_news/$limit);
                $get_pagination_news = $news->get_news_pagination($news_start,$limit);
                if($get_pagination_news){
                    while($result = $get_pagination_news->fetch_assoc()){
            ?>
            <div class="image group">
                <div class="grid images_3_of_1">
                    <a href="news_detail.php?newsId=<?php echo $result['id'] ?>"><img src="admin/uploads/news/<?php echo $result['image'] ?>" alt="" /></a>
                </div>
                <div class="grid news_desc">
                    <h3><a href="news_detail.php?newsId=<?php echo $result['id'] ?>"><?php echo $result['title'] ?></a></h3>
                    <h4>Posted on <?php echo $result['createdAt'] ?></h4>
                    <p><?php echo $fm->textShorten($result['content'], 300) ?></p>
                </div>
            </div>
            <?php
                    }
                }
            ?>
            <div class="row">
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            <?php
                                if ($current_page_news -1 > 0){
                            ?>
                            <li class="paginate_button page-item previous">
                                <a href="news.php?page=<?php echo $current_page_news-1; ?>"class="page-link">Previous</a>
                            </li>
                            <?php
                                }
                            ?>
                            <?php
                                for($i = 1; $i <= $total_page_news; $i++){
                            ?>
                            <li class="paginate_button page-item <?php echo (($current_page_news == $i)?'active': '') ?>">
                                <a href="news.php?&page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                            </li>
                            <?php
                                }
                            ?>
                            <?php
                                if($current_page_news +1 <= $total_page_news){
                            ?>
                            <li class="paginate_button page-item next">
                                <a href="news.php?page=<?php echo $current_page_news + 1; ?>" class="page-link">Next</a>
                            </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include 'inc/footer.php';
?>
