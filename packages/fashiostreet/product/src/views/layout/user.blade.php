<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/fs_icon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}">
    <script>
        var token = localStorage.getItem('token');
        var local_id = localStorage.getItem('local_id');
        if(token == null || local_id == null)
        {
            window.location.href = '/api/auth/login';
        }
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120362424-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-120362424-1');
    </script>
    <!-- -->
</head>
<body>
<div style="background-color: #263238;height:70px;padding:15px 110px;position: fixed;width: 100%;top: 0px;left: 0px;z-index: 999" class="mpzero">
    <a href="/"><img class="img-responsive" style="max-height:50px;padding:10px 0px" src="{{ asset('assets/img/fashiostreet_logo.png') }}"></a>
</div>
<div class="container-fuild profile_box">
    <div class="row" style="margin: 0px;margin-top: 100px">
        <div class="col-md-3 col-sm-3 prof_sidebar" style="margin: 0px 25px;position: sticky;top: 100px">
            <div style="padding:20px 10px;border-bottom:1px solid #F0F0F0">
                <a href="javascript:void(0)" class="js_hd_orders" style="text-decoration:none">
                    <p style="color: #757575;font-weight: 700;font-size: 15px;margin: 0px">
                        <span class="glyphicon glyphicon-folder-close menu_icon"></span>&nbsp;MY HD ORDERS<span class="glyphicon glyphicon-menu-right pull-right menu_arrow"></span>
                    </p></a>
            </div>
            <div style="padding:10px 10px;border-bottom:1px solid #F0F0F0">
                <p style="color: #757575;font-weight: 700;font-size: 15px;margin: 0px;padding:10px 0px">
                    <span class="glyphicon glyphicon-user menu_icon"></span>&nbsp;ACCOUNT SETTINGS
                </p>
                <ul class="list-unstyled">
                    <li><a href="javascript:void(0)" class="js_profile">Profile</a>
                    </li>
                    <li><a href="javascript:void(0)" class="js_address">Address</a>
                    </li>
                </ul>
            </div>
            <div style="padding:20px 10px;border-bottom:1px solid #F0F0F0">
                <a href="javascript:void(0)" class="js_wishlist" style="text-decoration:none">
                    <p style="color: #757575;font-weight: 700;font-size: 15px;margin: 0px">
                        <span class="glyphicon glyphicon-heart menu_icon"></span>&nbsp;MY WISHLIST<span class="glyphicon glyphicon-menu-right pull-right menu_arrow"></span>
                    </p></a>
            </div>
            <div style="padding:20px 10px;border-bottom:1px solid #F0F0F0">
                <a href="javascript:void(0)" class="logout js_logout" style="text-decoration:none">
                    <p style="color: #757575;font-weight: 700;font-size: 15px;margin: 0px">
                        <span class="glyphicon glyphicon-off menu_icon"></span>&nbsp;LOGOUT
                    </p></a>
            </div>
        </div>
        <div class="js_body">

        </div>
        <div class="col-md-8 col-sm-8 js_loading_img" style="display:none;padding:0;border-radius:2px;background-color:#FFFFFF;box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
            <center><img style="margin-top: 100px;width:100px;" src="{{ asset('assets/img/loading_rwd.gif') }}"/></center>
        </div>
    </div>
    <center>
        <div class="toast" style="position:fixed;font-size:20px;left:50%;transform:translate(-50%,0);bottom:30px;display:none;padding:10px;background-color: black;color:white;opacity: 0.8;">
        </div>
    </center>
</div>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
        $('#profile-image1').on('click', function() {
            $('#profile-image-upload').click();
        });
    });
</script>
<script>
    $(document).ready(function(){
        var hash = location.hash.substr(1);
        console.log(hash);
        function routeCall()
        {
            if(hash == '/profile')
            {
                getProfile('/profile','');
            }
            else if(hash == '/wishlist')
            {
                getWishlist('/wishlist','');
            }
            else if(hash == '/address')
            {
                getAddress('/address','');
            }
            else if(hash == '/ordersHistory')
            {
                getordersHistory('/ordersHistory','');
            }
            else{
                error404Page();
            }
        }
        function loadPage(response)
        {
            $('.js_body').html(response).show();
            $('.js_loading_img').hide();
        }
        function getProfile(url,data)
        {
            $('.js_body').hide();
            $('.js_loading_img').show();
            CallPage(url,data);
        }
        function getordersHistory(url,data){
            $('.js_body').hide();
            $('.js_loading_img').show();
            CallPage(url,data);
        }
        function getAddress(url,data){
            $('.js_body').hide();
            $('.js_loading_img').show();
            CallPage(url,data);
        }
        function getWishlist(url,data)
        {
            $('.js_body').hide();
            $('.js_loading_img').show();
            CallPage(url,data);
        }
        function CallPage(url,data)
        {
            $.ajax({
                type:'get',
                url:'/user' + url,
                data:data,
                headers:{
                    'token' : localStorage.getItem('token'),
                    'local-id' : localStorage.getItem('local_id')
                },
                success:function(response){
                    loadPage(response);
                },
                error:function (request, status, error) {
                    $('.toast').show().html('failed to load page, please check your internet connection');
                    setTimeout(function () {
                        $('.toast').hide();
                    },2000);
                }
            });
        }
        routeCall();
        $(document).on('click','.js_hd_orders',function(){
            $('.js_body').hide();
            $('.js_loading_img').show();
            getordersHistory('/ordersHistory','');
        });
        $(document).on('click','.js_profile',function(){
            $('.js_body').hide();
            $('.js_loading_img').show();
            getProfile('/profile','');
        });
        $(document).on('click','.js_address',function(){
            $('.js_body').hide();
            $('.js_loading_img').show();
            getProfile('/address','');
        });
        $(document).on('click','.js_wishlist',function(){
            $('.js_body').hide();
            $('.js_loading_img').show();
            getProfile('/wishlist','');
        });
        var page = 1;
        $(document).on('click','.deleteWishlist',function(){
            var element = $(this);
            $('.toast').show().html('deleting product fom wishlist');
            $.ajax({
                type:'post',
                url:'/user/deletewishlist/json',
                data:{
                    'product_id' : $(this).attr('data-id')
                },
                headers:{
                    'token' : localStorage.getItem('token'),
                    'local-id' : localStorage.getItem('local_id')
                },
                success:function(response){
                    $('.toast').show().html('product remove from wishlist');
                    setTimeout(function () {
                        $('.toast').hide();
                        element.parent().parent().remove();
                    },1000);
                },
                error:function (request, status, error) {
                    $('.toast').show().html('failed to delete product from wishlist');
                    setTimeout(function () {
                        $('.toast').hide();
                    },2000);
                }
            });
        });
        $(document).on('click','#addbtn',function(){
            $('#fname_txt').val('');
            $('#lname_txt').val('');
            $('#address_txt').val('');
            $('#area_txt').val('');
            $('#mobile_txt').val('');
            $('#viewblock').hide();
            $('#addblock').show();
        });
        $(document).on('click','#cancelbtn',function(){
            $('#addblock').hide();
            $('#viewblock').show();
        });
        $(document).on('click','.deleteaddress',function () {
            var element = $(this);
            $('.toast').show().html('deleting address');
            $.ajax({
                type:'post',
                url:'/user/deleteaddress',
                data:{
                    'address_id' : $(this).attr('data-id')
                },
                headers:{
                    'token' : localStorage.getItem('token'),
                    'local-id' : localStorage.getItem('local_id')
                },
                success:function(response){
                    $('.toast').show().html('address successfully remove');
                    setTimeout(function () {
                        $('.toast').hide();
                        element.parent().parent().remove();
                    },1000);
                },
                error:function (request, status, error) {
                    setTimeout(function () {
                        $('.toast').hide();
                    },2000);
                    $('.toast').show().html('failed to delete address');
                }
            });
        });
        $(document).on('click','.js_editaddress',function(){
            console.log($(this).attr('data-product'));
            var product = JSON.parse($(this).attr('data-address'));
            console.log(product);

            $('#fname_txt').val(product.first_name);
            $('#lname_txt').val(product.last_name);
            $('#address_txt').val(product.address);
            $('#area_txt').val(product.area);
            $('#mobile_txt').val(product.mobile);
            $('.js_saveaddress').attr('data-id',product.id);
            $('#addblock').show();
            $('#viewblock').hide();
        });
        $(document).on('click','.js_saveaddress',function () {
            var url = '/user/';
            var data = {
                'first_name' : $('#fname_txt').val(),
                'last_name' : $('#lname_txt').val(),
                'address' : $('#address_txt').val(),
                'area' : $('#area_txt').val(),
                'mobile' : $('#mobile_txt').val(),
            };
            if($(this).attr('data-id') != null || $(this).attr('data-id') != undefined)
            {
                url = url + 'editAddress';
                data.address_id = $(this).attr('data-id');
                $('.toast').show().html('updating address ...');
            }
            else{
                url = url + 'addAddress';
                $('.toast').show().html('adding address ...');
            }
            console.log(url);
            $.ajax({
                type:'post',
                url:url,
                data:data,
                headers:{
                    'token' : localStorage.getItem('token'),
                    'local-id' : localStorage.getItem('local_id')
                },
                success:function(response){
                    $('.toast').show().html('address successfully updated');
                    setTimeout(function () {
                        $('.toast').hide();
                        getAddress('/address','');
                    },2000);
                },
                error:function (request, status, error) {
                    setTimeout(function () {
                        $('.toast').hide();
                    },2000);
                    $('.toast').show().html('failed to updated address');
                }
            });
        })
        $(document).on('click','.js_saveProfile',function () {
            var data = {
                'name' : $('input[name="name_txt"]').val(),
                'gender' : $("input[name='gender']:checked").val()
            }

            $.ajax({
                type:'post',
                url:'/user/updateProfile',
                data:data,
                headers:{
                    'token' : localStorage.getItem('token'),
                    'local-id' : localStorage.getItem('local_id')
                },
                success:function(response){
                    $('.toast').show().html('profile successfully updated');
                    setTimeout(function () {
                        $('.toast').hide();
                    },2000);
                },
                error:function (request, status, error) {
                    setTimeout(function () {
                        $('.toast').hide();
                    },2000);
                    $('.toast').show().html('failed to updated profile');
                }
            });
        })
        var _0x1a83=["\x63\x6C\x69\x63\x6B","\x2E\x6A\x73\x5F\x6C\x6F\x67\x6F\x75\x74","\x6C\x6F\x63\x61\x6C\x5F\x69\x64","\x72\x65\x6D\x6F\x76\x65\x49\x74\x65\x6D","\x74\x6F\x6B\x65\x6E","\x75\x73\x65\x72\x20\x73\x75\x63\x63\x65\x73\x73\x66\x75\x6C\x6C\x79\x20\x6C\x6F\x67\x6F\x75\x74","\x68\x74\x6D\x6C","\x73\x68\x6F\x77","\x2E\x74\x6F\x61\x73\x74","\x68\x69\x64\x65","\x6F\x6E"];$(document)[_0x1a83[10]](_0x1a83[0],_0x1a83[1],function(){localStorage[_0x1a83[3]](_0x1a83[2]);localStorage[_0x1a83[3]](_0x1a83[4]);$(_0x1a83[8])[_0x1a83[7]]()[_0x1a83[6]](_0x1a83[5]);clearTimeout(clearTime);clearTime= setTimeout(function(){$(_0x1a83[8])[_0x1a83[9]]()},2000)})
    });
</script>
</body>
</html>