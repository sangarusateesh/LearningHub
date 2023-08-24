$(function(){
    $('#login-form').validate({
        rules:{
            email:{ required:true, email:true},
            password:'required'
        },
        invalidHandler: function() {$('.response').html('');}
    });
    $('#changepassword-form').validate({
        rules:{npassword:{required:true,minlength:4},cnfpassword: {equalTo: '[name="npassword"]'}},
        invalidHandler: function() {$('.response').html('');}
    });
    $('#forgotpassword-form').validate({
        rules:{email:{required:true,email:true}},
        invalidHandler: function() {$('.response').html('');}
    });
    $('#forgot-password').validate({
        rules:{email:{ required:true, email:true, checkEmail:true }},
        invalidHandler: function() {$('#forgot-password .response').html('');}
    });
    $('#booking-form').validate({
        rules:{pname:'required',dob:'required',doj:'required',source:'required',destination:'required',contact:{required:true,validPhone:true},address:'required'},
        invalidHandler: function() {$('.response').html('');}
    });
    $('#register-form').validate({
        rules:{name:'required',dob:'required',gender:'required',contact:'required',address:'required',email:{ required:true, email:true},password: { required:function(){return !$("[name=id]").val()}, minlength: 6,maxlength: 10 },cpassword: { required:function(){return !$("[name=id]").val()},equalTo: "[name='password']"}},
        invalidHandler: function() {$('.response').html('');}
    });
    $('#employee-form').validate({
        rules:{name:'required',designation:'required',dob:'required',doj:'required',blood_group:'required',email:{required:true,email:true},contact:'required',address:'required',idproof:'required'},
        invalidHandler: function() {$('.response').html('');}
    });
    $.validator.addMethod("aadharno",function(value, element, regexp) {var re = new RegExp(regexp);return this.optional(element) || re.test(value);},"Please check your input.");
    $.validator.addMethod("validPhone",function(e,a){if(e){return!!/^[6-9]{1}[0-9]{9}$/.test(e)||($.validator.messages.validPhone="Please Enter a Valid Phone Number.",!1)}return!0},"");
    $.validator.addMethod("checkPhone",function(a){var t;return!a||($.ajax({url:"controller",type:"post",dataType:"json",async:!1,data:{phone:a,action:"checkPhone",form:$('input[name="action"]').val(),id:$('input[name="id"]').val()},success:function(a){a&&(t=a.hasOwnProperty("status")?a.status:"")}}),"OK"===t||($.validator.messages.checkPhone=t||"Something went wrong!.",!1))},"");
    $.validator.addMethod("checkEmail",function(a){var t;return!a||($.ajax({url:"controller",type:"post",dataType:"json",async:!1,data:{email:a,action:"checkEmail",form:$('input[name="action"]').val(),id:$('input[name="id"]').val()},success:function(a){a&&(t=a.hasOwnProperty("status")?a.status:"")}}),"OK"===t||($.validator.messages.checkEmail=t||"Something went wrong!.",!1))},"");
    $.validator.addMethod("isImage",function(e,a){var i,t=$(a).prop("files")[0];if(!t)return!0;var r=new FormData;r.append("file",t);r.append("action","checkImage");var s=!1;return $.ajax({url:"controller",type:"post",async:!1,data:r,dataType:"json",success:function(e){if(e&&isObject(e)){var a=e.hasOwnProperty("file_type")?e.file_type:"",t=e.hasOwnProperty("file_size")?e.file_size:"";t>5242880?i="File size exceeded 5mb.":t&&a&&"image"==a?t<5242880&&"image"==a&&(s=!0):i="Invalid file formate."}},cache:!1,contentType:!1,processData:!1}),s||($.validator.messages.isImage=i),s},"");
    $.validator.addMethod("isPdf",function(e,a){var i,t=$(a).prop("files")[0];if(!t)return!0;var r=new FormData;r.append("file",t);r.append("action","checkPdf");var s=!1;return $.ajax({url:"controller",type:"post",async:!1,data:r,dataType:"json",success:function(e){if(e&&isObject(e)){var a=e.hasOwnProperty("file_type")?e.file_type:"",t=e.hasOwnProperty("file_size")?e.file_size:"";t>5242880?i="File size exceeded 5mb.":t&&a&&"pdf"==a?t<5242880&&"pdf"==a&&(s=!0):i="Invalid file formate."}},cache:!1,contentType:!1,processData:!1}),s||($.validator.messages.isPdf=i),s},"");
    jQuery.validator.addMethod("Isemail", function(value, element) {var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);return pattern.test(value);}, "Please enter a valid email.");
    $.validator.addMethod("notEqual", function(value, element, param) {
        return this.optional(element) || value != param;
    }, "Please specify a different value");
});
$(document).on("submit", ".v_form", function (e) { 
    e.preventDefault();
    var formId=$(this).attr('id'),id=$('#'+formId+' input[name=id]').length > 0 ? $('#'+formId+' input[name=id]').val():'',proceed=false;
    var btn = $('#'+formId+' button[type=submit]');
    var btn_text = btn.text();
    if($('#'+formId).valid()){proceed=true;}
    $('#'+formId+' .response').html('');    //cosole.log(99);exit;
    if(proceed){ 
        btn.text('Please wait...');
        btn.prop('disabled', true);
        $.ajax({
            url:'ajax/controller.php',type:"post",dataType: 'json',data: new FormData($('#'+formId)[0]),
            success: function (response) { //console.log(typeof response, response);return false;
                var status,error,redirect,reload,msg,otp;
                if(response && isObject(response)){ 
                    status = response.hasOwnProperty("status") ? response.status : '';
                    error = response.hasOwnProperty("error") ? response.error : '';
                    redirect = response.hasOwnProperty("redirect") ? response.redirect : '';
                    reload = response.hasOwnProperty("reload") ? response.reload : '';
                    msg = response.hasOwnProperty("msg") ? response.msg : "Data Updated successfully.";
                }
                if(status === 'OK'){ //console.log(typeof response, response);return false;
                    if(redirect){
                        location.href= redirect;return false;
                    }else if(reload){ 
                        location.reload(true);return false;
                    }else{ 
                        $('#'+formId+' .response').html('<div class="alert alert-success" role="alert"><i class="fa fa-check"></i> '+ msg +'</div>');
                        if(['booking-form','profile-update'].includes(formId)){ 
                            setTimeout(function() {location.reload(true);return false;},10000);
                        }else{
                            var resetForms = ['changePasswordForm','enquiry_form'];                        
                            if(((!id) || resetForms.includes(formId))){
                                $('#'+formId)[0].reset();
                                if($('.dropify').length > 0){$(".dropify").each(function() {resetDropify(this);});}
                                if($('.summernote').length > 0){$('.summernote').summernote('reset');}
                            }
                        }
                    }
                }else if(error){ $('#'+formId+' .response').html('<div class="alert alert-danger"> '+error+'</div>');}  
                btn.prop('disabled', false).text(btn_text);
            },
            error: function( jqXhr, textStatus, errorThrown ){
                btn.prop('disabled', false).text(btn_text);
            },
            cache: false,
            contentType: false,
            processData: false
        });
        $('html, body').animate({scrollTop: $('#'+formId+' .response').offset().top-100}, 1000);
    }     
});
function isObject (value) {return value && typeof value === 'object' && value.constructor === Object;}