<?php
require 'includes/conf.php';
$session = !empty($_SESSION[SESSION_VAR]['user']) ? $_SESSION[SESSION_VAR]['user'] : '';//print_r($session);exit;
$suserId = isset($session['user_id']) ? $session['user_id'] : '';
$sroleId = isset($session['role_id']) ? $session['role_id'] : '';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Management | User Registration</title>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link href="bootstrap/css/style.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="uploads/logo/logo.png">
    </head>
    <body>
        <div class="container pt-25">
            <?php include 'includes/common.php'; ?>
            <div class="row pt-100">
                
                <div class="offset-col-12">
                <div class="card border-primary mb-4">
                    <div class="card-body">
                        <h2 class="text-center card-title mb-3">Registration Form</h2>
                        <form class="v_form" id="register-form">
                            <div class="form-group row mb-3">
                                <div class="col-sm-12">  
                                    <div class="response"></div>
                                </div>
                            </div>
                            <input type="hidden" name="action" value="registerationForm">
                            <div class="form-group row mb-3">
                                <label for="name" class="col-sm-3 col-form-label mandatory">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" placeholder="your name">
                                </div>
                            </div>
                            
                            <div  class="form-group row mb-3">
                                <label for="gender" class="col-sm-3 col-form-label mandatory">Gender</label>
                                <div class="col-sm-5">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="one" value="male">
                                        <label class="form-check-label" for="one">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="two" value="female">
                                        <label class="form-check-label" for="two">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="three" value="others">
                                        <label class="form-check-label" for="three">Others</label>
                                    </div>
                                    <label class="error" for="gender"></label>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-3">
                                <label for="dob" class="col-sm-3 col-form-label mandatory">Date Of Birth</label>
                                <div class="col-sm-9">
                                    <input type="date" name="dob" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="contact" class="col-sm-3 col-form-label mandatory">Contact</label>
                                <div class="col-sm-9">
                                    <input type="tel" name="contact" placeholder="Phone Number" class="form-control" value="<?php echo !empty($record['contact']) ? $record['contact'] : ''; ?>">
                                </div>
                            </div>
                            
                            <div class="form-group row mb-3">
                                <label for="email" class="col-sm-3 col-form-label mandatory">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" placeholder="Enter Email Address" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="address" class="col-sm-3 col-form-label mandatory">Address</label>
                                <div class="col-sm-9">
                                    <textarea name="address" placeholder="Premenent Address" class="form-control"><?php echo !empty($record['address']) ? $record['address'] : '' ; ?></textarea>
                                </div>
                            </div>
                            
                            <div class="forrm-group row mb-3">
                                <div class="offset-sm-3">
                                    <a class="text-left" href="login.php">Login</a>
                                </div>
                            </div>
                            <div class="form-group row mb-3 text-center">
                                <div class="col-sm-12">
                                    <input type="submit" class="btn btn-outline-primary btn-block" value="Register"><?php // echo !empty($record['id']) ? 'Update': 'Register'; ?>
            <!--                        <input type="reset" value="Cancel" class="btn btn-secondary">-->
                                </div>
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