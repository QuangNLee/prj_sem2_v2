<?php
    include 'inc/header.php';
?>
<?php
    if (isset($_GET['cartId'])){
        $cartid = $_GET['cartId'];
        $delcart = $cart->del_product_cart($cartid);
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $cartId = $_POST['cartId'];
        $quantity = $_POST['quantity'];
        $update_quantity_cart = $cart->update_quantity_cart($quantity,$cartId);
        if($quantity<=0){
            $delcart = $cart->del_product_cart($cartId);
        }
}
?>
<?php
    if (!isset($_GET['id'])){
        echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
    }
?>
    <div class="main">
        <div class="content">
            <div class="content_top">
                <div class="heading">
                    <h3>Your cart</h3>
                </div>
                <div class="clear"></div>
            </div><br>
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
                    <th width="20%" style="text-align: center; vertical-align: middle">Product Name</th>
                    <th width="10%" style="text-align: center; vertical-align: middle">Image</th>
                    <th width="15%" style="text-align: center; vertical-align: middle">Price</th>
                    <th width="25%" style="text-align: center; vertical-align: middle">Quantity</th>
                    <th width="20%" style="text-align: center; vertical-align: middle">Total Price</th>
                    <th width="10%" style="text-align: center; vertical-align: middle">Action</th>
                </tr>
                <?php
                    $get_product_cart = $cart->get_product_cart();
                    if($get_product_cart){
                        $subtotal = 0;
                        $qty = 0;
                        while ($result = $get_product_cart->fetch_assoc()){
                ?>
                <tr>
                    <td style="text-align: center; vertical-align: middle"><?php echo $result['productName'] ?></td>
                    <td style="text-align: center; vertical-align: middle"><img src="admin/uploads/products/<?php echo $result['image'] ?>" style="height: 60px; width: 80px" alt=""/></td>
                    <td style="text-align: center; vertical-align: middle"><?php echo $fm->format_currency($result['price']) ?> VND</td>
                    <td style="text-align: center; vertical-align: middle">
                        <form action="" method="post">
                            <input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>"/>
                            <input type="number" name="quantity" min = "0" value="<?php echo $result['quantity'] ?>"/>
                            <input type="submit" name="submit" value="Update"/>
                        </form>
                    </td>
                    <td style="text-align: center; vertical-align: middle"><?php
                        $total = $result['price'] * $result['quantity'];
                        echo $fm->format_currency($total);
                        ?>
                        VND</td>
                    <td style="text-align: center; vertical-align: middle"><a onclick="return confirm('Do you want to delete???')"
                           href="?cartId=<?php echo $result['cartId'] ?>">Delete</a></td>
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
                    <td><?php
                        echo $fm->format_currency($subtotal);
                        Session::set('sum',$subtotal);
                        Session::set('qty',$qty);
                        ?>
                        VND</td>
                </tr>
            </table>
            <?php
                } else {
                    echo 'Your cart is empty!';
                }
            ?>
        </div><br>
        <div class="shopping">
            <div class="shopleft">
                <a href="index.php"> <img src="images/shop.png" alt="" /></a>
            </div>
            <?php
                if($check_cart){
            ?>
            <div class="shopright">
                <a href="payment.php"> <img src="images/check.png" alt="" /></a>
            </div>
            <?php
                }
            ?>
        </div>
        </div>
    </div>
<?php
    include 'inc/footer.php';
?>