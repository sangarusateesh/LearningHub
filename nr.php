<?php
require 'includes/conf.php';
$taskStatus = ['Pending','Under Development/Work in progress','Completed','Not Required','Testing'];
$getdata = filter_input_array(INPUT_GET);
$postdata = filter_input_array(INPUT_POST);
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
                        <h2 class="text-center card-title mb-3">Update</h2>
                        <form class="v_form" name="gggg" id="daily_update-form">
                            <div class="form-group row mb-3">
                                <div class="col-sm-12">  
                                    <div class="response"></div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="">
                            <input type="hidden" name="action" value="dailUpdateForm">

                            <div class="form-group row mb-3">
                                <label for="dou" class="col-sm-3 col-form-label mandatory">Date Of Update</label>
                                <div class="col-sm-9">
                                    <input type="number" min="0" name="dou" id="dou" class="form-control" value="">
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="dou" class="col-sm-3 col-form-label mandatory">From time Block</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="from_block" onchange="SetToBlock(this)" name="from_block" required>
                                        <option value="">Select</option>
                                        <?php for($i=1;$i<=96;$i++){ ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="dou" class="col-sm-3 col-form-label mandatory">To Time Block</label>
                                <div class="col-sm-9">
                                    <select class="form-control to_block" id="to_block" name="to_block" required>
                                        <option value="">Select</option>
                                        <?php for($i=1;$i<=96;$i++){ ?>
                                        <option value="<?php echo $i; ?>" id="Ftb_<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-3 mblocks">
                                <label for="dou" class="col-sm-3 col-form-label mandatory">No.of Mandatory Blocks</label> 
                                <div class='col-sm-9'>
                                    <select class="form-control" id="man_block" name="man_block" required>
                                        <option value="">Select</option>
                                        <?php for($i=1;$i<=96;$i++){ ?>
                                        <option value="<?php echo $i; ?>" id="mtb_<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <label class="col-sm-4 control-label label-error"><span style='color:red' id='error_link'></span></label>
                            </div>

                            <div class="form-group row mb-3 text-center">
                                <div class="col-sm-12">
                                    <input type="submit" class="btn btn-outline-primary btn-block" value="<?php echo !empty($employee)?'Update':'Create'; ?>">
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
        <script src="js/custom-script.js"></script>
        <script src="js/form-validation.js"></script>
        <script type="text/javascript">
            function SetToBlock(e){
                let value = parseInt(e.value);
                for(let i=1;i<=96;i++){
                    $('#Ftb_'+i).prop('disabled', false);
                    if(i<value){
                        $('#Ftb_'+i).prop('disabled', true);
                    }
                }
                // for(let i=1;i<value;i++){
                //     $('#Ftb_'+i).prop('disabled', true);
                // }
            }

            $("#to_block").on('change', function(){
                let value = $(this).val();
                let fromBlockValue = $('#from_block').find(":selected").val();
                let to_block = $('#to_block').find(":selected").val();
                let man_block = $('#man_block').find(":selected").val();
                value = parseInt(value);
                fromBlockValue = parseInt(fromBlockValue);
                to_block = parseInt(to_block);
                man_block = parseInt(man_block);
                if(value > fromBlockValue){
                    toastr.error("","Select Valid To Time Block", {timeOut: 5000,positionClass: "toast-top-right"});
                    return false;
                }
                if(fromBlockValue != to_block){
                    let currentValue = to_block-fromBlockValue;
                    for(let j = 1;j<=96;j++){
                        $('#mtb_'+j).prop('disabled', false);
                        if(currentValue<j && currentValue !== 0){
                            console.log('step 1',j);
                            $('#mtb_'+j).prop('disabled', true);
                        }else if(currentValue == 0){
                            $('#mtb_1').prop('disabled', true);
                        }
                    }
                }
            });
        </script>
        <script>
            $("#dou").click(function(){
                console.log('gggg');
                let value = document.gggg.dou.value;
                console.log('value '+value);
                if(parseInt(value)<0){
                    $('#dou').val(1);
                }
            });
        </script>
    </body>
</html>