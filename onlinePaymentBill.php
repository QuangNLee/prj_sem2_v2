<?php
    include 'inc/header.php';
?>
<?php
    if(isset($_GET['onlinepayment']) && $_GET['onlinepayment'] == 'success'){
        if($_GET['gate'] == 'vnpay'){
            $gate = 'vnpay';
        } else if ($_GET['gate'] == 'paypal'){
            $gate = 'paypal';
        }
        $customer_id = Session::get('customer_id');
        $insertOrder = $order->insertOrderOnline($customer_id, $gate);
        $delcart = $cart->del_all_data_cart();
    }
?>
    <div class="main">
        <div class="content">
            <div class="section group">
                <h2 class="success_order">Payment successfully!!!</h2>
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