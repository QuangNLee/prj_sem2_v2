<?php
    include 'inc/header.php';
?>
<?php
    if(!isset($_GET['productId']) || $_GET['productId'] == NULL){
        echo "<script>window.location ='404.php'</script>";
    } else {
        $id = $_GET['productId'];
    }
    $customer_id = Session::get('customer_id');
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $quantity = $_POST['quantity'];
        $addToCart = $cart->add_to_cart($quantity,$id);
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])){
        $productid = $_POST['productid'];
        $insert_compare = $cart->insertCompare($productid,$customer_id);
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['flist'])){
        $productid = $_POST['productid'];
        $insert_flist = $cart->insertflist($productid,$customer_id);
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sendComment'])){
        $insert_comment = $customer->insert_comment($id,$_POST);
    }
?>
<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
<link href="css/easy-responsive-tabs.css" rel="stylesheet" type="text/css" media="all"/>
<div class="main">
    <div class="content">
    	<div class="section group">
            <div class="cont-desc span_1_of_2">
                <div class="product-details">
                    <?php
                        $get_product_details = $product->get_details($id);
                        if($get_product_details){
                            while ($result_details = $get_product_details->fetch_assoc()) {
                    ?>
                    <div class="grid images_3_of_2">
                        <div id="container">
                            <div id="products_example">
                                <div id="products">
                                    <div class="slides_container">
                                        <a><img src="admin/uploads/<?php echo $result_details['image'] ?>" alt="" /></a>
                                    </div><br>
                                    <div>
                                        <button type="button" class="btn btn-brand modal-btn" data-target="#modal<?php echo $id ?>">Show specification</button>
                                        <!-- The Modal -->
                                        <div id="modal<?php echo $id ?>" class="modal">
                                            <!-- Modal content -->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button class="close modal-btn buysubmit" style="border: none; font-size: 18px" data-target="#modal<?php echo $i ?>">&times;</button>
                                                    <h2>Specification</h2>
                                                </div><br>
                                                <div class="modal-body">
                                                    <table class="table table-striped">
                                                        <tbody>
                                                        <?php
                                                        $get_pro_spec = $product->get_product_spec($id);
                                                        if($get_pro_spec){
                                                            while ($result_pro_spec = $get_pro_spec->fetch_assoc()){
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $result_pro_spec['name'] ?></td>
                                                                    <td>:</td>
                                                                    <td><?php echo $result_pro_spec['value'] ?></td>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="desc span_3_of_2">
                        <h2><?php echo $result_details['productName'] ?></h2>
                        <p><?php echo $fm->textShorten($result_details['product_description'], 200) ?></p>
                        <div class="price">
                            <p>Price: <span><?php echo $fm->format_currency($result_details['price'])." VND" ?></span></p>
                        </div>
                        <form action="" method="post" class="row">
                            <input type="number" class="buyfield" name="quantity" value="1" min="1"/>
                                <div style="margin-left: 30px">
                                    <span><input type="submit" class="btn btn-brand" name="submit" value="Buy Now"/></span>
                                </div>
                                <div class="clear"></div>
                        </form><br>
                        <div class="wish-list">
                            <form action="" method="post" class="row" style="width: 80%; justify-content: space-between">
                                <input type="hidden" name="productid" value="<?php echo $result_details['productId'] ?>"/>
                                <?php
                                    $login_check = Session::get('customer_login');
                                    if ($login_check){
                                        echo '
                                            <input type="submit" class="btn btn-brand" name="flist" value="Save to favorite list"/>
                                            <input type="submit" class="btn btn-brand" name="compare" value="Compare Product"/>
                                        ';
                                    }
                                ?>
                                <?php
                                    if(isset($insert_compare)){
                                        echo $insert_compare;
                                    }
                                    if(isset($insert_flist)){
                                        echo $insert_flist;
                                    }
                                ?>
                            </form>
                        </div>
                        <?php
                            if(isset($addToCart)){
                                echo '<span style="color: red; font-size: 18px;">Product already exists in cart</span>';
                            }
                        ?>
                    </div>
			        <div class="clear"></div>
		        </div>
                    <div class="product_desc">
                        <div id="horizontalTab">
                            <ul class="resp-tabs-list">
                                <li>Product Details</li>
                                <li>Product Reviews</li>
                                <div class="clear"></div>
                            </ul>
                            <div class="resp-tabs-container">
                                <div class="product-desc">
                                    <p><?php echo $result_details['product_description'] ?></p>
                                </div>
                                <div class="review">
                                    <h4><?php echo $result_details['productName'] ?></h4>
                                    <div class="your-review">
                                        <p>Write Your Own Review?</p>
                                        <?php
                                            if(isset($insert_comment)){
                                                echo $insert_comment;
                                            }
                                        ?>
                                        <form action="" method="post">
                                            <div>
                                                <span><label>Nickname<span class="red">*</span></label></span>
                                                <span><input type="text" name="commentName" placeholder="Enter your name..."></span>
                                            </div>
                                            <div>
                                                <span><label>Review<span class="red">*</span></label></span>
                                                <span><textarea name="comment" placeholder="Enter your comment..."></textarea></span>
                                            </div>
                                            <div>
                                                <span><input type="submit" name="sendComment" value="Send"></span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                        }
                    }
                ?>
                    <div class="content_bottom">
                        <div class="heading">
                            <h3>Related Products</h3>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="section group">
                        <?php
                        $get_related = $product->get_related_product($id);
                        if($get_related){
                            while ($result_related = $get_related->fetch_assoc()){
                                ?>
                                <div class="grid_1_of_4 images_1_of_4">
                                    <a href="details.php?productId=<?php echo $result_related['productId'] ?>"><img src="admin/uploads/<?php echo $result_related['image'] ?>" alt=""></a>
                                    <h2><?php echo $result_related['productName'] ?></h2>
                                    <span class="tooltiptext"><?php echo $result_related['productName'] ?></span>
                                    <div class="price" style="border:none">
                                        <div class="add-cart" style="float:none">
                                            <h4><a href="details.php?productId=<?php echo $result_related['productId'] ?>">Details</a></h4>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
			        </div>
                </div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
                    <ul class="side-w3ls">
                        <?php
                            $getAll_category = $cat->getAll_active_category();
                            if($getAll_category){
                                while ($result_getAll = $getAll_category->fetch_assoc()){
                        ?>
                        <li><a href="productbycat.php?catId=<?php echo $result_getAll['catId'] ?>"><?php echo $result_getAll['catName'] ?></a></li>
                        <?php
                                }
                            }
                        ?>
                    </ul>
 				</div>
        </div>
    </div>
</div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#horizontalTab').easyResponsiveTabs({
                type: 'default', //Types: default, vertical, accordion
                width: 'auto', //auto or any width like 600px
                fit: true   // 100% fit in a container
            });
        });
    </script>
<?php
    include 'inc/footer.php';
?>