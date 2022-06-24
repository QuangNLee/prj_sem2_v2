<?php
    include 'inc/header.php';
?>
    <div class="main">
        <div class="content">
            <div class="content_top">
                <div class="heading">
                    <h3> Online Payment</h3>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="section group">
            <table class="tblone">
                <tr>
                    <th width="30%">Product Name</th>
                    <th width="20%">Image</th>
                    <th width="20%">Price</th>
                    <th width="10%">Quantity</th>
                    <th width="20%">Total Price</th>
                </tr>
                <?php
                $get_product_cart = $cart->get_product_cart();
                if($get_product_cart){
                    $subtotal = 0;
                    $qty = 0;
                    while ($result = $get_product_cart->fetch_assoc()){
                        ?>
                        <tr>
                            <td style="text-align: center;vertical-align: middle"><?php echo $result['productName'] ?></td>
                            <td style="text-align: center;vertical-align: middle"><img src="admin/uploads/products/<?php echo $result['image'] ?>" style="height: 60px; width: 80px" alt=""/></td>
                            <td style="text-align: center;vertical-align: middle"><?php echo $fm->format_currency($result['price']) ?> VND</td>
                            <td style="text-align: center;vertical-align: middle"><?php echo $result['quantity'] ?></td>
                            <td style="text-align: center;vertical-align: middle"><?php
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
                <table style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Sub Total : </th>
                        <td>
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
            } else {
                echo 'Your cart is empty!';
            }
            ?>
            <div class="clear"></div>
            <div class="shopping" style="text-align: center">
                <?php
                $check_cart = $cart ->check_cart();
                if(Session::get('customer_id') == true && $check_cart){
                    ?>
                    <form action="paymentgatevnpay.php" method="POST">
                        <input type="hidden" name="total_payment" value="<?php echo $subtotal; ?>">
                        <button class="btn btn-success btn-payment" name="redirect" id="redirect">Cash by VNPAY</button>
                    </form><br>
                    <div id="paypal-button-container" class="btn btn-success" style="background: white">
                        <?php
                        $priceUSD = round($subtotal/23000);
                        ?>
                        <input type="hidden" id="priceUSD" value="<?php echo $priceUSD; ?>">

                    </div>
                    <?php
                } else {
                    ?>
                    <a class="btn btn-success btn-payment" href=""><< Back to cart</a>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php
    include 'inc/footer.php';
?>
