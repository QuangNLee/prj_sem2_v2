<?php
    $filepath = realpath(dirname(__FILE__));
    include 'lib/session.php';
    Session::init();
    include_once 'lib/database.php';
    include_once 'helpers/format.php';
    spl_autoload_register(function($controller){
        include_once "controller/".$controller.".php";
    });
?>
<?php
    $customer = new customerController();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $insertCustomer = $customer->insert_customer($_POST);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Register</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="js/login/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="js/login/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="js/login/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="js/login/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="js/login/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="js/login/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="js/login/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="js/login/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="js/login/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="js/login/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="js/login/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="images/login/logo-mini.png" alt="CoolAdmin">
                        </a>
                    </div>
                    <div class="login-form">
                        <?php
                            if(isset($insertCustomer)){
                                echo $insertCustomer;
                            }
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input class="au-input au-input--full" type="text" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input class="au-input au-input--full" type="text" name="name" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input class="au-input au-input--full" type="text" name="phone" placeholder="Your phone..." required>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input class="au-input au-input--full" type="text" name="address" placeholder="Your address ...">
                            </div>
                            <div class="form-group">
                                <label>District</label>
                                <input class="au-input au-input--full" type="text" name="district" placeholder="Your district ...">
                            </div>
                            <div class="form-group">
                                <label>City</label>
                                <select id="city" name="city" onchange="change_country(this.value)" class="frm-field required" required>
                                    <option value="null">Select a City</option>
                                    <option value="HaNoi">H?? N???i</option>
                                    <option value="TPHCM">Th??nh ph??? H??? Ch?? Minh</option>
                                    <option value="H???i Ph??ng">H???i Ph??ng</option>
                                    <option value="???? N???ng">???? N???ng</option>
                                    <option value="C???n Th??">C???n Th??</option>
                                    <option value="L???ng S??n">L???ng S??n</option>
                                    <option value="Nha Trang">Nha Trang</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Zipcode</label>
                                <input class="au-input au-input--full" type="text" name="zipcode" placeholder="Zipcode" required>
                            </div>
                            <input class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="submit" value="Register">
                        </form>
                        <div class="register-link">
                            <p>
                                Already have account?
                                <a href="login.php">Sign In</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Jquery JS-->
<script src="js/login/vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="js/login/vendor/bootstrap-4.1/popper.min.js"></script>
<script src="js/login/vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="js/login/vendor/slick/slick.min.js">
</script>
<script src="js/login/vendor/wow/wow.min.js"></script>
<script src="js/login/vendor/animsition/animsition.min.js"></script>
<script src="js/login/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="js/login/vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="js/login/vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="js/login/vendor/circle-progress/circle-progress.min.js"></script>
<script src="js/login/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="js/login/vendor/chartjs/Chart.bundle.min.js"></script>
<script src="js/login/vendor/select2/select2.min.js">
</script>

<!-- Main JS-->
<script src="js/login/main.js"></script>

</body>

</html>
<!-- end document-->