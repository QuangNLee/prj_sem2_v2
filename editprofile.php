<?php
    include 'inc/header.php';
?>
<?php
    $login_check = Session::get('customer_login');
    if($login_check == false){
        header('Location:login.php');
    }
?>
<?php
    $id = Session::get('customer_id');
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])){
        $updateCustomer = $customer->update_customer($_POST, $id);
    }
?>
    <div class="main">
        <div class="content">
            <div class="content_top">
                <div class="heading">
                    <h3>Update information profile</h3>
                </div>
                <div class="clear"></div>
            </div>
            <div class="section group">
                <form action="" method="post">
                    <table class="tblone">
                        <tr>
                            <?php
                                if(isset($updateCustomer)){
                                    echo '<td colspan="3">'.$updateCustomer.'</td>';
                                }
                            ?>
                        </tr>
                        <?php
                            $id = Session::get('customer_id');
                            $get_customer = $customer->show_customer($id);
                            if($get_customer){
                                while ($result = $get_customer->fetch_assoc()){
                        ?>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><input type="text" name="name" value="<?php echo $result['name'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><input type="text" name="address" value="<?php echo $result['address'] ?>"></td>
                        </tr>
                        <tr>
                            <td>District</td>
                            <td>:</td>
                            <td><input type="text" name="district" value="<?php echo $result['district'] ?>"></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td>
                                <select id="city" name="city" onchange="change_country(this.value)" class="frm-field required">
                                    <option value="null">Select a City</option>
                                    <option value="HaNoi">Hà Nội</option>
                                    <option value="TPHCM">Thành phố Hồ Chí Minh</option>
                                    <option value="Hải Phòng">Hải Phòng</option>
                                    <option value="Đà Nẵng">Đà Nẵng</option>
                                    <option value="Cần Thơ">Cần Thơ</option>
                                    <option value="Lạng Sơn">Lạng Sơn</option>
                                    <option value="Nha Trang">Nha Trang</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Zipcode</td>
                            <td>:</td>
                            <td><input type="text" name="zipcode" value="<?php echo $result['zipcode'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><input type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="3"><input type="submit" name="save" value="Save" class="grey"></td>
                        </tr>
                        <?php
                                }
                            }
                        ?>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php
    include 'inc/footer.php';
?>