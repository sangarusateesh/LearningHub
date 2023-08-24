<?php
$get = filter_input_array(INPUT_GET ,FILTER_SANITIZE_STRING);
require 'includes/sessioncheck.php';
if(!empty($get) && !empty($get['type'])){
    if(!in_array($sroleId,[1,2])){header("Location:".SITE_URL."/employees.php?status=active");exit;}
}
$getdata = filter_input_array(INPUT_GET);
$postdata = filter_input_array(INPUT_POST);
$status=1;
if($get && !empty($get['status'])){
    if($get['status']=='active'){
        $status=1;
    }else{
        $status=0;
    }
}
if($get && !empty($get['type']) && $get['type']=='edit'){
    if(!$get['id']){header("Location:employees?status=active");exit;}
    $employee = $clsObj->get_record(['table'=>'employees','where'=>"id='".$get['id']."'"]);//print_r($employee);exit;
}
$where1 = $get && !empty($get['search'])?" employee_name like '".$get['search']."%' or designation like '".$get['search']."%' or dob like '".$get['search']."%' or doj like '".$get['search']."%' or blood_group like '".$get['search']."%' or email like '".$get['search']."%' or phone like '".$get['search']."%' or address like '".$get['search']."%' and ":"";
$page = !empty($get['page']) ? intval($get['page']) : 1;
$limit = 10;
$start = $page && $page > 1 ? ($page-1)*$limit : 0;
$where = '';
//$where = !empty($get['date'])?" and now like '".$get['date']."%'":"";
$records = $clsObj->get_records(['table'=>'employees','where'=>"$where1 status='$status' $where",'start'=>$start,'limit'=>$limit,'order'=>"id desc"]);
$total_count = $records ? $clsObj->get_found_rows() : 0;
$pages = $total_count ? ceil($total_count/$limit) : ($records ? 1:0);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Employees List | User Registration</title>
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
                        <?php if($get && !empty($get['type'])){ ?>
                            <h2 class="text-center card-title mb-3"><?php echo $get['type']=='edit'?'Edit':'New'; ?> Employee</h2>
                            <form class="v_form" id="employee-form">
                                <div class="form-group row mb-3">
                                    <div class="col-sm-12">  
                                        <div class="response"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo !empty($get['id'])?$get['id']:''; ?>">
                                <input type="hidden" name="action" value="employeeForm">
                                <div class="form-group row mb-3">
                                    <label for="name" class="col-sm-3 col-form-label mandatory">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" placeholder="Employee Name" value="<?php echo !empty($employee['employee_name'])?$employee['employee_name']:''; ?>">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="designation" class="col-sm-3 col-form-label mandatory">Designation</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="designation" placeholder="Enter Your Designation" value="<?php echo !empty($employee['designation'])?$employee['designation']:''; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label for="dob" class="col-sm-3 col-form-label mandatory">Date Of Birth</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="dob" class="form-control" value="<?php echo !empty($employee['dob'])?$employee['dob']:''; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label for="doj" class="col-sm-3 col-form-label mandatory">Date Of Joining</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="doj" class="form-control" value="<?php echo !empty($employee['doj'])?$employee['doj']:''; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label for="blood_group" class="col-sm-3 col-form-label mandatory">Blood Group</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="blood_group" class="form-control" placeholder="Enter Your Blood Group" value="<?php echo !empty($employee['blood_group'])?$employee['blood_group']:''; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label for="email" class="col-sm-3 col-form-label mandatory">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" placeholder="Enter Email Address" class="form-control" value="<?php echo !empty($employee['email'])?$employee['email']:''; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label for="contact" class="col-sm-3 col-form-label mandatory">Contact</label>
                                    <div class="col-sm-9">
                                        <input type="tel" name="contact" placeholder="Enter Phone Number" class="form-control" value="<?php echo !empty($employee['phone']) ? $employee['phone'] : ''; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label for="address" class="col-sm-3 col-form-label mandatory">Address</label>
                                    <div class="col-sm-9">
                                        <textarea name="address" placeholder="Premenent Address" class="form-control"><?php echo !empty($employee['address']) ? $employee['address'] : '' ; ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label for="idproof" class="col-sm-3 col-form-label mandatory">Id Proof</label>
                                    <div class="col-sm-9">
                                        <select class="form-control custom-form-control" name="idproof">
                                            <option value="">--Select ID Proof--</option>
                                            <option value="1" <?php echo !empty($employee['id_proof']) && $employee['id_proof']==1?'selected="selected"':''; ?>>Aadhar Card</option>
                                            <option value="2" <?php echo !empty($employee['id_proof']) && $employee['id_proof']==2?'selected="selected"':''; ?>>Pan Card</option>
                                            <option value="3" <?php echo !empty($employee['id_proof']) && $employee['id_proof']==3?'selected="selected"':''; ?>>Driving Licence</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label for="proofimg" class="col-sm-3 col-form-label mandatory">Proof Image</label>
                                    <div class="col-sm-9">
                                        <input accept="image/*" type='file' id="imgInp" name="proofimg" />
                                        <img id="profile" src="<?php echo !empty($employee['proofimg']) && file_exists("uploads/employee/".$employee['proofimg'])?"uploads/employee/".$employee['proofimg']:''; ?>" alt="your image" /> &nbsp; &nbsp; 
                                        <small> Preview</small>
                                    </div>
                                </div>
<!--                                <div  class="form-group row mb-3">
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
                                </div>-->

                                <div class="form-group row mb-3 text-center">
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-outline-primary btn-block" value="<?php echo !empty($employee)?'Update':'Create'; ?>">
                                    </div>
                                </div>

                            </form>
                        <?php }else{ ?>
                            <h2 class="text-center card-title mb-3">Employees</h2>
                            <?php if(in_array($sroleId,[1,2])){ ?>
                                <div class="text-center mb-3">
                                    <a href="employees.php?type=add" class="btn btn-sm btn-outline-primary"><i class="fa fa-plus"></i> New Employee</a>
                                </div>
                            <?php } ?>
                            <div class="mb-3 row text-center">
                                <div class="col-sm-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" onclick="employees(1)" value="1" <?php echo $status==1?'checked':''; ?>>
                                        <label class="form-check-label" for="one">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="two" onclick="employees(0)" value="2" <?php echo $status!=1?'checked':''; ?>>
                                        <label class="form-check-label" for="two">Inactive</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8"></div>
                                <div class="col-sm-4">
                                    <form id="searchform" method="get">
                                        <div class="input-group mb-3">
                                            <input type="text" name="search" id="search1" class="form-control" value="<?php echo $get && !empty($get['search'])?$get['search']:''; ?>" placeholder="Search...">
                                            <label class="input-group-text" for="search1"><button type="submit" class="btn btn-sm btn-outline-primary"><i class="fa fa-search"></i></button></label>
                                        </div>                                        
                                    </form>
                                </div>
                            </div>
                            <table class="table table-hover table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Employee Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($records)){ ?>
                                        <?php foreach($records as $r=>$record){ ?>
                                            <tr>
                                                <th><?php echo $r+1; ?></th>
                                                <td><?php echo ucwords($record['employee_name']); ?></td>
                                                <td><?php echo $record['phone']; ?></td>
                                                <td><?php echo $record['email']; ?></td>
                                                <td><?php echo ucwords($record['address']); ?></td>
                                                <td>
                                                    <?php if($record['status']==1 && in_array($sroleId,[1,2])){ ?>
                                                        <a href="employees?id=<?php echo $record['id']; ?>&type=edit" class="btn btn-sm btn-outline-primary"><i class="fa fa-pencil"></i> Edit</a>
                                                    <?php } ?>
                                                        <a href="javascript:;" onclick="ajaxAction({cat: 'employee', id:<?php echo $record['id']; ?>, action: 'statusChange',status:'<?php echo $record['status']==1?'Disable':'Enable'; ?>'})" data-toggle="tooltip" data-title="<?php echo $record['status']==1?'Disable':'Enable'; ?>" class="<?php echo $record['status']==1?'btn-outline-danger':'btn-outline-success'; ?> btn btn-sm" data-original-title="" title=""><?php echo $record['status']==1?'<i class="fa fa-ban"></i> Disable':'<i class="fa fa-check"></i> Enable'; ?></a>
                                                    <?php if($record['status']==0){ ?>
                                                        <a href="javascript:;" onclick="ajaxAction({cat: 'employee', id:<?php echo $record['id']; ?>, action: 'deleteRecord'})" data-toggle="tooltip" data-title="Delete" class="btn-outline-danger btn btn-sm" data-original-title="Delete" title=""><i class="fa fa-trash-alt"></i> Delete</a>
                                                    <?php } ?>
                                                    <?php if($record['status']==1){ ?>
                                                        <a href="view.php?id=<?php echo $record['id']; ?>&type=2" target="_blank" class="btn btn-sm btn-outline-dark"><i class="fa fa-eye"></i> View Details</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php }else{ ?>
                                            <tr>
                                                <td><strong>No Data Found!.</strong></td>
                                            </tr>  
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php if($records > 1){ ?>
                                <ul class="pagination">
                                    <?php if($page !=1) { ?>
                                        <li class="page-item prev">
                                            <a class="page-link" href="javascript:;" onclick="goToPage('employees<?php echo $page !=2 ? '-'.($page-1) .'.html': ''; ?>')">Previous</a>
                                        </li>
                                    <?php }else{ ?>
                                        <li class="page-item prev"><a  class="page-link">Previous</a></li>
                                    <?php } ?>
                                    <?php if($page != 1){ ?>
                                        <li class="page-item"><a class="page-link" href="javascript:;" onclick="goToPage('employees')">1</a></li>
                                    <?php } ?>
                                    <?php echo $page-1 > 2 ? '<li><span>...</span></li>':''; ?>
                                    <?php if($page-1 >= 1 && $page-1 !=1){ ?>
                                        <li class="page-item"><a  class="page-link" href="javascript:;" onclick="goToPage('employees-<?php echo ($page-1); ?>.html')"><?php echo $page-1; ?></a></li>
                                    <?php } ?>
                                        <li class="page-item active"><a class="page-link" href="javascript:;" onclick="goToPage()"><?php echo $page; ?></a></li>
                                    <?php if($page+1 < $pages && $page+1 != $pages){ ?>
                                        <li class="page-item"><a class="page-link" href="javascript:;" onclick="goToPage('<?php echo 'employees-'.($page+1); ?>.html')"><?php echo $page+1; ?></a></li>
                                    <?php } ?>
                                    <?php echo $page+1 < $pages-1 ? '<li><span>...</span></li>':''; ?>
                                    <?php if($page != $pages){ ?>
                                        <li class="page-item"><a class="page-link" href="javascript:;" onclick="goToPage('<?php echo 'employees-'.$pages; ?>.html')"><?php echo $pages; ?></a></li>
                                    <?php } ?>
                                    <?php if($page !=$pages) { ?>
                                        <?php /*<li class="next"><a href="<?php echo 'schools-'.($pages != $page ? ($page+1) : $page); ?>.html"><i class="arrow_right"></i></a></li>*/ ?>
                                        <li class="next"><a  class="page-link" href="javascript:;" onclick="goToPage('<?php echo 'employees-'.($pages != $page ? ($page+1) : $page); ?>.html')">Next</a></li>
                                    <?php }else { ?>
                                        <li class="page-item next"><a  class="page-link">Next</a></li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
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
        <script src="js/custom-script.js"></script>
        <script src="js/form-validation.js"></script>
        <script>
            <?php if(!empty($get['id']) || !empty($get['type'])){ ?>
                imgInp.onchange = evt => {
                    const [file] = imgInp.files
                    if (file) {
                      profile.src = URL.createObjectURL(file)
                    }
                }
            <?php } ?>
            function goToPage(url){let s= '<?php echo $status==1?'status=active':'status=inactive'; ?>';location.href=url+'?'+s;}
            function employees(a){
                let i = a==1?'active':'inactive';
                location.href='employees?status='+i;
            }
        </script>
    </body>
</html>