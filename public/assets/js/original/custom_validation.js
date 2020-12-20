function isNumber(data){
    if(data.match(/^[0-9]+$/))
        return true;
    return false;
}
function isChar(data)
{
    if(data.match(/^[a-zA-Z]+$/))
        return true;
    return false;
}
function isEmpty(data)
{
    if(data == "" || data == null)
        return true;
    return false;
}
function isEmail(data)
{
    var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    if(reg.test(data))
        return true;
    return false;
}
function error(element,result,msg)
{
    $('#' + element).css({"border":"1px solid red"});
    $('#' + result).html(msg);
}
function success(element,result,msg)
{
    $('#' + element).css({'border':'1px solid green'});
    $('#' + result).html(msg);
}
function isUrl(data)
{
    var reg = /^(?:(ftp|http|https)?:\/\/)?(?:[\w-]+\.)+([a-z]|[A-Z]|[0-9]){2,6}$/;
    if(reg.test(data))
        return true;
    return false;
}
function isSpecialPassword(data)
{
    var reg = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
    if(reg.test(data))
        return true;
    return false;
}
function length(data,min,max)
{
    var length = data.length;
    if(length >= min && length <= max)
        return true;
    return false;
}
function show_loading(){
    $('.loading').show();
}
function login(load,response){
    localStorage.setItem('token',response.result.token);
    localStorage.setItem('local_id',response.result.local_id);
    window.location.href = '/';
}
function register1(load,response){
    window.location.href = '/api/auth/completeRegister?mobile=' + response.email + '&code=1';
}
function otpverify(load,response) {
    window.location.href = '/';
}
function createpassword(load,response) {
    window.location.href = '/success';
}
function forgetpassword(load,response){
    window.location.href = '/api/auth/completeForgetpassword?mobile=' + response.email;
}
function reset_password(load,response) {
    window.location.href = '/api/auth/login?msg=successfully reset password, please login to continue your service';
}
function Global_ajaxCall(url,type,load,data,funct){
    $.ajax({
        type:type,
        url:url,
        dataType:'json',
        data:data,
        success:function (response) {
            if(funct == 'login') {
                login(load, response);
            }
            else if(funct == 'register'){
                register1(load,response);
            }
            else if(funct == 'otpverify'){
                otpverify(load,response);
            }
            else if(funct == 'createpassword'){
                createpassword(load,response);
            }
            else if(funct == 'forgetpassword'){
                forgetpassword(load,response);
            }
            else if(funct == 'reset_password'){
                reset_password(load,response);
            }
        },
        error:function (request, status, error) {
            if(request.status == 500) {
                $('.loading').hide();
                var error =  $.parseJSON(request.responseText);
                error = error.message;
                $('#' + load).show().html(error);
                if(error == "please activate your account before login")
                    window.location.href = '/api/auth/completeRegister?mobile=' + data.mobile;
                if(error == "otp already send to your mobile")
                    window.location.href = '/api/auth/completeForgetpassword?mobile=' + data.mobile;
                return false;
            }
            alert('System error found refresh page');
            return false;
        }
    });
}

$(document).ready(function () {

    $(document).on('click','.show_password',function () {
        if($('#' + $(this).attr('data-btn')).attr('type') == 'password') {
            $('#' + $(this).attr('data-btn')).attr('type', 'text');
            $(this).html('hide');
        }
        else {
            $('#' + $(this).attr('data-btn')).attr('type', 'password');
            $(this).html('show');
        }
    });



    $(document).on('submit','#reset_password_form',function (e) {
        var otp = $('#OTP_txt').val();
        var mobile = $('#mobile_txt').attr('data-value');
        var password = $('#createpassword_pwd1').val();
        var confirm_password = $('#createpassword_pwd2').val();
        if(isEmpty(otp) || isEmpty(password) || isEmpty(confirm_password))
        {
            e.preventDefault();
            $('#error').show().html('OTP required');
            return false;
        }
        if(!length(otp,6,6))
        {
            e.preventDefault();
            $('#error').show().html('Invalid OTP found');
            return false;
        }
        if(!isNumber(otp))
        {
            e.preventDefault();
            $('#error').show().html('Invalid OTP found');
            return false;
        }
        if(password.length <= 6)
        {
            e.preventDefault();
            $('#error').show().html('Invalid mobile number or password found');
            return false;
        }
        if(password != confirm_password)
        {
            e.preventDefault();
            $('#error').show().html('Password not match');
            return false;
        }
        $('#error').hide();
        var url = '/api/auth/completeForgetpassword';
        var data = {
            'mobile' : mobile,
            'code' : otp,
            'password' : password
        };
        Global_ajaxCall(url,'POST','error',data,'reset_password');
        show_loading();
        e.preventDefault();
        return true;
    });

    $(document).on('submit','#login_form',function (e) {
        var mobile = $('#mobile_txt').val();
        var password = $('#pwd1').val();
        if(isEmpty(mobile)){
            e.preventDefault();
            $('#error').show().html('Mobile number required');
            return false;
        }
        if(isEmpty(password)){
            e.preventDefault();
            $('#error').show().html('password required');
            return false;
        }
        if(!isNumber(mobile) || !length(mobile,10,10))
        {
            e.preventDefault();
            $('#error').show().html('Invalid mobile number found');
            return false;
        }
        if(password.length <= 6)
        {
            e.preventDefault();
            $('#error').show().html('Invalid mobile number or password found');
            return false;
        }
        $('#error').hide();
        show_loading();
        var url = '/api/auth/login';
        var data = {
            'mobile' : mobile,
            'password' : password
        };
        Global_ajaxCall(url,'POST','error',data,'login');
        e.preventDefault();
        return true;
    });

    $(document).on('submit','#register_form',function (e) {
        var mobile = $('#mobile_txt').val();
        var password = $('#createpassword_pwd1').val();
        var password2 = $('#createpassword_pwd2').val();
        if(isEmpty(mobile))
        {
            e.preventDefault();
            $('#error').show().html('mobile number required');
            return false;
        }
        if(!length(mobile,10,10))
        {
            e.preventDefault();
            $('#error').show().html('Invalid Mobile number found');
            return false;
        }
        if(!isNumber(mobile))
        {
            e.preventDefault();
            $('#error').show().html('Invalid Mobile number found');
            return false;
        }
        if(password.length <= 6)
        {
            e.preventDefault();
            $('#error').show().html('password at least 6 characters');
            return false;
        }
        if(password != password2)
        {
            e.preventDefault();
            $('#error').show().html('password not match');
            return false;
        }
        $('#error').hide();
        var url = '/api/auth/register';
        var data = {
            'mobile' : mobile,
            'password' : password
        };
        Global_ajaxCall(url,'POST','error',data,'register');
        show_loading();
        e.preventDefault();
        return true;
    });

    $(document).on('submit','#otpverify_form',function (e) {
        var otp = $('#OTP_txt').val();
        if(isEmpty(otp))
        {
            e.preventDefault();
            $('#error').show().html('OTP required');
            return false;
        }
        if(!length(otp,6,6))
        {
            e.preventDefault();
            $('#error').show().html('Invalid OTP found');
            return false;
        }
        if(!isNumber(otp))
        {
            e.preventDefault();
            $('#error').show().html('Invalid OTP found');
            return false;
        }
        $('#error').hide();
        $('#mobile_txt').html()
        var url = '/api/auth/completeRegister';
        var data = {
            'mobile' : $('#mobile_txt').html(),
            'code' : otp
        };
        Global_ajaxCall(url,'POST','error',data,'otpverify');
        show_loading();
        e.preventDefault();
        return true;
    });

    $(document).on('submit','#forgetpassword_form',function (e) {
        var mobile = $('#mobile_txt').val();
        if(!isEmpty(mobile)) {
            if (isNumber(mobile)) {
                if(length(mobile,10,10))
                {
                    $('#error').hide();
                    show_loading();
                    var url = '/api/auth/forgetpassword';
                    var data = {
                        'mobile' : mobile
                    };
                    Global_ajaxCall(url,'POST','error',data,'forgetpassword');
                    e.preventDefault();
                    return true;
                }
                e.preventDefault();
                $('#error').show().html('Invalid mobile number found');
                return false;
            }
            e.preventDefault();
            $('#error').show().html('Only numeric value required');
            return false;
        }
        e.preventDefault();
        $('#error').show().html('Mobile number required');
        return false;
    });

    $(document).on('submit','#createpassword_form',function (e) {
        var password = $('#createpassword_pwd1').val();
        var confirm_password = $('#createpassword_pwd2').val();
        if(isEmpty(password) || isEmpty(confirm_password))
        {
            e.preventDefault();
            $('#error').show().html('Password required');
            return false;
        }
        if(!length(password,8,32))
        {
            e.preventDefault();
            $('#error').show().html('Password must be more than 8 characters');
            return false;
        }
        if(password != confirm_password)
        {
            e.preventDefault();
            $('#error').show().html('Password not match');
            return false;
        }
        $('#error').hide();
        var url = '/api/auth/create_password';
        var data = {
            'email' : $('#mobile_txt').attr('data-value'),
            'password' : password
        };
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
        Global_ajaxCall(url,'POST','error',data,'createpassword');
        show_loading();
        e.preventDefault();
        return true;
    });
});