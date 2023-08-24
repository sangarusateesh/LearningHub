<?php
require 'includes/sessioncheck.php';//print_r($_SESSION[SESSION_VAR]);exit;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Change Password | <?php echo SITE_URL; ?></title>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="bootstrap/css/style.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="uploads/logo/logo.png">
    </head>
    <body>
    <div id="login">
        <?php include 'includes/common.php'; ?>
        <h3 class="text-center text-white pt-5">Change Password Form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-5">
                    <div id="login-box" class="col-md-12">
                        <form id="changepassword-form" class="v_form form">
                            <div class="row"><div class="response"></div></div>
                            <h3 class="text-center text-info">Change Password</h3>
                            <input type="hidden" name="id" value="<?php echo $suserId; ?>">
                            <input type="hidden" name="action" value="changePassword">
                            <div class="form-group mb-3">
                                <label for="npassword" class="text-info mandatory">New Password</label><br>
                                <input type="password" name="npassword" placeholder="Enter New Password" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="cnfpassword" class="text-info mandatory">Confirm Password</label><br>
                                <input type="password" name="cnfpassword" placeholder="Re-Enter New Password" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Submit">
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