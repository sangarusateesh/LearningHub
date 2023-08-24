function isObject (value) {return value && typeof value === 'object' && value.constructor === Object;}
function isArray (value) {return value && typeof value === 'object' && value.constructor === Array;}
function IsJsonString(str) {try {JSON.parse(str);} catch (e) {return false;}return true;}
function isString (value) {return typeof value === 'string' || value instanceof String;}
function b64_to_utf8(str){return decodeURIComponent(escape(window.atob(str)));}
function capitalize_Words(str){return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});}
function do_action(ptdata){
    Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ef5350",
        confirmButtonText: "Yes, delete it!",
        reverseButtons: true
    }).then((result) => {
        if (result.value) {ajaxAction(ptdata);}
    });
}
function ajaxAction(ptdata){
    $.post('controller',ptdata,
    function(response){
        if(response && isObject(response)){
            if(response.hasOwnProperty("status") && response.status == 'OK'){
                alert(response.msg);return false;
            }else{
                alert(response.error);return false;
            }
        }
    },'json');
}
function decrementValue(e,id,ref,avail){
    var c = $('#qty_'+id).val();
    if(avail && c>avail){
        bootbox.dialog({centerVertical:true,message:"<strong>Only "+(avail==1?'1 Item':avail+' Items')+" left in stock.</strong>"}).find('.modal-content').css({
            'font-size':'17px',
        });
        return false;
    }
    var v=parseInt(c)-1;
    change_cart({id:id,e:e,v:v,reference:ref});
}
function incrementValue(e,id,ref){
    var a = $('#qty_'+id).val();
    v =parseInt(a)+1;
    change_cart({id:id,e:e,v:v,reference:ref});
}
function change_cart(j){
if(j.v<=0 && j.type != 'delete'){$(j.e).parent().find('input').val(1);return false;}
    $.post('controller',{action:j.reference=='buy'?'buyproduct':'changecart',id:j.id,qty:j.v,page:j.page?j.page:'cart'},
        function(response){
            if(response && isObject(response)){
                if(response.hasOwnProperty("status") && response.status == 'OK'){
                    if(parseInt(response.data.mrp)>0){
                        if(response.data.item_dtotal!=''){$('.itm_disc_'+j.id).html('<i class="fa fa-rupee"></i>. '+response.data.item_dtotal+'/-');$('.item_actl_'+j.id).html(' &nbsp &nbsp <del> <i class="fa fa-rupee"></i>. '+response.data.item_atotal+' /-</del<');}else{$('.item_actl_'+j.id).html('<i class="fa fa-rupee"></i>. '+response.data.item_atotal+'/-');}
//                        $('.item_actl_'+j.id).html(response.data.item_dtotal!=0?' &nbsp; &nbsp; <del>Rs. '+response.data.item_atotal+'</del>':'');
                        if(response.data.item_dtotal!=''){$('.discount_'+j.id).html('You Save Rs. '+(parseInt(response.data.item_atotal) - parseInt(response.data.item_dtotal))+'/-');}
                        $('.discount').html('<b>-<i class="fa fa-rupee"></i> '+response.data.total_discount+'</b>');
                        $('.disc_amount_'+j.id).html('You Save <i class="fa fa-rupee"></i> Rs.'+(response.data.item_atotal-response.data.item_dtotal)+'/-');
                        $('.item_total_'+j.id).html(response.data.item_total);
                        $('#qty_'+j.id).val(response.data.qty);
                        $('.whole_price').html(response.data.total);
                        $('.total_disc').html(response.data.total_discount);
                        $('.delivery').html(response.data.delivery_charges);
                        $('.mrp').html(response.data.mrp);
                    }else{
                        $('.cart_info').html('<div class="text-center p-2" >Your Cart is Empty.</div>');
                        $('#sub_total').html(0);
                        $('.check_out').remove();
                        $('.cart_count').html(0);
                        $('#total_price').html(0);
                    }
                    $.toast({text:'<strong>'+response.msg+'</strong>',position:'top-right',bgColor:'#00c4cc',loaderBg:'#ff6849',icon: 'success',hideAfter: 3500,stack: 8});
                }else{
                    $.toast({text:'<strong>'+response.error+'</strong>',position:'top-right',bgColor:'#ff99cc',loaderBg:'#ec2808',icon: 'warning',hideAfter: 3500,stack: 8});
                }
            }
    },'json').fail(function(jqXHR, textStatus, errorThrown){ console.log(jqXHR, textStatus, errorThrown);
        if(jqXHR.status==401){ $('#myModal').modal('toggle'); }
    });
}
$('.add_new_delivery_address').click(function(){
    $("[name='name']").val('');
    $("[name='pincode']").val('');
    $("[name='phone']").val('');
    $("[name='address'").val('');
    $("[name='id']").val('');
    $("[name='state']").val('');
});
function chnageOrdr(a,data){
    bootbox.prompt({
        title: "Request to "+(a==4?'Return':'Cancel')+" this item?",
        inputType:"textarea",
        placeholder: 'Write the Reason for '+(a==4?"Return":"Cancel")+' this item...',
        rows:'4',
        callback: function (result){
            if(result==''){bootbox.dialog({/*centerVertical:true,*/ message:"<p class='text-danger'>Plese enter Reason for "+(a==3?'Return':'Cancel')+" the Item!.</p>"}).find('.modal-content').css({'font-size':'17px',});return false;}
            if(result!='' && result!==null){
            $.post('controller',{action:'chnageOrdr',id:data,reason:result,stat:a},
            function(response){
                if(response && isObject(response)){
                    if(response.hasOwnProperty("status") && response.status == 'OK'){
                        location.reload(true);
                    }else{
                        bootbox.dialog({/*centerVertical:true,*/ message:"<p class='text-danger'>"+response.error+"</p>"}).find('.modal-content').css({'font-size':'17px',});return false;
                    }
                }
            },'json');
        }
        }
    });
}
$('.short-by').on('change', function(){var shortby = this.value;var cslug = $('#cslug').val();if(shortby!='all'){location.href='shop/'+cslug+'/'+shortby;}else{location.href='shop/'+cslug;}});
function saveTocart(data){
    $.post('controller',{action:'scart',id:data.id},
    function(response){
        if(response && isObject(response)){
            if(response.hasOwnProperty("status") && response.status == 'OK'){
                $(data.e).html('<i class="fa fa-heart" style="color:#00c4cc"></i>');
                if(response.type=='add'){
                    $.toast({text: '<strong>'+response.msg+'</strong>',position: 'top-right',bgColor:'#00c4cc',loaderBg:'#00c4cc',icon: 'success',hideAfter: 3500,stack: 8});
                }else{
                    $(data.e).html('<i class="fa fa-heart-o"></i>');
                    $.toast({text: '<strong>'+response.msg+'</strong>',position: 'top-right',bgColor:'#e87f89',loaderBg:'#DC3545',icon: 'warning',hideAfter: 3500,stack: 8});
                    return false;
                }
            }else{location.href=site_url+'/login';}
        }
    },'json');
}
function removeItem(a){
//    const arr = ["a", "b", "c", "d", "e", "a", "b", "c", "f", "g", "h", "h", "h", "e","a", "a"]
//const arr = [2016,2016,2017,2018,2018,2016,2019,2020,2021];
//const counts = {};
//arr.forEach((x) => { //console.log(x);
//  counts[x] = (counts[x] || 0) + 1;//console.log(counts[x]);
//});
//console.log(counts);
//const propertyValues = Object.values(counts);
//console.log(propertyValues);
//return false;
//for(let i=0;i<propertyValues.length;i++){
//    if(propertyValues[i]%2==0){
//        propertyValues[i] = Math.floor(propertyValues[i]/2);
//    }else{
//        propertyValues[i] = propertyValues[i]-1;
//        counts[i] = Math.floor(propertyValues[i]/2);
//    }
//}
//console.log(propertyValues);
//console.log(propertyValues.reduce((a, b) => a + b, 0));return false;
    /*if(a.type==1){*/
        $.post('controller',{action:'removeCart',type:a.type,id:a.id},
        function(response){
            if(response && isObject(response)){
                if(response.hasOwnProperty("status") && response.status == 'OK'){
                    if(a.type==1){
                        if(response.count==0){location.reload(true);}
                        $('#item_'+a.id).remove();
                        $('.cart_count').html(response.count);
                        $('.item_count').html(response.count==1?'1 Item':response.count+' Items');
                        $('.rowtab_'+a.id).remove();
                        $('.mrp').html(response.data.price_total);
                        $('.total_disc').html(response.data.discount);
                        $('.delivery').html(response.data.delivery_charges!=""?'<i class="fa fa-rupee"></i> '+response.data.delivery_charges+' /-':'Free');
                        $('.whole_price').html(response.data.delivery_charges!=''?(response.data.total + parseInt(response.data.delivery_charges)):response.data.total);
                    }else{
                        if(response.count==0){location.reload(true);}
                    }
                    return false;
                }else if(response.hasOwnProperty("error")){
                    location.href='login';return false;
                }
            }
        },'json');
    /*}else{
        bootbox.confirm({
            message: "This confirm uses the selected locale. Were the labels what you expected?",
            callback: function (result) {
                $.post('controller',{action:'delete',id:id,cat:'wish'},
                function(response){
                    if(response && isObject(response)){
                        if(response.hasOwnProperty("status") && response.status == 'OK'){
                            $('#forwish_'+id).remove();
                            return false;
                        }else if(response.hasOwnProperty("error")){
                            location.href='login';
                            return false;
                        }
                    }
                },'json');
            }
        });
    }*/
}
function make_payment(e,type){
    var radioValue = $(".address:checked").val();
    if(radioValue == null || $("input[name='address']:checked").length<=0){
        bootbox.dialog({centerVertical:true,message:"<strong>Please select Delivery Address.</strong>"}).find('.modal-content').css({'font-size':'17px',});return false;
    }
    var b = $("input[name='paymethod']:checked").val();
    if(b == null || $("input[name='paymethod']:checked").length<=0){
        bootbox.dialog({centerVertical:true,message:"<strong>Please select Payment Method.</strong>"}).find('.modal-content').css({'font-size':'17px',});return false;
    }
    $.post('controller',{action:'makepayment',type:type,pay:b,address:radioValue},
    function(response){
        if(response && isObject(response)){
            if(response.hasOwnProperty("status") && response.status == 'OK'){
                if(response.data && response.data.rKey){
                    var options = {
                        "key": response.data.rKey,
                        "amount": response.data.amount, // 2000 paise = INR 20 
                        "name": "Ecommerce",
                        "description": "Order Amount",
                        "order_id": response.data.rzp_order_id,
                        "handler": function (response2){
                            if(response2.razorpay_payment_id){
                                var formdata = new FormData();
                                formdata.append('razorpay_payment_id',response2.razorpay_payment_id);
                                formdata.append('razorpay_order_id',response2.razorpay_order_id);
                                formdata.append('action','updateOrder');
                                $.ajax({
                                    url:'controller',
                                    type:"post",
                                    dataType:'json',
                                    data:formdata,
                                    success:function(response3){
                                        if(response3 && isObject(response3) && response3.status === 'OK'){
                                            window.location.href='payment-success?ord='+response.data.order_id;
                                        }else{
                                            window.location.href='payment-error';
                                        }
                                    },
                                    cache: false,
                                    contentType: false,
                                    processData: false
                                });
                            }
                        },
                        "prefill": {
                            "name": response.data.user_name,
                            "contact": response.data.phone,
                            "email": response.data.email
                        },
                        "notes": {
                            "name": response.data.user_name,
                            "contact": response.data.phone,
                            "email": response.data.email
                        },
                        "theme": {
                            "color": "#1976d2"
                        }
                    };
                    var rzp = new Razorpay(options);
                    rzp.open();
                }else{window.location.href='payment-success?ord='+response.data.order_id;return false;}
            }else if(response.error){
                window.location.href='payment-error';
            }
        }
    },'json');
}
function cart(id,discount,actual,name,img,avail,e){
    $.post('controller',{action:'cart',id:id,discounted_price:discount,actual_price:actual,available:avail,name:name,img:img},function(r){
        $(e).html(r.type==2?'<i class="fa fa-shopping-cart"></i> Item Added':'<i class="fa fa-shopping-cart"></i> Add To Cart');
        $('.cart_count').text(parseInt(r.count));
        location.reload(true);
    },'json');
}
function proceedTObuy(data){checkuser(data);}
function checkuser(data){
    $.post('controller',{action:'checkuser'},
        function(response){
            if(response && isObject(response)){
                if(response.hasOwnProperty("status") && response.status == 'OK'){
                    if(data.ref==2){console.log('ok google');
                        saveTocart({id:data.iid,e:data.e});return false;
                    }else{
                        $.post('controller',{action:"buyingproduct",pid:data.iid,name:data.name,img:data.img,actual_price:data.actual,disc:data.discount,avail:data.avail},
                            function(response1){
                                if(response1 && isObject(response1)){
                                    if(response1.hasOwnProperty("status") && response1.status == 'OK'){
                                        location.href='cart?prd='+data.name+'&pid='+data.iid;
                                    }else{
                                        location.href=site_url;
                                    }
                                }
                        },'json');
                    }
                }else{
                    location.href=site_url+'/login';
                }
            }
    },'json');
}
function usercheck(e){
    $.post('controller',{action:'checkuser'},
    function(response){
        if(response && isObject(response)){
            if(response.hasOwnProperty("status") && response.status == 'OK'){
                window.location.href='checkout';return false;
            }else if(response.hasOwnProperty("error")){
                location.href='login';return false;
            }
        }
    },'json');
}
function edit_address(data){
    $('#exist_'+data.id).hide();
    $("[name='name']").val($('.addfordel_'+data.id).find('.cust_name').text().trim());
    $("[name='pincode']").val($('.addfordel_'+data.id).find('.cust_pincode').text());
    $("[name='phone']").val($('.addfordel_'+data.id).find('.cust_phone').text());
    $("[name='address'").val($('.addfordel_'+data.id).find('.cust_address').text());
    $("[name='id']").val(data.id);
    $("[name='state']").val(data.state);
    if(data.ref && data.ref!=2){
        $('.address-model').removeClass('d-none');
        $('#myModal').modal('toggle');
    }else{
        $('#exampleModal').modal('show');
    }
}
$(document).ajaxStart(function(){$(".ajax-loader").css("display", "block");});
$(document).ajaxComplete(function(){$(".ajax-loader").css("display", "none");});
$('#mc-submit').click(function(){
//    let numberStore = [0, 1, 2];
//    let newNumber = 15;
//    numberStore = [...numberStore, newNumber,18];console.log(numberStore);
//    console.log(new Set(numberStore));
    $(".single-footer-widget .newsletter-form-wrap .mc-form .newsletter-btn").css("top","30%");
});