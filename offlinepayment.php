<?php
    include 'inc/header.php';
?>
<?php
    if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
        $customer_id = Session::get('customer_id');
        $insertOrder = $order->insertOrder($customer_id);
        $delcart = $cart->del_all_data_cart();
        header('Location:success.php');
    }
?>
    <div class="main">
        <div class="content">
            <div class="content_top">
                <div class="heading">
                    <h3>Offline payment</h3>
                </div>
                <div class="clear"></div>
            </div><br>
            <div class="section group">
                <div class="box_left">
                    <div class="cartpage">
                        <?php
                            if (isset($update_quantity_cart)){
                                echo $update_quantity_cart;
                            }
                        ?>
                        <?php
                            if (isset($delcart)){
                                echo $delcart;
                            }
                        ?>
                        <table class="tblone">
                            <tr>
                                <th width="20%">Product Name</th>
                                <th width="20%">Image</th>
                                <th width="15%">Price</th>
                                <th width="15%">Quantity</th>
                                <th width="20%">Total Price</th>
                            </tr>
                            <?php
                                $get_product_cart = $cart->get_product_cart();
                                if($get_product_cart){
                                    $subtotal = 0;
                                    $qty = 0;
                                    $i = 0;
                                    while ($result = $get_product_cart->fetch_assoc()){
                                        $i++;
                            ?>
                            <tr>
                                <td><?php echo $fm->textShorten($result['productName'], 50) ?></td>
                                <td><img src="admin/uploads/products/<?php echo $result['image'] ?>" alt=""/></td>
                                <td><?php echo $fm->format_currency($result['price']) ?> VND</td>
                                <td><?php echo $result['quantity'] ?></td>
                                <td><?php
                                    $total = $result['price'] * $result['quantity'];
                                    echo $fm->format_currency($total);
                                    ?>
                                    VND</td>
                            </tr>
                            <?php
                                    $subtotal += $total;
                                    $qty = $qty + $result['quantity'];
                                    }
                                }
                            ?>
                        </table>
                        <?php
                            $check_cart = $cart->check_cart();
                            if($check_cart){
                        ?>
                        <table style="float:right;text-align:left; margin: 5px" width="40%">
                            <tr>
                                <th >Sub Total : </th>
                                <td style="color: blue; font-weight: bold">
                                    <?php
                                        echo $fm->format_currency($subtotal);
                                        Session::set('sum',$subtotal);
                                        Session::set('qty',$qty);
                                    ?>
                                    VND
                                </td>
                            </tr>
                        </table>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <div class="box_right">
                    <table class="tblone">
                        <?php
                            $id = Session::get('customer_id');
                            $get_customer = $customer->show_customer($id);
                            if($get_customer){
                                while ($result = $get_customer->fetch_assoc()){
                        ?>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo $result['name'] ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><?php echo $result['address'] ?></td>
                        </tr>
                        <tr>
                            <td>District</td>
                            <td>:</td>
                            <td><?php echo $result['district'] ?></td>
                        </tr>
                        <tr>
                            <td>Zipcode</td>
                            <td>:</td>
                            <td><?php echo $result['zipcode'] ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><?php echo $result['phone'] ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $result['email'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: center"><a href="editprofile.php">Update information</a></td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div><br>
        <center>
            <a href="payment.php" style="background: grey" class="submit_order"><< Previous</a>
            <a href="?orderid=order" class="submit_order" name="order">Order Now</a>
        </center><br><br>
    </div>
<?php
    include 'inc/footer.php';
?>
