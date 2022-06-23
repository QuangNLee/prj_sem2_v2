<?php
    include 'inc/header.php';
?>
<?php
    $customer_id = Session::get('customer_id');
    $get_order_detail = $order->get_order_detail($customer_id);
?>
    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="heading">
                    <h3>Order Detail</h3>
                </div>
                <div class="clear"></div>
                <div class="box_order_detail">
                    <div class="cartpage">
                        <table class="tblone">
                            <tr>
                                <th width="15%">Product Name</th>
                                <th width="15%">Image</th>
                                <th width="15%">Price</th>
                                <th width="10%">Quantity</th>
                                <th width="15%">Total Price</th>
                                <th width="15%">Order date</th>
                                <th width="5%">Status</th>
                            </tr>
                            <?php
                                if($get_order_detail){
                                    while($result = $get_order_detail->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?php echo $result['productName'] ?></td>
                                <td><img src="admin/uploads/products/<?php echo $result['image'] ?>" alt=""/></td>
                                <td><?php echo $fm->format_currency($result['unitPrice']) ?> VND</td>
                                <td><?php echo $result['quantity'] ?></td>
                                <td><?php echo $fm->format_currency($result['total']) ?> VND</td>
                                <td><?php echo $fm->formatDate($result['createdAt']) ?></td>
                                <?php
                                if($result['status'] == 0){
                                    ?>
                                    <td><?php echo 'N/A' ?></td>
                                    <?php
                                } else {
                                    ?>
                                    <td><a onclick="return confirm('Do you want to delete?');" href="?cartid=<?php $result['cartId']?>">Delete</a></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="shopping">
                    <div class="shopleft">
                        <a href="index.php"><img src="images/shop.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include 'inc/footer.php';
?>