<?php
    include 'inc/header.php';
    include 'inc/sidebar.php';
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath . '/../controller/customerController.php');
    include_once($filepath . '/../helpers/format.php');
?>
<?php
    $customer = new customerController();
    if(!isset($_GET['customerId']) || $_GET['customerId'] == NULL){
        echo "<script>window.location ='inbox.php'</script>";
    } else {
        $id = $_GET['customerId'];
    }
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Customer information</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="container-form">
                    <?php
                        $get_customer = $customer->show_customer($id);
                        if($get_customer){
                            while($result = $get_customer->fetch_assoc()){
                    ?>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-25">
                                <label>Name</label>
                            </div>
                            <div class="col-75">
                                <input type="text" readonly="readonly" value="<?php echo $result['name'] ?>" name="name" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label>Address</label>
                            </div>
                            <div class="col-75">
                                <input type="text" readonly="readonly" value="<?php echo $result['address'] ?>" name="address" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label>District</label>
                            </div>
                            <div class="col-75">
                                <input type="text" readonly="readonly" value="<?php echo $result['district'] ?>" name="district" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label>City</label>
                            </div>
                            <div class="col-75">
                                <input type="text" readonly="readonly" value="<?php echo $result['city'] ?>" name="city" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label>Zipcode</label>
                            </div>
                            <div class="col-75">
                                <input type="text" readonly="readonly" value="<?php echo $result['zipcode'] ?>" name="zipcode" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label>Phone</label>
                            </div>
                            <div class="col-75">
                                <input type="text" readonly="readonly" value="<?php echo $result['phone'] ?>" name="phone" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label>Email</label>
                            </div>
                            <div class="col-75">
                                <input type="text" readonly="readonly" value="<?php echo $result['email'] ?>" name="email" />
                            </div>
                        </div>
                    </form>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
<?php
include 'inc/footer.php';
?>