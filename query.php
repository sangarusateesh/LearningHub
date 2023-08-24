<?php
require 'includes/conf.php';
if(isset($_SESSION[SESSION_VAR])){
    require 'includes/sessioncheck.php';
    $title = 'Query Form';
}else{
    require 'classes/cls.php';
    $clsObj = new Cls();
    $title = 'Query List';
}
$get = filter_input_array(INPUT_GET);
if(!empty($get) && !empty($get['type'])){
    if(!in_array($sroleId,[1,2])){header("Location:".SITE_URL."/query.php?status=active");exit;}
}
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
    // if(!$get['id']){header("Location:query?status=active");exit;}
    $query = $clsObj->get_record(['table'=>'queries','where'=>"id='".$get['id']."'"]);
    // print_r($query);die;
}
$where1 = $get && !empty($get['search'])?" database_name like '".$get['search']."%' or table_name like '".$get['search']."%' and ":"";
$page = !empty($get['page']) ? intval($get['page']) : 1;
$limit = 10;
$start = $page && $page > 1 ? ($page-1)*$limit : 0;
$where = '';
//$where = !empty($get['date'])?" and now like '".$get['date']."%'":"";
$records = $clsObj->get_records(['table'=>'queries','where'=>"$where1 status='$status' $where",'start'=>$start,'limit'=>$limit,'order'=>"id desc"]);
$total_count = $records ? $clsObj->get_found_rows() : 0;
$pages = $total_count ? ceil($total_count/$limit) : ($records ? 1:0);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo isset($title)?SITE_NAME.' | '.$title:SITE_NAME ; ?></title>
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
                        <?php if($get && !empty($get['type'])){ ?>
                            <h2 class="text-center card-title mb-3"><?php echo $title; ?></h2>
                            <form class="v_form" id="register-form">
                                <input type="hidden" name="id" value="<?php echo !empty($get['type']) && $get['type'] == 'edit'?$get['id']:''; ?>">
                                <div class="form-group row mb-3">
                                    <div class="col-sm-12">  
                                        <div class="response"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="action" value="queryForm">
                                <div class="form-group row mb-3">
                                    <label for="database_name" class="col-sm-3 col-form-label mandatory">Database Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="database_name" placeholder="Database Name" value="<?php echo $get['type'] == 'edit' && !empty($query['database_name'])?$query['database_name']:''; ?>">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="contact" class="col-sm-3 col-form-label mandatory">Table Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="table_name" placeholder="Table Name" class="form-control" value="<?php echo $get['type'] == 'edit' && !empty($query['table_name'])?$query['table_name']:''; ?>">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="address" class="col-sm-3 col-form-label mandatory">Query</label>
                                    <div class="col-sm-9">
                                        <textarea name="query" placeholder="Query" class="form-control">
                                        <?php echo $get['type'] == 'edit' && !empty($query['query'])?$query['query']:''; ?>
                                        </textarea>
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
                            <?php }else{ ?>
                                <h2 class="text-center card-title mb-3">Query List</h2>
                            <?php if(isset($sroleId) && in_array($sroleId,[1,2])){ ?>
                                <div class="text-center mb-3">
                                    <a href="query.php?type=add" class="btn btn-sm btn-outline-primary"><i class="fa fa-plus"></i> New Query</a>
                                </div>
                            <?php } ?>
                            <div class="mb-3 row text-center">
                                <div class="col-sm-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" onclick="query(1)" value="1" <?php echo $status==1?'checked':''; ?>>
                                        <label class="form-check-label" for="one">Active</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="two" onclick="query(0)" value="2" <?php echo $status!=1?'checked':''; ?>>
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
                                        <th>Database Name</th>
                                        <th>Table Name</th>
                                        <th>Query</th>
                                        <th>Added On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($records)){ ?>
                                        <?php foreach($records as $r=>$record){ ?>
                                            <tr>
                                                <th><?php echo $r+1; ?></th>
                                                <td><?php echo ucwords($record['database_name']); ?></td>
                                                <td><?php echo $record['table_name']; ?></td>
                                                <td><?php echo $record['query']; ?></td>
                                                <td><?php echo date("d-M-Y h:i a",strtotime($record['now'])); ?></td>
                                                <td>
                                                    <?php if($record['status'] == 1 && isset($sroleId) && in_array($sroleId,[1,2])){ ?>
                                                        <a href="query?id=<?php echo $record['id']; ?>&type=edit" class="btn btn-sm btn-outline-primary"><i class="fa fa-pencil"></i></a>
                                                    <?php } ?>
                                                        <a href="javascript:;" onclick="ajaxAction({cat: 'query', id:<?php echo $record['id']; ?>, action: 'statusChange',status:'<?php echo $record['status']==1?'Disable':'Enable'; ?>'})" data-toggle="tooltip" data-title="<?php echo $record['status']==1?'Disable':'Enable'; ?>" class="<?php echo $record['status']==1?'btn-outline-danger':'btn-outline-success'; ?> btn btn-sm" data-original-title="" title=""><?php echo $record['status']==1?'<i class="fa fa-ban"></i>':'<i class="fa fa-check"></i>'; ?></a>
                                                    <?php if($record['status']==0){ ?>
                                                        <a href="javascript:;" onclick="ajaxAction({cat: 'query', id:<?php echo $record['id']; ?>, action: 'deleteRecord'})" data-toggle="tooltip" data-title="Delete" class="btn-outline-danger btn btn-sm" data-original-title="Delete" title=""><i class="fa fa-trash-alt"></i> Delete</a>
                                                    <?php } ?>
                                                    <?php if($record['status']==1){ ?>
                                                        <a href="view.php?id=<?php echo $record['id']; ?>&type=2" target="_blank" class="btn btn-sm btn-outline-dark"><i class="fa fa-eye"></i></a>
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
                                            <a class="page-link" href="javascript:;" onclick="goToPage('query<?php echo $page !=2 ? '-'.($page-1) .'.html': ''; ?>')">Previous</a>
                                        </li>
                                    <?php }else{ ?>
                                        <li class="page-item prev"><a  class="page-link">Previous</a></li>
                                    <?php } ?>
                                    <?php if($page != 1){ ?>
                                        <li class="page-item"><a class="page-link" href="javascript:;" onclick="goToPage('query')">1</a></li>
                                    <?php } ?>
                                    <?php echo $page-1 > 2 ? '<li><span>...</span></li>':''; ?>
                                    <?php if($page-1 >= 1 && $page-1 !=1){ ?>
                                        <li class="page-item"><a  class="page-link" href="javascript:;" onclick="goToPage('query-<?php echo ($page-1); ?>.html')"><?php echo $page-1; ?></a></li>
                                    <?php } ?>
                                        <li class="page-item active"><a class="page-link" href="javascript:;" onclick="goToPage()"><?php echo $page; ?></a></li>
                                    <?php if($page+1 < $pages && $page+1 != $pages){ ?>
                                        <li class="page-item"><a class="page-link" href="javascript:;" onclick="goToPage('<?php echo 'query-'.($page+1); ?>.html')"><?php echo $page+1; ?></a></li>
                                    <?php } ?>
                                    <?php echo $page+1 < $pages-1 ? '<li><span>...</span></li>':''; ?>
                                    <?php if($page != $pages){ ?>
                                        <li class="page-item"><a class="page-link" href="javascript:;" onclick="goToPage('<?php echo 'query-'.$pages; ?>.html')"><?php echo $pages; ?></a></li>
                                    <?php } ?>
                                    <?php if($page !=$pages) { ?>
                                        <?php /*<li class="next"><a href="<?php echo 'schools-'.($pages != $page ? ($page+1) : $page); ?>.html"><i class="arrow_right"></i></a></li>*/ ?>
                                        <li class="next"><a  class="page-link" href="javascript:;" onclick="goToPage('<?php echo 'query-'.($pages != $page ? ($page+1) : $page); ?>.html')">Next</a></li>
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
        <script src="js/form-validation.js"></script>
        <script type="text/javascript">
            function goToPage(url){let s= '<?php echo $status==1?'status=active':'status=inactive'; ?>';location.href=url+'?'+s;}
            function query(a){
                let i = a==1?'active':'inactive';
                location.href='query?status='+i;
            }                           
        </script>
    </body>
</html>