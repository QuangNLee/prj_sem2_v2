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
            <h1 class="h3 mb-0 text-gray-800">Processing orders</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="display: flex">
                <div class="row">
                    <a href="order.php" style="cursor: pointer" class="m-0 font-weight-bold text-primary">All order</a>
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
                                <th style="text-align: center; vertical-align: middle">ID</th>
                                <th style="text-align: center; vertical-align: middle">Order time</th>
                                <th style="text-align: center; vertical-align: middle">Type</th>
                                <th style="text-align: center; vertical-align: middle">Customer ID</th>
                                <th style="text-align: center; vertical-align: middle">Customer</th>
                                <th style="text-align: center; vertical-align: middle">Product</th>
                                <th style="text-align: center; vertical-align: middle">Quantity</th>
                                <th style="text-align: center; vertical-align: middle">Price</th>
                                <th style="text-align: center; vertical-align: middle">Status</th>
                                <th style="text-align: center; vertical-align: middle">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $order = new orderController();
                            $fm = new Format();
                            $get_inbox_order = $order->get_inbox_order();
                            if($get_inbox_order){
                                while ($result = $get_inbox_order->fetch_assoc()){
                        ?>
                            <tr>
                                <td style="text-align: center; vertical-align: middle"><?php echo $result['id'] ?></td>
                                <td style="text-align: center; vertical-align: middle"><?php echo $fm->formatDate($result['createdAt']) ?></td>
                                <td style="text-align: center; vertical-align: middle">
                                    <?php
                                        if($result['orderType'] == 0){
                                            echo '<span style="text-align: center; color: red">Offline Payment</span>';
                                        } else {
                                            echo '<span style="text-align: center; color: green">Online Payment</span>';
                                        }
                                    ?>
                                </td>
                                <td style="text-align: center; vertical-align: middle"><?php echo $result['customerId'] ?></td>
                                <td style="text-align: center; vertical-align: middle"><a href="customer.php?customerId=<?php echo $result['customerId'] ?>">View customer</a></td>
                                <td style="text-align: center; vertical-align: middle"><?php echo $result['productName'] ?></td>
                                <td style="text-align: center; vertical-align: middle"><?php echo $result['quantity'] ?></td>
                                <td style="text-align: center; vertical-align: middle"><?php echo $fm->format_currency($result['total']) ?></td>
                                <td style="text-align: center; vertical-align: middle">
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
                                <td style="text-align: center; vertical-align: middle">
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
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
<?php
    include 'inc/footer.php';
?>