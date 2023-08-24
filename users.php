<?php
$get = filter_input_array(INPUT_GET ,FILTER_SANITIZE_STRING);
require 'includes/sessioncheck.php';
if(!in_array($sroleId,[1,2])){header("Location:".SITE_URL);exit;}
$getdata = filter_input_array(INPUT_GET);//print_r($getdata);exit;
$postdata = filter_input_array(INPUT_POST);
$status=1;
if($get && !empty($get['status'])){
    if($get['status']=='active'){
        $status=1;
    }else{
        $status=0;
    }
}
$page = !empty($get['page']) ? intval($get['page']) : 1;
$limit = 10;
$start = $page && $page > 1 ? ($page-1)*$limit : 0;
$where = '';
if($sroleId==1){
    $where = "id!='$suserId' and";
}else if($sroleId==2){
    $where = "id!='$suserId' and role!=1 and";
}
$where1 = $get && !empty($get['search'])?" name like '".$get['search']."%' or mobile like '".$get['search']."%' or email like '".$get['search']."%' or address like '".$get['search']."%' or date_of_birth like '".$get['search']."%' and ":"";
$records = $clsObj->get_records(['table'=>'users','where'=>"$where $where1 status='$status'",'start'=>$start,'limit'=>$limit,'order'=>"id desc"]);
$total_count = $records ? $clsObj->get_found_rows() : 0;
$pages = $total_count ? ceil($total_count/$limit) : ($records ? 1:0);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User's List | User Registration</title>
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
                            <h2 class="text-center card-title mb-3">New User</h2>
                            <form class="v_form" id="register-form">
                                <div class="form-group row mb-3">
                                    <div class="col-sm-12">  
                                        <div class="response"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="action" value="registerForm">
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
                                
                                <div class="form-group row mb-3">
                                    <label for="profile" class="col-sm-3 col-form-label mandatory">Profile Photo</label>
                                    <div class="col-sm-9">
                                        <input accept="image/*" type='file' id="imgInp" name="profileimg" />
                                        <img id="profile" src="#" alt="your image" /> &nbsp; &nbsp; 
                                        <small> Preview</small>
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label for="sign" class="col-sm-3 col-form-label mandatory">Signature</label>
                                    <div class="col-sm-9">
                                        <input accept="image/*" type='file' id="sign" name="sign" />
                                        <img id="sign1" src="#" alt="your image" /> &nbsp; &nbsp; 
                                        <small> Preview</small>
                                    </div>
                                </div>
                                <div class="form-group row mb-3 text-center">
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-outline-primary btn-block" value="Create">
                                    </div>
                                </div>

                            </form>
                        <?php }else{ ?>
                            <h2 class="text-center card-title mb-3">User's</h2>
                            <?php if(!empty($sroleId) && $sroleId!=3){ ?>
                            <div class="row">
                                <div class="text-center mb-3">
                                    <a href="users.php?type=add" class="btn btn-sm btn-outline-primary"><i class="fa fa-plus"></i> New User</a>
                                </div>
                            </div>
                            <?php } ?><br>
                            
                            <div class="mb-3 row text-center">
                                <div class="col-sm-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" onclick="users(1)" value="1" <?php echo $status==1?'checked':''; ?>>
                                        <label class="form-check-label" for="active">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" onclick="users(0)" value="2" <?php echo $status!=1?'checked':''; ?>>
                                        <label class="form-check-label" for="inactive">Inactive</label>
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
                                        <th>Role</th>
                                        <th>User Name</th>
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
                                                <td><?php echo $r+1; ?></td>
                                                <td><?php echo $record['role']==2?'Admin':'User'; ?></td>
                                                <td><?php echo ucwords($record['name']); ?></td>
                                                <td><?php echo $record['mobile']; ?></td>
                                                <td><?php echo $record['email']; ?></td>
                                                <td><?php echo ucwords($record['address']); ?></td>
                                                <td>
                                                    <?php if($record['status']==1 && in_array($sroleId,[1,2])){ ?>
                                                        <a href="profile.php?id=<?php echo $record['id']; ?>" target='_blank' class="btn btn-sm btn-outline-primary"><i class="fa fa-pencil"></i> Edit</a>
                                                    <?php } ?>
                                                    <a href="javascript:;" onclick="ajaxAction({cat: 'user', id:<?php echo $record['id']; ?>, action: 'statusChange',status:'<?php echo $record['status']==1?'Disable':'Enable'; ?>'})" class="btn btn-sm <?php echo $record['status']==1?'btn-outline-danger':'btn-outline-success'; ?>"><?php echo $record['status']==1?'<i class="fa fa-ban"></i> Disable':'<i class="fa fa-check"></i> Enable'; ?></a>
                                                    <?php if($record['status']==0){ ?>
                                                        <a href="javascript:;" onclick="ajaxAction({cat: 'user', id:<?php echo $record['id']; ?>, action: 'deleteRecord'})" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash-alt"></i> Delete</a>
                                                    <?php } ?>
                                                    <?php if($record['status']==1){ ?>
                                                        <a href="view.php?id=<?php echo $record['id']; ?>&type=1" target="_blank" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i> View Details</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php }else{ ?>
                                            <tr>
                                                <td><strong>No Data found!.</strong></td>
                                            </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php if($records > 1){ ?>
                                        <ul class="pagination">
                                            <?php if($page !=1) { ?>
                                                <li class="page-item prev">
                                                    <a class="page-link" href="javascript:;" onclick="goToPage('users<?php echo $page !=2 ? '-'.($page-1) .'.html': ''; ?>')">Previous</a>
                                                </li>
                                            <?php }else{ ?>
                                                <li class="page-item prev"><a  class="page-link">Previous</a></li>
                                            <?php } ?>
                                            <?php if($page != 1){ ?>
                                                <li class="page-item"><a class="page-link" href="javascript:;" onclick="goToPage('users')">1</a></li>
                                            <?php } ?>
                                            <?php echo $page-1 > 2 ? '<li><span>...</span></li>':''; ?>
                                            <?php if($page-1 >= 1 && $page-1 !=1){ ?>
                                                <li class="page-item"><a  class="page-link" href="javascript:;" onclick="goToPage('users-<?php echo ($page-1); ?>.html')"><?php echo $page-1; ?></a></li>
                                            <?php } ?>
                                                <li class="page-item active"><a class="page-link" href="javascript:;" onclick="goToPage()"><?php echo $page; ?></a></li>
                                            <?php if($page+1 < $pages && $page+1 != $pages){ ?>
                                                <li class="page-item"><a class="page-link" href="javascript:;" onclick="goToPage('<?php echo 'users-'.($page+1); ?>.html')"><?php echo $page+1; ?></a></li>
                                            <?php } ?>
                                            <?php echo $page+1 < $pages-1 ? '<li><span>...</span></li>':''; ?>
                                            <?php if($page != $pages){ ?>
                                                <li class="page-item"><a class="page-link" href="javascript:;" onclick="goToPage('<?php echo 'users-'.$pages; ?>.html')"><?php echo $pages; ?></a></li>
                                            <?php } ?>
                                            <?php if($page !=$pages) { ?>
                                                <li class="next"><a  class="page-link" href="javascript:;" onclick="goToPage('<?php echo 'users-'.($pages != $page ? ($page+1) : $page); ?>.html')">Next</a></li>
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
                sign.onchange = evt => {
                    const [file] = sign.files
                    if (file) {
                      sign1.src = URL.createObjectURL(file)
                    }
                }
            <?php } ?>
            function users(a){
                let i = a==1?'active':'inactive';
                location.href='users?status='+i;
            }
            function goToPage(url){let s= '<?php echo $status==1?'status=active':'status=inactive'; ?>';/*console.log(url+'?'+s);return false;*/ location.href=url+'?'+s;}
        </script>
    </body>
</html>