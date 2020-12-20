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
        <div class="js_body">@yield('body')</div>
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
                getAddress();
            }
            else if(hash == '/ordersHistory')
            {
                getordersHistory();
            }
            else{
                error404Page();
            }
        }
        function loadPage(response)
        {
            $('body').html(response);
            $('.js_loading_img').hide();
        }
        function getProfile(url,data)
        {
            CallPage(url,data);
        }
        function getWishlist(url,data)
        {
            CallPage(url,data);
        }
        function CallPage(url,data)
        {
            $.ajax({
                type:'get',
                url:'/user' + url,
                data:data,
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
        $(document).on('click','.js_profile',function(){
            $('.js_body').hide();
            $('.js_loading_img').show();
            getProfile(hash,'');
        });
    });
</script>
</body>
</html>