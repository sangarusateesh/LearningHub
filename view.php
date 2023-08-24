<?php
require 'includes/sessioncheck.php';
$get= filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);//print_r($get);exit;
if(!$get || $get && empty($get['id']) && empty($get['type'])){header("Location:".SITE_URL);exit;}//echo 14;exit;
$table = $get['type']==1?'users':'employees';
$record = $clsObj->get_record(['table'=>$table,'where'=>"id='".$get['id']."' and status=1"]);//print_r($record);exit;
if(!$record){header("Location:".SITE_URL);exit;}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $get['type']==1?'User Details':'Employee Details'; ?> | <?php echo SITE_URL; ?></title>
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link href="bootstrap/css/style.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="uploads/logo/logo.png">
    </head>
    <body>
        
        <div class="container pt-25">
            <?php include 'includes/common.php'; ?>
            <div class="row pt-100">
                <div class="col-12">
                <div class="card border-primary mb-4">
                    <div class="card-body">
                        <h2 class="text-center card-title mb-3"><?php echo $get['type']==1?'User ':'Employee '; ?> Details</h2>
                        <img src=''>
                        <table class="table table-hover table-striped table-responsive">
                            <tbody>
                                <?php if($get['type']!=2){ ?>
                                <tr>
                                    <td><strong>Profile Photo</strong></td>
                                    <td><img id="profile" src="<?php echo !empty($record['profile_picture']) && file_exists("uploads/employee/".$record['id']."/".$record['profile_picture'])?"uploads/employee/".$record['id']."/".$record['profile_picture']:''; ?>" alt="your image" /></td>
                                </tr>
                                    <tr>
                                        <td><strong>User Name</strong></td>
                                        <td><?php echo ucwords($record['name']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Gender</strong></td>
                                        <td><?php echo $record['gender']==1?'Male':($record['gender']==2?'Female':'Others'); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date Of Birth</strong></td>
                                        <td><?php echo date("d-F-Y",strtotime($record['date_of_birth'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Contact No.</strong></td>
                                        <td><?php echo $record['mobile']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email</strong></td>
                                        <td><?php echo $record['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Address</strong></td>
                                        <td><?php echo ucwords($record['address']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Signature</strong></td>
                                        <td><img id="sign1" src="<?php echo !empty($record['signature']) && file_exists("uploads/employee/".$record['id']."/".$record['signature'])?"uploads/employee/".$record['id']."/".$record['signature']:''; ?>" alt="your image" /></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Current Status</strong></td>
                                        <td>Active</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Registered On</strong></td>
                                        <td><?php echo date("d-F-Y h:i a",strtotime($record['insert_date'])); ?></td>
                                    </tr>
                                <?php }else{ ?>
                                    <tr>
                                        <td><strong>Employee Name</strong></td>
                                        <td><?php echo ucwords($record['employee_name']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Designation</strong></td>
                                        <td><?php echo ucwords($record['designation']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date Of Birth</strong></td>
                                        <td><?php echo date("d-F-Y h:i a",strtotime($record['dob'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date Of Joining</strong></td>
                                        <td><?php echo date("d-F-Y h:i a",strtotime($record['doj'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Blood Group</strong></td>
                                        <td><?php echo ucwords($record['blood_group']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Email</strong></td>
                                        <td><?php echo $record['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Contact Number</strong></td>
                                        <td><?php echo $record['phone']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Address</strong></td>
                                        <td><?php echo ucwords($record['address']); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Proof Type</strong></td>
                                        <td><?php echo $record['id_proof']==1?'Aadhar Card':($record['id_proof']==2?'Pan Card':'Driving Licence'); ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>ID Proof</strong></td>
                                        <td><img src="<?php echo !empty($record['proofimg']) && file_exists("uploads/employee/".$record['proofimg'])?"uploads/employee/".$record['proofimg']:''; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Current Status</strong></td>
                                        <td><?php echo $record['status']==1?'Serving':'Releaved'; ?></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Added On</strong></td>
                                        <td><?php echo date("d-F-Y h:i a", strtotime($record['insert_date'])); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php if($get['type']==1){ ?>
                            <div class="text-center">
                                <a href="profile.php?id=<?php echo $record['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="fa fa-pencil"></i> Edit</a>
                            </div>
                        <?php } ?>
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