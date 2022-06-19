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
    if(isset($_GET['shippedId'])){
        $id = $_GET['shippedId'];
        $productId = $_GET['productId'];
        $quantity = $_GET['quantity'];
        $shipped = $order->shipped($id,$productId,$quantity);
    }
    if(isset($_GET['cancelId'])){
        $id = $_GET['cancelId'];
        $productId = $_GET['productId'];
        $quantity = $_GET['quantity'];
        $cancel_order = $order->cancel_order($id,$productId,$quantity);
        header('Location:ordered.php');
        echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
    }
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">All orders</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex">
                <div class="row">
                    <a href="processing.php" style="cursor: pointer" class="m-0 font-weight-bold text-primary">Processing order</a>
                </div>
                <div class="row" style="margin-left: 30px">
                    <a href="completed.php" style="cursor: pointer" class="m-0 font-weight-bold text-primary">Completed order</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Order time</th>
                            <th>Type</th>
                            <th>Gate</th>
                            <th>Customer ID</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                $limit = 10;
                                $get_order = $order->get_all_order();
                                $total_order = mysqli_num_rows($get_order);
                                $current_page_order = isset($_GET['page']) ? $_GET['page'] : 1;
                                $order_start = ($current_page_order -1) * $limit;
                                $total_page_order = ceil($total_order/$limit);
                                $get_pagination_order = $order->get_pagination_all_order($order_start,$limit);
                                if($get_pagination_order){
                                    while($result = $get_pagination_order->fetch_assoc()){
                            ?>
                            <tr>
                                <td style="vertical-align: middle; text-align: center"><?php echo $result['id'] ?></td>
                                <td style="vertical-align: middle; text-align: center"><?php echo $fm->formatDate($result['createdAt']) ?></td>
                                <td style="vertical-align: middle; text-align: center">
                                    <?php
                                        if($result['orderType'] == 0){
                                            echo '<span style="text-align: center; color: red">Offline Payment</span>';
                                        } else {
                                            echo '<span style="text-align: center; color: green">Online Payment</span>';
                                        }
                                    ?>
                                </td>
                                <td style="vertical-align: middle; text-align: center"><?php echo $result['gate'] ?></td>
                                <td style="vertical-align: middle; text-align: center"><?php echo $result['customerId'] ?></td>
                                <td style="vertical-align: middle; text-align: center"><a href="customer.php?customerId=<?php echo $result['customerId'] ?>">View customer</a></td>
                                <td style="vertical-align: middle; text-align: center"><?php echo $result['productName'] ?></td>
                                <td style="vertical-align: middle; text-align: center"><?php echo $result['quantity'] ?></td>
                                <td style="vertical-align: middle; text-align: center"><?php echo $fm->format_currency($result['total']) ?></td>
                                <td style="vertical-align: middle; text-align: center">
                                    <?php
                                        if($result['status'] == 0){
                                            echo '<span style="color: #7C2DC5">Pending</span>';
                                        } else if ($result['status'] == 1){
                                            echo '<span style="color: #4d8cbc">Delivering</span>';
                                        } else if ($result['status'] == 3){
                                            echo '<span style="color: #8B0000">Canceled</span>';
                                        } else {
                                            echo '<span style="color: green">Success</span>';
                                        }
                                    ?>
                                </td>
                                <td style="vertical-align: middle; text-align: center">
                                    <?php
                                        if($result['status'] == 0){
                                    ?>
                                    <a href="?shippedId=<?php echo $result['id'] ?>&productId=<?php echo $result['productId'] ?>&quantity=<?php echo $result['quantity'] ?>" style="color: blue">Ship</a> ||
                                    <a onclick="return confirm('Do you want to cancel?')" href="?cancelId=<?php echo $result['id'] ?>&productId=<?php echo $result['productId'] ?>&quantity=<?php echo $result['quantity'] ?>" style="color: #8B0000">Cancel</a>
                                    <?php
                                        } else if ($result['status'] == 1 || $result['status'] == 2) {
                                    ?>
                                    <a onclick="return confirm('Do you want to cancel?')" href="?cancelId=<?php echo $result['id'] ?>&productId=<?php echo $result['productId'] ?>&quantity=<?php echo $result['quantity'] ?>" style="color: #8B0000">Cancel</a>
                                    <?php
                                        } else {
                                            echo 'x';
                                        }
                                    ?>
                                </td>
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
                                    <a href="order.php?page=<?php echo $current_page_order-1; ?>"class="page-link">Previous</a>
                                </li>
                                <?php
                                    }
                                ?>
                                <?php
                                    for($i = 1; $i <= $total_page_order; $i++){
                                ?>
                                <li class="paginate_button page-item <?php echo (($current_page_order == $i)?'active': '') ?>">
                                    <a href="order.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                                </li>
                                <?php
                                    }
                                ?>
                                <?php
                                    if($current_page_order +1 <= $total_page_order){
                                ?>
                                <li class="paginate_button page-item next">
                                    <a href="order.php?page=<?php echo $current_page_order + 1; ?>" class="page-link">Next</a>
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