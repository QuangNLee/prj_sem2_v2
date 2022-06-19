<?php
    include 'inc/header.php';
?>
<?php
    if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
        $customer_id = Session::get('customer_id');
        $insertOrder = $order->insertOrderOffline($customer_id);
        $delcart = $cart->del_all_data_cart();
        header('Location:success.php');
    }
?>
    <br>
    <div class="main">
        <div class="content">
            <div class="section group">
                <h2 class="success_order">Order successfully!!!</h2>
                <?php
                    $customer_id = Session::get('customer_id');
                    $get_amount = $order->get_amount($customer_id);
                    if($get_amount){
                        while($result = $get_amount->fetch_assoc()){
                            $price = $result['total'];
                        }
                    }
                ?>
                <p class="success_note" style="color: blue; font-weight: bold">Total price: <?php echo $fm->format_currency($price) ?> VND</p>
                <p class="success_note">We will contact you soon. Thank you!<a href="orderdetail.php"> Click here to see your order.</a> </p>
            </div>
        </div>
    </div>
<?php
    include 'inc/footer.php';
?>