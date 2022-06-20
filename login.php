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
    $login_check = Session::get('customer_login');
    if($login_check){
        header('Location:index.php');
    }
?>
<?php
    $customer = new customerController();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
        $loginCustomer = $customer->login_customer($_POST);
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
    <title>Login</title>

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
                                <img src="images/login/logo-mini.png" alt="">
                            </a>
                        </div>
                        <div class="login-form">
                            <?php
                                if(isset($loginCustomer)){
                                    echo $loginCustomer;
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
                                <input class="au-btn au-btn--block au-btn--grey m-b-20" type="submit" name="login" value="Login">
                            </form>
                            <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="register.php">Sign Up Here</a>
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
<!-- end document-->j