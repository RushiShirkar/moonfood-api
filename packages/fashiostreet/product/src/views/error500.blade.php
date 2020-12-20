<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="shortcut icon" href="{{ asset('assets/img/fs_icon.png') }}">
    <title>fashiostreet</title>
    <style>
        .mpzero{
            padding: 0;
            margin: 0;
        }
        .error_title{
            text-align:center;
            color: #263238;
            font-size:60px;
            padding-top: 40px
        }
        .error_ooops{
            text-align:center;
            color: #263238;
            font-size:30px;
            padding-top: 30px
        }
        .error_sub{
            text-align:center;
            color: #263238;
            font-size:20px;
            padding-top: 40px;
            padding-bottom:20px;
            font-weight:900
        }
    </style>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120362424-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-120362424-1');
    </script>
</head>
<body>
<div class="row mpzero">
    <div class="col-md-12" style="padding-top: 30px">
        <center><img class="img-responsive" style="max-height: 250px" src="{{ asset('assets/img/something_robot.png') }}"></center>
    </div>
    <div class="col-md-12 error_ooops" style="font-size: 30px">{{ $request['error'] }}</div>
</div>
</body>
</html>