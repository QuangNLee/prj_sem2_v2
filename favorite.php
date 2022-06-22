<?php
    include 'inc/header.php';
?>
<?php
    $customer_id = Session::get('customer_id');
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $id = $_POST['productId'];
        $quantity = 1;
        $addToCart = $cart->add_to_cart($quantity,$id);
        $delFAAC = $cart->del_product_flist_ac($customer_id, $id);
    }
    if (isset($_GET['favorId'])){
        $favorId = $_GET['favorId'];
        $delflist = $cart->del_product_flist($favorId);
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
                    <h3>Favorite product</h3>
                </div>
                <div class="clear"></div>
            </div><br>
            <div class="section group">
                <div>
                    <?php
                    if (isset($delflist)){
                        echo $delflist;
                    }
                    ?>
                    <?php
                    if(isset($addToCart)){
                        echo '<span style="color: red; font-size: 18px;">Product already exists in cart</span><br>';
                    }
                    ?>
                    <table class="tblone">
                        <tr>
                            <th width="5%">No.</th>
                            <th width="40%">Product Name</th>
                            <th width="25%">Image</th>
                            <th width="15%">Price</th>
                            <th width="15%">Action</th>
                        </tr>
                        <?php
                        $get_f_list = $cart->get_all_flist($customer_id);
                        if($get_f_list){
                            $i = 0;
                            while($result = $get_f_list->fetch_assoc()){
                                $i++;
                                ?>
                                <tr>
                                    <td style="text-align: center; vertical-align: middle"><?php echo $i; ?></td>
                                    <td style="text-align: center; vertical-align: middle"><?php echo $result['productName'] ?></td>
                                    <td style="text-align: center; vertical-align: middle"><img src="admin/uploads/<?php echo $result['image'] ?>" style="height: 60px; width: 80px" alt=""/></td>
                                    <td style="text-align: center; vertical-align: middle"><?php echo $fm->format_currency($result['price']) ?> VND</td>
                                    <td style="text-align: center; vertical-align: middle">
                                        <form action="" method="post">
                                            <input type="hidden" name="productId" value="<?php echo $result['productId'] ?>">
                                            <input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
                                            <a onclick="return confirm('Do you want to delete???')"
                                               href="?favorId=<?php echo $result['id'] ?>"> || Delete</a></td>
                                        </form>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "Your favorite list is empty!!!";
                        }
                        ?>
                    </table>

                </div>
                <div class="shopping">
                    <div class="shopleft">
                        <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<?php
    include 'inc/footer.php';
?>