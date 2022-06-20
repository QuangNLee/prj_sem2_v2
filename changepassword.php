<?php
    include 'inc/header.php';
?>
<?php
    if(isset($_POST['submit'])){
        $customer_id = Session::get('customer_id');
        $changePassword = $customer->changePassword($customer_id,$_POST);
    }
?>
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Change password</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <form action="" method="POST">
                <?php
                    if(isset($changePassword)){
                        echo $changePassword;
                    }
                ?>
                <table class="formcp">
                    <tr>
                        <td>
                            <label>Old Password</label>
                        </td>
                        <br>
                        <td>
                            <input type="password" placeholder="Enter Old Password..."  name="o_password" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>New Password</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Enter New Password..." name="n_password" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Retype New Password</label>
                        </td>
                        <td>
                            <input type="password" placeholder="Enter New Password..." name="rn_password" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="btn btn-brand" style="color: white" type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php
    include 'inc/footer.php';
?>
