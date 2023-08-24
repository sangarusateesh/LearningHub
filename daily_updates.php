<?php
require 'includes/conf.php';
$get = filter_input_array(INPUT_GET);
if(isset($_SESSION[SESSION_VAR])){
    require 'includes/sessioncheck.php';
    $title = 'Daily Update';
    if(isset($get['type']) && in_array($get['type'],['edit','add']) && in_array($sroleId,[1,2])){
        $type = true;
    }else{
        $title = 'Daily Updates List';
        $type = false;
    }
}else{
    require 'classes/cls.php';
    $clsObj = new Cls();
    $title = 'Daily Updates List';
    $type = false;
}
$taskStatus = ['Pending','Under Development/Work in progress','Completed','Not Required','Testing'];
$getdata = filter_input_array(INPUT_GET);
$postdata = filter_input_array(INPUT_POST);
$status = 1;
if($get && !empty($get['status'])){
    if($get['status'] == 'active'){
        $status = 1;
    }else{
        $status = 0;
    }
}
if($get && !empty($get['type']) && $get['type'] == 'edit'){
    if(!$get['id']){header("Location:daily_updates?status=active");exit;}
    $employee = $clsObj->get_record(['table'=>'daily_updates','where'=>"id='".$get['id']."'"]);//print_r($employee);exit;
}
$where1 = $get && !empty($get['search'])?" dou like '".$get['search']."%' or build like '".$get['search']."%' or tool like '".$get['search']."%' or module like '".$get['search']."%' or issue like '".$get['search']."%' or modified_files like '".$get['search']."%' or description like '".$get['search']."%' and ":"";
// echo 'where1 '.$where1;die;
$where1.=isset($get['date'])?"dou='".date("Y-m-d",strtotime($get['date']))."' and ":"";
// echo 'where1 '.$where1;die;
$page = !empty($get['page']) ? intval($get['page']) : 1;
$limit = 10;
$start = $page && $page > 1 ? ($page-1)*$limit : 0;
$where = '';
$records = $clsObj->get_records(['table'=>'daily_updates','where'=>"$where1 status='$status' $where",'start'=>$start,'limit'=>$limit,'order'=>"id desc"]);
$total_count = $records ? $clsObj->get_found_rows() : 0;
$pages = $total_count ? ceil($total_count/$limit) : ($records ? 1:0);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo isset($title)?SITE_NAME.' | '.$title:SITE_NAME; ?></title>
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
                        <?php if($type){ ?>
                            <h2 class="text-center card-title mb-3"><?php echo $get['type']=='edit'?'Edit':'New'; ?> Update</h2>
                            <form class="v_form" id="daily_update-form">
                                <div class="form-group row mb-3">
                                    <div class="col-sm-12">  
                                        <div class="response"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="<?php echo !empty($get['id'])?$get['id']:''; ?>">
                                <input type="hidden" name="action" value="dailUpdateForm">

                                <div class="form-group row mb-3">
                                    <label for="dou" class="col-sm-3 col-form-label mandatory">Date Of Update</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="dou" class="form-control" value="<?php echo !empty($employee['dou'])?$employee['dou']:''; ?>">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="dou" class="col-sm-3 col-form-label mandatory">Status</label>
                                    <div class="col-sm-9">
                                        <select name="taskStatus" class="form-control">
                                            <option value="">--Select--</option>
                                            <?php foreach($taskStatus as $tkey=>$tvalue){ ?>
                                                <option value="<?php echo $tkey; ?>" <?php echo isset($employee['task_status']) && $tkey == $employee['task_status']?'selected':''; ?>><?php echo $tvalue; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="build_name" class="col-sm-3 col-form-label mandatory">Build Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="build_name" placeholder="Build Name" value="<?php echo !empty($employee['build'])?$employee['build']:''; ?>">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="tool" class="col-sm-3 col-form-label mandatory">Tool</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="tool" placeholder="Enter Tool" value="<?php echo !empty($employee['tool'])?$employee['tool']:''; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label for="module" class="col-sm-3 col-form-label mandatory">Module</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="module" class="form-control" placeholder="Enter Module" value="<?php echo !empty($employee['module'])?$employee['module']:''; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label for="issue" class="col-sm-3 col-form-label mandatory">Issue</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="issue" placeholder="Enter Issue" class="form-control" value="<?php echo !empty($employee['issue'])?$employee['issue']:''; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group row mb-3">
                                    <label for="modifiedFiles" class="col-sm-3 col-form-label mandatory">Modified Files</label>
                                    <div class="col-sm-9">
                                        <textarea name="modifiedFiles" placeholder="Enter Modified Files with comma(,) separate" class="form-control"><?php echo !empty($employee['modified_files']) ? $employee['modified_files'] : '' ; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="description" class="col-sm-3 col-form-label mandatory">Description</label>
                                    <div class="col-sm-9">
                                        <textarea name="description" placeholder="Description" class="form-control"><?php echo !empty($employee['description']) ? $employee['description'] : '' ; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group row mb-3 text-center">
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-outline-primary btn-block" value="<?php echo !empty($employee)?'Update':'Create'; ?>">
                                    </div>
                                </div>

                            </form>
                        <?php }else{ ?>
                            <h2 class="text-center card-title mb-3"><?php echo 'Daily Update List'; ?></h2>
                            <?php if(isset($sroleId) && in_array($sroleId,[1,2])){ ?>
                                <div class="text-center mb-3">
                                    <a href="daily_updates.php?type=add" class="btn btn-sm btn-outline-primary"><i class="fa fa-plus"></i> New Update</a>
                                </div>
                            <?php } ?>
                            <div class="mb-3 row text-center">
                                <div class="col-sm-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" onclick="daily_updates(1)" value="1" <?php echo $status==1?'checked':''; ?>>
                                        <label class="form-check-label" for="one">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="two" onclick="daily_updates(0)" value="2" <?php echo $status!=1?'checked':''; ?>>
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
                                        <th>Date</th>
                                        <th>Build</th>
                                        <th>Tool</th>
                                        <th>Issue</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($records)){ ?>
                                        <?php foreach($records as $r=>$record){ ?>
                                            <tr>
                                                <th><?php echo $r+1; ?></th>
                                                <td><?php echo date("d-M-Y",strtotime($record['dou']))  ; ?></td>
                                                <td><?php echo $record['build']; ?></td>
                                                <td><?php echo $record['tool']; ?></td>
                                                <td><?php echo $record['issue']; ?></td>
                                                <td>
                                                    <?php echo $record['status']==0?'Pending':($record['status'] == 1?'Completed':'Not Required'); ?>
                                                </td>
                                                <td>
                                                    <?php if($record['status']==1 && isset($sroleId) &&  in_array($sroleId,[1,2])){ ?>
                                                        <a href="daily_updates?id=<?php echo $record['id']; ?>&type=edit" class="btn btn-sm btn-outline-primary"><i class="fa fa-pencil"></i> Edit</a>
                                                    <?php } ?>
                                                    <?php if(isset($sroleId) && in_array($sroleId,[1,2])){ ?>
                                                        <a href="javascript:;" onclick="ajaxAction({cat: 'daily_update', id:<?php echo $record['id']; ?>, action: 'statusChange',status:'<?php echo $record['status']==1?'Disable':'Enable'; ?>'})" data-toggle="tooltip" data-title="<?php echo $record['status']==1?'Disable':'Enable'; ?>" class="<?php echo $record['status']==1?'btn-outline-danger':'btn-outline-success'; ?> btn btn-sm" data-original-title="" title=""><?php echo $record['status']==1?'<i class="fa fa-ban"></i> Disable':'<i class="fa fa-check"></i> Enable'; ?></a>
                                                    <?php } ?>
                                                        <?php if($record['status']==0){ ?>
                                                        <a href="javascript:;" onclick="ajaxAction({cat: 'daily_update', id:<?php echo $record['id']; ?>, action: 'deleteRecord'})" data-toggle="tooltip" data-title="Delete" class="btn-outline-danger btn btn-sm" data-original-title="Delete" title=""><i class="fa fa-trash-alt"></i> Delete</a>
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
                                            <a class="page-link" href="javascript:;" onclick="goToPage('daily_updates<?php echo $page !=2 ? '-'.($page-1) .'.html': ''; ?>')">Previous</a>
                                        </li>
                                    <?php }else{ ?>
                                        <li class="page-item prev"><a  class="page-link">Previous</a></li>
                                    <?php } ?>
                                    <?php if($page != 1){ ?>
                                        <li class="page-item"><a class="page-link" href="javascript:;" onclick="goToPage('daily_updates')">1</a></li>
                                    <?php } ?>
                                    <?php echo $page-1 > 2 ? '<li><span>...</span></li>':''; ?>
                                    <?php if($page-1 >= 1 && $page-1 !=1){ ?>
                                        <li class="page-item"><a  class="page-link" href="javascript:;" onclick="goToPage('daily_updates-<?php echo ($page-1); ?>.html')"><?php echo $page-1; ?></a></li>
                                    <?php } ?>
                                        <li class="page-item active"><a class="page-link" href="javascript:;" onclick="goToPage()"><?php echo $page; ?></a></li>
                                    <?php if($page+1 < $pages && $page+1 != $pages){ ?>
                                        <li class="page-item"><a class="page-link" href="javascript:;" onclick="goToPage('<?php echo 'daily_updates-'.($page+1); ?>.html')"><?php echo $page+1; ?></a></li>
                                    <?php } ?>
                                    <?php echo $page+1 < $pages-1 ? '<li><span>...</span></li>':''; ?>
                                    <?php if($page != $pages){ ?>
                                        <li class="page-item"><a class="page-link" href="javascript:;" onclick="goToPage('<?php echo 'daily_updates-'.$pages; ?>.html')"><?php echo $pages; ?></a></li>
                                    <?php } ?>
                                    <?php if($page !=$pages) { ?>
                                        <?php /*<li class="next"><a href="<?php echo 'schools-'.($pages != $page ? ($page+1) : $page); ?>.html"><i class="arrow_right"></i></a></li>*/ ?>
                                        <li class="next"><a  class="page-link" href="javascript:;" onclick="goToPage('<?php echo 'daily_updates-'.($pages != $page ? ($page+1) : $page); ?>.html')">Next</a></li>
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
        <script type="text/javascript">
            function goToPage(url){let s= '<?php echo $status==1?'status=active':'status=inactive'; ?>';location.href=url+'?'+s;}
            function daily_updates(a){
                let i = a==1?'active':'inactive';
                location.href='daily_updates?status='+i;
            }                           
        </script>
    </body>
</html>