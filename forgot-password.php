<?php
require 'includes/conf.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Forgot Password | <?php echo SITE_URL; ?></title>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="bootstrap/css/style.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="uploads/logo/logo.png">
    </head>
    <body>
    <div id="login">
        <?php include 'includes/common.php'; ?>
        <h3 class="text-center text-white pt-5">Forgot Password Form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-5">
                    <div id="login-box" class="col-md-12">
                        <form id="forgotpassword-form" class="v_form form">
                            <div class="row"><div class="response"></div></div>
                            <h3 class="text-center text-info">Forgot Password</h3>
                            <input type="hidden" name="action" value="forgotPassword">
                            <div class="form-group mb-3">
                                <label for="email" class="text-info mandatory">Username</label><br>
                                <input type="text" name="email" placeholder="Enter Your Registered Email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Submit">
                            </div>
                            <div id="register-link" class=" mt-3">
                                <a href="<?php echo SITE_URL; ?>" class="float start text-info">Register here</a>
                                <a href="login.php" class="float-end text-info">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script src="js/jquery.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/additional-methods.min.js"></script>
        <script src="js/form-validation.js"></script>
</body>
</html>