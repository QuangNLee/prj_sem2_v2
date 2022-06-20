<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath . '/../controller/orderController.php');
    include_once($filepath . '/../helpers/format.php');
?>
<?php
    $order = new orderController();
    $fm = new Format();
    $get_successful_order = $order->get_completed_order();
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Completed orders</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex">
                <div class="row">
                    <a href="order.php" style="cursor: pointer" class="m-0 font-weight-bold text-primary">All order</a>
                </div>
                <div class="row" style="margin-left: 30px">
                    <a href="processing.php" style="cursor: pointer" class="m-0 font-weight-bold text-primary">Processing order</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th style="text-align: center;vertical-align: middle">ID</th>
                            <th style="text-align: center;vertical-align: middle">Order time</th>
                            <th style="text-align: center;vertical-align: middle">Type</th>
                            <th style="text-align: center;vertical-align: middle">Customer ID</th>
                            <th style="text-align: center;vertical-align: middle">Customer</th>
                            <th style="text-align: center;vertical-align: middle">Product</th>
                            <th style="text-align: center;vertical-align: middle">Quantity</th>
                            <th style="text-align: center;vertical-align: middle">Price</th>
                            <th style="text-align: center;vertical-align: middle">Status</th
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $limit = 10;
                            $get_order = $order->get_completed_order();
                            $total_order = mysqli_num_rows($get_order);
                            $current_page_order = isset($_GET['page']) ? $_GET['page'] : 1;
                            $order_start = ($current_page_order -1) * $limit;
                            $total_page_order = ceil($total_order/$limit);
                            $get_pagination_order = $order->get_pagination_completed_order($order_start,$limit);
                            if($get_pagination_order){
                                while($result = $get_pagination_order->fetch_assoc()){
                        ?>
                            <tr>
                                <td style="text-align: center;vertical-align: middle"><?php echo $result['id'] ?></td>
                                <td style="text-align: center;vertical-align: middle"><?php echo $fm->formatDate($result['createdAt']) ?></td>
                                <td style="text-align: center;vertical-align: middle">
                                    <?php
                                        if($result['orderType'] == 0){
                                            echo '<span style="text-align: center; color: red">Offline Payment</span>';
                                        } else {
                                            echo '<span style="text-align: center; color: green">Online Payment</span>';
                                        }
                                    ?>
                                </td>
                                <td style="text-align: center;vertical-align: middle"><?php echo $result['customerId'] ?></td>
                                <td style="text-align: center;vertical-align: middle"><a href="customer.php?customerId=<?php echo $result['customerId'] ?>">View customer</a></td>
                                <td style="text-align: center;vertical-align: middle"><?php echo $result['productName'] ?></td>
                                <td style="text-align: center;vertical-align: middle"><?php echo $result['quantity'] ?></td>
                                <td style="text-align: center;vertical-align: middle"><?php echo $fm->format_currency($result['total']) ?></td>
                                <?php
                                    if($result['status'] == 2){
                                ?>
                                <td style="text-align: center;vertical-align: middle"><a style="color: green">Success</a></td>
                                <?php
                                    } else {
                                ?>
                                <td style="text-align: center;vertical-align: middle"><a style="color: #8B0000">Canceled</a></td>
                                <?php
                                    }
                                ?>
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
                                    if ($current_page_order -1 > 0){
                                ?>
                                <li class="paginate_button page-item previous">
                                    <a href="completed.php?page=<?php echo $current_page_order-1; ?>"class="page-link">Previous</a>
                                </li>
                                <?php
                                    }
                                ?>
                                <?php
                                    for($i = 1; $i <= $total_page_order; $i++){
                                ?>
                                <li class="paginate_button page-item <?php echo (($current_page_order == $i)?'active': '') ?>">
                                    <a href="completed.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                                </li>
                                <?php
                                    }
                                ?>
                                <?php
                                    if($current_page_order +1 <= $total_page_order){
                                ?>
                                <li class="paginate_button page-item next">
                                    <a href="completed.php?page=<?php echo $current_page_order + 1; ?>" class="page-link">Next</a>
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
    <!-- /.container-fluid -->
<?php
    include 'inc/footer.php';
?>