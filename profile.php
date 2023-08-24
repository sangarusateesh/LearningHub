<?php
require 'includes/sessioncheck.php';//print_r($s_user);exit;
$get = filter_input_array(INPUT_GET);
if(!empty($get) && !empty($get['id'])){
    $s_user = $clsObj->get_record(['table'=>'users','where'=>"id='".$get['id']."'"]);
}//print_r($s_user);exit;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profile | User Registration</title>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="bootstrap/css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link rel="shortcut icon" type="image/png" href="uploads/logo/logo.png">
    </head>
    <body>
        
        <div class="container pt-25">
            <?php include 'includes/common.php'; ?>
            <div class="row pt-100">
                <div class="col-12">
                <div class="card border-primary mb-4">
                    <div class="card-body">
                        <h2 class="text-center card-title mb-3">Profile</h2>
                        <form class="v_form" id="register-form">
                            <div class="form-group row mb-3">
                                <div class="col-sm-12">  
                                    <div class="response"></div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $s_user['id']; ?>">
                            <input type="hidden" name="type" value="<?php echo !empty($s_user['role'])?$s_user['role']:$s_user['role']; ?>" >
                            <input type="hidden" name="action" value="profileForm">
                            <div class="form-group row mb-3">
                                <label for="name" class="col-sm-3 col-form-label mandatory">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" placeholder="your name" value="<?php echo !empty($s_user['name'])?$s_user['name']:''; ?>">
                                </div>
                            </div>
                            
                            <div  class="form-group row mb-3">
                                <label for="gender" class="col-sm-3 col-form-label mandatory">Gender</label>
                                <div class="col-sm-5">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="one" value="male" <?php echo !empty($s_user['gender']) && $s_user['gender']==1?'checked':''; ?>>
                                        <label class="form-check-label" for="one">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="two" value="female" <?php echo !empty($s_user['gender']) && $s_user['gender']==2?'checked':''; ?>>
                                        <label class="form-check-label" for="two">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="three" value="others" <?php echo !empty($s_user['gender']) && $s_user['gender']==3?'checked':''; ?>>
                                        <label class="form-check-label" for="three">Others</label>
                                    </div>
                                    <label class="error" for="gender"></label>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-3">
                                <label for="dob" class="col-sm-3 col-form-label mandatory">Date Of Birth</label>
                                <div class="col-sm-9">
                                    <input type="date" name="dob" class="form-control" value="<?php echo !empty($s_user['date_of_birth'])?$s_user['date_of_birth']:''; ?>" >
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="contact" class="col-sm-3 col-form-label mandatory">Contact</label>
                                <div class="col-sm-9">
                                    <input type="tel" name="contact" placeholder="Phone Number" class="form-control" value="<?php echo !empty($s_user['mobile']) ? $s_user['mobile'] : ''; ?>">
                                </div>
                            </div>
                            
                            <div class="form-group row mb-3">
                                <label for="email" class="col-sm-3 col-form-label mandatory">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" placeholder="Enter Email Address" class="form-control" value="<?php echo !empty($s_user['email'])?$s_user['email']:''; ?>">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="address" class="col-sm-3 col-form-label mandatory">Address</label>
                                <div class="col-sm-9">
                                    <textarea name="address" placeholder="Premenent Address" class="form-control"><?php echo !empty($s_user['address']) ? $s_user['address'] : '' ; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="profile" class="col-sm-3 col-form-label mandatory">Profile Photo</label>
                                <div class="col-sm-9">
                                    <input accept="image/*" type='file' id="imgInp" name="profileimg" />
                                    <img id="profile" src="<?php echo !empty($s_user['profile_picture']) && file_exists("uploads/employee/".$s_user['id']."/".$s_user['profile_picture'])?"uploads/employee/".$s_user['id']."/".$s_user['profile_picture']:''; ?>" alt="your image" /> &nbsp; &nbsp; 
                                        <small> Preview</small>
                                </div>
                            </div>
                            <div class="form-group row mb-3">
                                <label for="sign" class="col-sm-3 col-form-label mandatory">Signature</label>
                                <div class="col-sm-9">
                                    <input accept="image/*" type='file' id="sign" name="sign" />
                                    <img id="sign1" src="<?php echo !empty($s_user['signature']) && file_exists("uploads/employee/".$s_user['id']."/".$s_user['signature'])?"uploads/employee/".$s_user['id']."/".$s_user['signature']:''; ?>" alt="your image" /> &nbsp; &nbsp; 
                                        <small> Preview</small>
                                </div>
                            </div>
                            <div class="form-group row mb-3 text-center">
                                <div class="col-sm-12">
                                    <input type="submit" class="btn btn-outline-primary btn-block" value="Update">
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
        <script>
            imgInp.onchange = evt => {
                const [file] = imgInp.files
                if (file) {
                  profile.src = URL.createObjectURL(file)
                }
            }
            sign.onchange = evt => {
                const [file] = sign.files
                if (file) {
                  sign1.src = URL.createObjectURL(file)
                }
            }
        </script>
    </body>
</html>