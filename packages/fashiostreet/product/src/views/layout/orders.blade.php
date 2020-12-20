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
        @yield('body')
        <div class="col-md-3 col-sm-3" style="padding: 0px">
            <div class="prof_sidebar" style="padding: 0px 15px">
                <div style="padding:20px 0px;border-bottom:1px solid #F0F0F0">
                    <p style="color:#00E676;font-weight: 700;font-size: 15px;margin: 0px">
                        <span class="glyphicon glyphicon-exclamation-sign menu_icon"></span>&nbsp;We Provide Free Home Delivery
                    </p>
                </div>
                <div style="padding:10px 0px;border-bottom:1px solid #F0F0F0">
                    <p style="color: #757575;font-weight: 700;font-size: 15px;margin: 0px;padding:10px 0px">
                        <span class=" glyphicon glyphicon-exclamation-sign menu_icon"></span>&nbsp;Cash On Delivery Service
                    </p>
                </div>
                <div style="padding:20px 0px;border-bottom:1px solid #F0F0F0">
                        <p style="color: #757575;font-weight: 700;font-size: 15px;margin: 0px">
                            <span class="glyphicon glyphicon-fire menu_icon"></span>&nbsp;We Give TRY & BUY Feature
                        </p>
                </div>
                <div style="padding:20px 0px">
                    @yield('order_btn')
                </div>
            </div>
            @yield('extra_data')
            <div class="prof_sidebar" style="padding: 0px 15px;margin-top: 15px">
                <div style="padding:20px 0px;border-bottom:1px solid #F0F0F0" class="try_ques">
                    <p style="color:#757575;font-weight: 700;font-size: 15px;margin: 0px;cursor: pointer">
                        WHAT IS TRY & BUY FEATURE ? <span class="glyphicon glyphicon-menu-down pull-right menu_arrow">
                    </p>
                </div>
                <div style="padding:20px 0px;display: none;" class="try_cont">
                    <p style="color:#757575;font-size: 14px">
                        You can order 3-4 items from same catergory Example : 3-4 T-shirts. When order is delivered to your door step, you can instantly try out the items and buy only that items you liked. It's is exciting but unfortunately we have to keep one rule to this feature to avoid mis-use of it.<br>Rule :- You should atleast buy 1 item for every 3 items you order.
                    </p>
                    <p style="color:#757575;font-size: 14px">
                        <span style="font-weight: 700">Example :-</span><br>
                        You ordered 3 items > You should atleast buy 1 item of that 3 items<br>
                        You ordered 4 items > You should atleast buy 2 items of that 4 items
                    </p>
                    <p style="color:#757575;font-size: 14px">
                        <span style="font-weight: 700">Ordered To Buy Ratio :-</span><br>
                        1-3 items ordered > Buy atleast 1 item<br>
                        4-6 items ordered > Buy atleast 2 items<br>
                        5-9 items ordered > Buy atleast 3 items<br>
                        Continue Similarly..
                    </p>
                </div>
            </div>
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
        $(".try_ques").click(function(){
            $(".try_cont").toggle(100);
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $('#profile-image1').on('click', function() {
            $('#profile-image-upload').click();
        });
    });
</script>
@yield('script')
</body>
</html>