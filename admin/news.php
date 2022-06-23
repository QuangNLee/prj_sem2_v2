<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include_once '../helpers/format.php';
    include '../controller/newsController.php';
?>
<?php
    $news = new newsController();
    $fm = new Format();
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">News</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="newsadd.php" style="cursor: pointer" class="m-0 font-weight-bold text-primary">Add news</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th width="5%" style="text-align: center; vertical-align: middle">ID</th>
                            <th width="30%" style="text-align: center; vertical-align: middle">Title</th>
                            <th width="10%" style="text-align: center; vertical-align: middle">Image</th>
                            <th width="40%" style="text-align: center; vertical-align: middle">Content</th>
                            <th width="10%" style="text-align: center; vertical-align: middle">Status</th>
                            <th width="5%" style="text-align: center; vertical-align: middle">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $limit = 5;
                            $get_news = $news->get_news();
                            $total_news = mysqli_num_rows($get_news);
                            $current_page_news = isset($_GET['page']) ? $_GET['page'] : 1;
                            $news_start = ($current_page_news -1) * $limit;
                            $total_page_news = ceil($total_news/$limit);
                            $get_pagination_news = $news->get_news_pagination($news_start,$limit);
                            if($get_pagination_news){
                                while($result = $get_pagination_news->fetch_assoc()){
                        ?>
                        <tr>
                            <td style="text-align: center; vertical-align: middle"><?php echo $result['id'] ?></td>
                            <td style="text-align: center; vertical-align: middle"><?php echo $result['title'] ?></td>
                            <td style="text-align: center; vertical-align: middle"><img src="uploads/news/<?php echo $result['image'] ?>" width="50px"/></td>
                            <td style="text-align: center; vertical-align: middle"><?php echo $fm->textShorten($result['content'], 200) ?></td>
                            <td style="text-align: center; vertical-align: middle">
                                <?php
                                if($result['status'] == 1){
                                    echo '<span style="color: green">Available</span>';
                                } else {
                                    echo '<span style="color: red">Not available</span>';
                                }
                                ?>
                            </td>
                            <td style="text-align: center; vertical-align: middle"><a href="newsedit.php?newsId=<?php echo $result['id'] ?>">Edit</a></td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
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
                                        <a href="news.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                                    </li>
                                    <?php
                                }
                                ?>
                                <?php
                                if($current_page_news + 1 <= $total_page_news){
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
    </div>
<?php
    include 'inc/footer.php';
?>