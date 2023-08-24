<?php
require 'includes/sessioncheck.php';
$getData = filter_input_array(INPUT_GET);
$date = isset($getData['date'])?$getData['date']:date('Y-m-d');
$records = $clsObj->get_records(['table'=>'daily_updates','where'=>"dou='$date' and status=1"]);
$pdata = array();
if($records){
    foreach ($records as $key => $value) {
        $pdata[$value['build']][] = $value;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo SITE_URL.' | Send Mail'; ?></title>
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
                            <h2 class="text-center card-title mb-3">Mail Data</h2>
                            <div style="display:inline-flex">
                                <div class="col-6">
                                    <strong>Subject: Daily Update<?php ?></strong><br>
                                    <strong>Date: <?php echo date("d-M-Y",strtotime($date)); ?></strong>
                                </div>
                                <div class="justify-content-center col-6">
                                    <form name="dateform">
                                        <input type="date" class="form-control">
                                    </form>
                                </div>
                            </div>
                            <br>
                            <strong>Mail Body : </strong>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Build</th>
                                        <th>Tool</th>
                                        <th>Module</th>
                                        <th>Issue</th>
                                        <th>Modified Files</th>
                                        <th>Description</th>
                                        <th>Task Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($records){ ?>
                                        <?php $c=1; foreach($pdata as $pkey=>$precord){ ?>
                                            <?php foreach($precord as $prkey=>$prvalue){ ?>
                                                <tr>
                                                    <td><?php echo $c++; ?></td>
                                                    <td><?php echo $prvalue['build']; ?></td>
                                                    <td><?php echo $prvalue['tool']; ?></td>
                                                    <td><?php echo $prvalue['module']; ?></td>
                                                    <td><?php echo $prvalue['issue']; ?></td>
                                                    <td><?php echo $prvalue['modified_files']; ?></td>
                                                    <td><?php echo $prvalue['description']; ?></td>
                                                    <td><?php echo $prvalue['task_status']== 0?'Pending':($prvalue['task_status'] == 1?'Under Development/Work in progress':($prvalue['task_status'] == 2?'Completed':'Not Required')); ?></td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <tr>
                                            <td>No Data Found!.</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php if(!$records){ ?>
                                <textarea name="mailBody" id="mailBody" placeholder="Please Enter Mail Body" class="form-control"></textarea>
                            <?php } ?>
                            <a href="javascript:;" onclick="mailFunction()" class="btn btn-primary">Send Mail</a>
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
        <script src="js/bootbox.min.js"></script>
        <script type="text/javascript">
            function mailFunction(){
                <?php if($records){ ?>
                    let mailBody = '';
                <?php }else{ ?>
                    let mailBody = $('#mailBody').val();
                <?php } ?>
                //console.log('mailBody '+mailBody);return false;
                $.post('mailController',{action:'SendingDailyUpdate',date:'<?php echo $date; ?>',mailBody:mailBody}, 
                    function(response) {
                       if(response){
                           if(response.hasOwnProperty("status") && response.status == 'OK'){
                                bootbox.dialog({message:response.message});return false;
                           }else{
                                bootbox.dialog({message:response.message});return false;
                           }
                       }
                },'json');
            }
        </script>
    </body>
</html>