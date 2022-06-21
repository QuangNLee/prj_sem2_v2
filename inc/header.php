<?php
    $filepath = realpath(dirname(__FILE__));
    include 'lib/session.php';
    Session::init();
    include_once 'lib/database.php';
    include_once 'helpers/format.php';
    spl_autoload_register(function($controller){
        include_once "controller/".$controller.".php";
    });
    $db = new Database();
    $fm = new Format();
    $cart = new cartController();
    $user = new userController();
    $cat = new categoryController();
    $customer = new customerController();
    $product  = new productController();
    $order = new orderController();
    $brand = new brandController();
    $slider = new sliderController();
?>
<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
    <title>Online Store BD</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/slider.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="css/404.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript" src="js/startstop-slider.js"></script>
</head>
<body>
<div class="wrap">
    <div class="header">
        <div class="headertop_desc">
            <div class="call">
                <p><span>Need help?</span> call us <span class="number">1-22-3456789</span></span></p>
            </div>
            <?php
                if(isset($_GET['customer_id'])){
                    $customer_id = $_GET['customer_id'];
                    $delCart = $cart->del_all_data_cart();
                    $delCompare = $cart->del_all_data_compare($customer_id);
                    Session::destroy();
                }
            ?>
            <div class="account_desc">
                <ul>
                    <?php
                        $login_check = Session::get('customer_login');
                        if ($login_check == false){
                            echo '<li><a href="login.php">Login</a></li>
                                  <li><a href="register.php">Register</a></li>';
                        } else {
                            echo '<li><a href="profile.php">Profile</a></li>
                                  <li><a href="?customer_id='.Session::get('customer_id').'">Logout</a></li>';
                        }
                    ?>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div class="header_top">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt="" /></a>
            </div>
            <div class="cart">
                <?php
                    $check_cart = $cart->check_cart();
                    if($check_cart == true){
                        echo '<p>Welcome to Online Store BD! <span><a href="cart.php">Cart:</a></span>';
                    } else {
                        echo '<p>Welcome to Online Store BD! <span>Cart:</span>';
                    }
                ?>
                <?php
                    if($check_cart){
                        $sum = Session::get("sum");
                        $qty = Session::get("qty");
                        echo $fm->format_currency($sum).' VND'.' - '.$qty.' item(s)';
                    } else {
                        echo 'Empty';
                    }
                ?>
                </p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="header_bottom">
            <div class="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn">Product ▼</a>
                        <div class="dropdown-content">
                            <?php
                                $show_category = $cat->show_category_index();
                                if($show_category){
                                    while ($result_category = $show_category->fetch_assoc()){
                                        ?>
                                        <a href="productbycat.php?catId=<?php echo $result_category['catId'] ?>"><?php echo $result_category['catName'] ?></a>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </li>
                    <li><a href="brands.php">Brand</a></li>
                    <?php
                        $customer_id = Session::get('customer_id');
                        $check_order = $order->check_order($customer_id);
                        if($check_order == true){
                            echo '<li><a href="order.php">All order</a></li>';
                        } else {
                            echo '';
                        }
                    ?>
                    <?php
                        $check_cart = $cart->check_cart();
                        if($check_cart == true){
                            echo '<li><a href="cart.php">Cart</a></li>';
                        } else {
                            echo '';
                        }
                    ?>
                    <?php
                        $login_check = Session::get('customer_login');
                        if($login_check == false){
                            echo '';
                        } else {
                            echo '<li><a href="favorite.php">Favorite</a> </li>';
                        }
                    ?>
                    <?php
                        $login_check = Session::get('customer_login');
                        if($login_check == false){
                            echo '';
                        } else {
                            echo '<li><a href="compare.php">Compare</a> </li>';
                        }
                    ?>
                    <li><a href="contact.php">Contact</a></li>
                    <div class="clear"></div>
                </ul>
            </div>
            <div class="search_box">
                <form action="search.php" method="post">
                    <input type="text" placeholder="Search product..." name="keyword">
                    <input type="submit" name="search_product" value="">
                </form>
            </div>
            <div class="clear"></div>
        </div>