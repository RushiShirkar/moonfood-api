<!DOCTYPE html>
<html lang="en-in">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="Keywords" content="online shopping, local shopping, home delivery, fashion shopping, online shopping site, local shopping search engine, fs, fashionstreet, fashiostreet, clothing, watches, footwear"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="DC.title" content="Fashiostreet" />
    <meta name="geo.region" content="IN-MH" />
    <meta name="geo.position" content="19.75148;75.713888" />
    <meta name="ICBM" content="19.75148, 75.713888" />

    <title>{{ $product[0]->name }} - fashiostreet</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/fs_icon.png') }}">
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Core css bootstrap.min.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|Roboto|Source+Sans+Pro" rel="stylesheet">
    <!-- Google Fonts -->
    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/category_city.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/category.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/prod_detail.css') }}">
    @yield('category_shop')
    <style>
        .drp{
            position:absolute;
            right:40px;
            margin-top:10px;
            font-size:18px;
        }
        .drp a
        {
            text-decoration: none;
            color:white;
        }
        .active_size{
            background-color:  #00E676  !important;
        }
        .img_modal{
            display:none;
            top:0px;
            width:100%;
            height:100vh;
            background-color:rgba(0,0,0,0.7);
            position:fixed;
            z-index:99999;
        }
        .img_modal a{
            text-decoration:none;
            font-size:22px;
        }
        .modal_close_btn{
            position:absolute;
            color:white !important;
            top:20px;
            right:40px;
        }
        .img_box{
            cursor: pointer;
        }
        .atc_btn{
            background-color:#00E676;
            color: #FFFFFF;
            font-weight: bold;
            border: 0px;
            padding: 15px;
            border-radius: 2px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
            outline: none;
        }
        .product_icon-img{
            height: 70px;
            max-width: 100%
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
<body class="light_gray marg-head_top1">
<center>
    <div class="toast" style="position:fixed;z-index:999999;font-size:20px;left:50%;transform:translate(-50%,0);bottom:30px;display:none;padding:10px;background-color: black;color:white;opacity: 0.8;">
    </div>
</center>
<nav class="navbar navbar-fixed-top pzero desktop">
    <div class="row pzero h_row1">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 logo_col">
            <a href="/" class="pzero"><img src="{{ asset('assets/img/fashiostreet_logo.png') }}" alt="Fashiostreet,Fashionstreet,Fashion street" style="width:135%"></a>
        </div>
        <div class="col-lg-6 col-lg-offset-1 col-md-6 col-md-offset-1 col-sm-6 col-sm-offset-1 col-xs-6 col-xs-offset-1 search_col pzero">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pzero search_city dropdown">
                    <button class="btn search_city-btn suggestion_btn1" type="button">
                        <img style="width:20px" src="{{ asset('assets/img/location_search.png') }}"/> &nbsp {{ $data['city'] }} &nbsp<span class="glyphicon glyphicon-menu-down"></span>
                    </button>
                    <div id="city_suggestion" class="suggestion_div z-depth-3">
                        <ul>
                            <li>
                                <div class="input-group">
                                    <form id="city_selector_form" action="#">
                                        <input type="search" id="city_search_txt" class="form-control" name="search_city" placeholder="Search City" autocomplete="off">
                                    </form>
                                </div>
                            </li>
                            <div class="city_suggestion_box">
                            </div>
                            <div style="padding: 0px 8px">
                            <p>LAUNCHING SOON IN ....</p>
                            <p>Kolhapur</p>
                            <p>Satara</p>
                            <p>Pune</p>
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 pzero">
                    <form id="search_product_form">
                        <input type="text" id="product_search_txt" class="mzero search_pro" placeholder="Search Product in this city" autocomplete="off">
                    </form>
                    <div class="suggestion_div z-depth-3 product_suggestion_div" style="display:block !important;background-color: white !important;">
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 pzero">
                    <button class="search_btn">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pzero">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 selectshop_col">
                    <a href="/shop/{{ $data['city'] }}?shop=All%20Shop" class="btn selectshop_btn" style="color: #000000 !important;">
                       <img src="{{ asset('assets/img/store.png') }}">&nbsp; All Shops 
                    </a>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 sign_col">
                    <a href="https://play.google.com/store/apps/details?id=com.shoping_search_engine.fashiostreet" class="home_signInUp pull-right" target="_blank" style="margin: 0px">DOWNLOAD APP</a>
                </div>
            </div>
        </div>
    </div>
    <div style="background: #263238;">
        <div class="menu-container">
            <div class="menu">
                <ul>
                        <li><a href="javascript:void(0)" class="cat_title">MEN <span class="glyphicon glyphicon-menu-down" style="font-size: 12px"></span></a>
                            <ul>
                                <li>
                                  <a href="/product/Islampur/T-shirts?shop={{ $data['shop_name'] }}&gender=men&category=top wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/tshirt.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text18 text-black lineclampin" style="font-size:12px !important">
                                      <b>Polo & T-Shirts</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                  <a href="/product/Islampur/Casual shirts?shop={{ $data['shop_name'] }}&gender=men&category=top wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/shirt.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Casual Shirts</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Sweatshirts?shop={{ $data['shop_name'] }}&gender=men&category=top wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/sweatshirt.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Sweatshirts</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Jeans?shop={{ $data['shop_name'] }}&gender=men&category=bottom wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/jean.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Jeans</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Cargos?shop={{ $data['shop_name'] }}&gender=men&category=bottom wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/cargo.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Cargos</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                  <a href="/product/Islampur/Socks?shop={{ $data['shop_name'] }}&gender=men&category=accessories" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/sock.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Socks</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Shorts and 3 by 4ths?shop={{ $data['shop_name'] }}&gender=men&category=bottom wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/short.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>3/4ths & Shorts</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                  <a href="/product/Islampur/Handkerchiefs?shop={{ $data['shop_name'] }}&gender=men&category=accessories" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/handkerchief.png') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Handkerchiefs</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Track pants?shop={{ $data['shop_name'] }}&gender=men&category=sports wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/trackpant.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Track pants</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Briefs and trunks?shop={{ $data['shop_name'] }}&gender=men&category=innerwear and sleepwear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/Brief.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Briefs & trunks</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Vests?shop={{ $data['shop_name'] }}&gender=men&category=innerwear and sleepwear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/vest.jpeg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Vests</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Boxers?shop={{ $data['shop_name'] }}&gender=men&category=innerwear and sleepwear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/boxer.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Boxers</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)" class="cat_title">WOMEN <span class="glyphicon glyphicon-menu-down" style="font-size: 12px"></span></a>
                            <ul>
                                <li>
                                  <a href="/product/Islampur/Shirts?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/w_shirt.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text18 text-black lineclampin" style="font-size:12px !important">
                                      <b>Shirts</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                  <a href="/product/Islampur/Tops?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/top.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Tops</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Single one piece?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/onepiece.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>One Piece</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                  <a href="/product/Islampur/Dress Material?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/dressmaterial.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Dress Material</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/T-Shirts?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/w_tshirt.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>T-Shirts</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                  <a href="/product/Islampur/Leggings?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/legging.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Leggings</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Jeans?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/w_jean.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Jeans</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                  <a href="/product/Islampur/Salwars?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/salwar.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Salwars</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Dungarees?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/dungaree.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Dungarees</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                  <a href="/product/Islampur/Capris?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/capris.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Capris</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Fashion Jackets?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/jacket.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Jackets</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                  <a href="/product/Islampur/Sweatshirts?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/w_sweatshirt.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Sweatshirts</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Jeans?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/plazo.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Plazo</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                  <a href="/product/Islampur/Socks?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/sock.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Socks</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Tops?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/shrug.jpeg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Shrugs</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Kurtis?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/kurti.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Kurtis</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)" class="cat_title">BABY & KIDS <span class="glyphicon glyphicon-menu-down" style="font-size: 12px"></span></a>
                            <ul>
                                <li>
                                  <a href="javascript:void(0)" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px;display:table;overflow:hidden;text-align: center">
                                         <div style="display:table-cell;vertical-align:middle">
                                             Kids Section<br>
                                             (1yrs-12yrs)
                                         </div>
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text18 text-black lineclampin" style="font-size:12px !important">
                                      <b>>>></b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                  <a href="javascript:void(0)" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px;display:table;overflow:hidden;text-align: center">
                                         <div style="display:table-cell;vertical-align:middle">
                                             Babys Section<br>
                                             (Below 1yrs)
                                         </div>
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text18 text-black lineclampin" style="font-size:12px !important">
                                      <b>>>></b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                  <a href="/product/Islampur/T-shirts?shop={{ $data['shop_name'] }}&gender=baby and kids&category=boy's clothing" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/k_tshirt.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Polo & T-shirts</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                  <a href="/product/Islampur/T-shirts?shop={{ $data['shop_name'] }}&gender=baby and kids&category=baby boy" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/b_tshirt.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>T-shirts</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Kurtas?shop={{ $data['shop_name'] }}&gender=baby and kids&category=boy's clothing" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{asset('assets/img/kurta.jpg')}}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Kurtas</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                  <a href="/product/Islampur/Bodysuits?shop={{ $data['shop_name'] }}&gender=baby and kids&category=baby boy" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/b_suit.jpeg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Suits</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Jackets?shop={{ $data['shop_name'] }}&gender=baby and kids&category=boy's clothing" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/k_jacket.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Jackets</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                  <a href="javascript:void(0)" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/bloomer.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Chadi</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Sweaters?shop={{ $data['shop_name'] }}&gender=baby and kids&category=boy's clothing" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/k_sweater.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Sweaters</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                  <a href="javascript:void(0)" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/langot.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Langot</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/k_jean.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Jeans</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                  <a href="javascript:void(0)" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/wraptowel.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Wrap Towel</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/k_short.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Shorts</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/k_frock.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Frocks</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                                <li>
                                    <a href="/product/Islampur/Dresses?shop={{ $data['shop_name'] }}&gender=baby and kids&category=girl's clothing" class="decoration_none" style="width: 100%;border-bottom: 0px">
                                    <div class="row hover" style="background-color: white;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 18px 0 rgba(0, 0, 0, 0.12), 0 3px 5px -1px rgba(0, 0, 0, 0.3);margin-bottom: 10px">
                                      <div class="col-xs-4 col-sm-12 col-md-12" style="padding: 0px">
                                       <div style="height:110px">
                                         <img src="{{ asset('assets/img/k_dress.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
                                       </div>
                                      </div>
                                    <div class="col-xs-8 col-sm-12 col-md-12" style="padding: 0px;text-align: center;">
                                     <div class="inner_container p_title text-black lineclampin" style="font-size:12px !important">
                                      <b>Dresses</b>
                                     </div>
                                    </div>
                                   </div>
                                  </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
            </div>
        </div>
    </div>
</nav>

<!-- mobile header -->
<div class="row back mob_head" style="padding:10px 0 !important">
    <div class="col-xs-2 padsearchselect" >
        @php
            $url = $_SERVER['REQUEST_URI'];
            $pre_url = url()->previous();
            $flag1 = strcasecmp($pre_url,$url);
            if($flag1 == 0)
            {
        @endphp
        <a data-flag="{{ $flag1 }}" href="/product/{{ $data['city'] }}/{{ $product[0]->sub_category }}?shop={{ $product[0]->shop_name }}&gender={{ $product[0]->gender }}&category={{ $product[0]->category }}"><i class="fa fa-angle-left textcolor height" aria-hidden="true" style="font-size:30px"></i></a>
        @php
            }
            else{
        @endphp
        <a data-flag="{{ $flag1 }}" href="{{ $pre_url }}"><i class="fa fa-angle-left textcolor height" aria-hidden="true" style="font-size:30px"></i></a>
        @php
            }
            unset($flag1);
        @endphp
    </div>
    <div class="col-xs-3 padsearchselect">
        <a href="/"><img src="{{ asset('assets/img/fs_icon.png') }}" style="max-height:35px;"></a>
    </div>
</div>
<!-- mobile header -->
<!-- box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 #CDDC39; -->
<div class="container-fluid" style="background:white;padding-bottom:40px;">
    <div class="row">
        <div class="col-md-1 img_col">
            @for($i=0;$i < count($product[0]->image);$i++)
                <div class="thumbnail js_p_small_img" style="margin-bottom: 10px">
                    <center>
                        <img src="{{ $product[0]->image[$i] }}" class="img-responsive product_icon-img">
                    </center>
                </div>
            @endfor
        </div>
        <div class="col-md-3 img_col">
            <div class="row">
                <div class="col-12 thumbnail img_box">
                    <center>
                        <img src="{{ $product[0]->image[0] }}" class="img-responsive product_img js_p_big_img">
                    </center>
                </div>
                <div class="col-12">
                    <a href="https://play.google.com/store/apps/details?id=com.shoping_search_engine.fashiostreet" class="btn atc_btn btn-block" target="_blank">DOWNLOAD APP TO ORDER</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="col-xs-12 menu_show" style="padding:10px 0;text-align: left;">
                <a href="/shop/{{ $product[0]->city }}?shop=All Shop"><span>{{ $product[0]->city }}</span></a> >
                <a href="/shop/{{ $product[0]->city }}/available-category?shop={{ $product[0]->shop_name }}"><span> {{ $product[0]->shop_name }}</span></a> >
                <a href="/product/{{ $product[0]->city }}/{{ $product[0]->sub_category }}?shop={{ $product[0]->shop_name }}&gender={{ $product[0]->gender }}&category={{ $product[0]->category }}"><span> {{ $product[0]->gender }} - {{ $product[0]->sub_category }}</span></a>
            </div>
            <h5 class="product_name">{{ $product[0]->name }}</h5>
            <span class="product_shop">Store : {{ $product[0]->shop_name }}</span>
            <br><br>
            <div>
                <label class="product_price"><span class="fa fa-inr"></span>&nbsp;{{ $product[0]->selling_price }}</label>
                <label class="cutPrice"><span class="fa fa-inr"></span>&nbsp;{{ $product[0]->mrp_price }}</label>
                <label style="color: #00E676">&nbsp;(Max Bargain Price)</label>
                <br>
                <label style="color: #FF6D00"><i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp; Price are same that are in shops, we don't take commission from your side. So, order freely !</label>
            </div>
            <hr>
            <div class="col-md-6">
                <h5 class="heading"><img src="{{ asset('assets/img/resize_option.png') }}">&nbsp;&nbsp;Available Sizes</h5>
                @for($i=0;$i<count($product[0]->size);$i++)
                    <span data-size="{{ $product[0]->size[$i]->size }}" style="padding:10px;margin-left:5px;cursor: pointer" class="font20 badge js_size_btn">{{ $product[0]->size[$i]->size }}</span>
                @endfor
            </div>
            <div class="col-md-6">
                <h5 class="heading"><img src="{{ asset('assets/img/pantone.png') }}">&nbsp;&nbsp;Available Colors</h5>
                @php
                    if($product[0]->color == null){
                        $product[0]->color = [];
                    }
                    else{
                        $product[0]->color = explode(",",$product[0]->color);
                    }
                @endphp
                @for($i=0;$i < count($product[0]->color);$i++)
                    <label class="sizes"><span class="fa fa-square" style="color:{{ $product[0]->color[$i] }}"></span>&nbsp;&nbsp;{{ $product[0]->color[$i] }}</label>
                @endfor
            </div>
            <div class="col-md-12" style="margin-bottom: 15px">
                <h5 class="heading" style="padding-top: 10px">Description</h5>
                <label class="descr">{{ $product[0]->description }}</label>
                <br>
            </div>
            <hr>
            <div class="col-md-12" style="margin-bottom: 25px">
                <p style="color: #00E676;font-weight: 700;font-size: 15px;margin: 0px;padding:10px 0px">
                    <span class="glyphicon glyphicon-exclamation-sign menu_icon"></span>&nbsp;&nbsp; We Provide Free Home Delivery
                </p>
                <p style="color: #00E676;font-weight: 700;font-size: 15px;margin: 0px">
                    <span class="glyphicon glyphicon-fire menu_icon"></span>&nbsp;&nbsp; We Give TRY & BUY Feature (See More.. in HD CART)
                </p>
            </div>
            <hr>
            <div class="col-md-12"><h5 class="text-center" style="font-size: 22px;padding: 10px 0"><span class="fa fa-building" style="color:#7191A8"></span>&nbsp;Shop Details</h5></div>
            <div class="col-md-6">
                <h5 class="heading">Available At</h5>
                <label class="sizes" style="color: #0288D1 !important">{{ $product[0]->shop_name }}</label>
            </div>
        </div>
    </div>
</div>

<br/>
<!-- **************************************______Footer______*********************************-->
<footer>
    <div class="container" style="padding-top: 25px">
        <div class="row">
            <div class="col-md-7" style="padding-top:30px">
                <div class="form-group" style="display: inline-block;">
                    <center>
                        <div class="footerLink_section">
                            <a target="_blank" href="https://help.fashiostreet.com/aboutus.html" class="footerlinks">About Us</a>
                        </div>
                        <div class="footerLink_section">
                            <a target="_blank" href="https://help.fashiostreet.com" class="footerlinks">Sell On Fashiostreet</a>
                        </div>
                        <div class="footerLink_section">
                            <a target="_blank" href="https://help.fashiostreet.com/contactus.html" class="footerlinks">Contact Us</a>
                        </div>
                        <div class="footerLink_section">
                            <a target="_blank" href="https://help.fashiostreet.com/policies.html" class="footerlinks">Listing Policy</a>
                        </div>
                    </center>
                </div>
                <br><br>
                <div class="form-group" style="display: inline-block;">
                    <center>
                        <div class="footerLink_section">
                            <a target="_blank" href="https://help.fashiostreet.com/help.html" class="footerlinks">Help</a>
                        </div>
                        <div class="footerLink_section">
                            <a target="_blank" href="https://help.fashiostreet.com/policies.html" class="footerlinks">Privacy Policy</a>
                        </div>
                        <div class="footerLink_section">
                            <a target="_blank" href="https://help.fashiostreet.com/term_condition.html" class="footerlinks">Terms of use</a>
                        </div>
                        <div class="footerLink_section">
                            <a target="_blank" href="https://careers.fashiostreet.com" class="footerlinks">Careers</a>
                        </div>
                    </center>
                </div>
            </div>
            <div class="col-md-5" style="text-align: center">
                <h4 class="font_class">Follow Us On</h4>
                <a href="https://www.facebook.com/fashiostreet/" class="facebook" target="_blank">
                    <i class="fa fa-facebook-square" aria-hidden="true"></i>
                </a>&nbsp;
                <a href="https://twitter.com/Fashiostreet10/" class="twitter" target="_blank">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>&nbsp;
                <a href="https://www.instagram.com/fashiostreet10/" class="Insta" target="_blank">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>&nbsp;
                <a href="https://www.linkedin.com/company/fashiostreet/" class="linkedIn" target="_blank">
                    <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                </a>&nbsp;
                <a href="https://plus.google.com/u/0/105052627957777439787" class="google" target="_blank">
                    <i class="fa fa-google" aria-hidden="true"></i>
                </a>
                <a href="https://msg91.com/startups/?utm_source=startup-banner" target="_blank"  style="margin-top:-10px"><img src="https://msg91.com/images/startups/msg91Badge.png" id="msg91" width="70" height="50" title="MSG91 - SMS for Startups" alt="Bulk SMS - MSG91"></a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <p class="text-center font_class" ><i class="fa fa-copyright" aria-hidden="true"></i>&nbsp;Copyright 2017  @  FashioStreet.&nbsp;&nbsp;All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<!-- **************************************______Footer______*********************************-->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/category.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    $(document).ready(function(){
        var size = null;
        var clearTime = null;
        $('js_size_btn').removeClass('active_size');
        $('.js_size_btn[data-size='+ size +']').addClass('active_size');
        $('.modal_close_btn').click(function(){
            $('.img_modal').hide();
        });


        $(document).on('click','.js_p_small_img',function(){
            var img = $(this).children('center').children('img').attr('src');
            console.log(img);
            $('.js_p_big_img').attr('src',img);
            console.log($('.js_p_big_img').attr('src'));
        });
        $(document).on('click','.js_size_btn',function () {
            size = $(this).attr('data-size');
            $('.js_size_btn').removeClass('active_size');
            $(this).addClass('active_size');
            $('.toast').show().html(size + ' size selected');
            clearTimeout(clearTime);
            clearTime = setTimeout(function () {
                $('.toast').hide();
            }, 2000);
        });
        $(document).on('click','.js_add_to_cart',function () {
            if(localStorage.getItem('token') == null && localStorage.getItem('local_id') == null)
            {
                $('.toast').show().html('please login to add product into cart <a href="/api/auth/login">login</a>');
                clearTimeout(clearTime);
                clearTime = setTimeout(function () {
                    $('.toast').hide();
                }, 2000);
                return false;
            }
            if(size != null)
            {
                $.ajax({
                    type: 'post',
                    url: 'http://localhost/laravel/fashiostreet_client/public/user/addtocart',
                    data: {
                        'product_id': $(this).attr('data-id'),
                        'size' : size,
                        'qty' : 1
                    },
                    success: function (response) {
                        $('.toast').show().html('product successfully added to cart');
                        clearTimeout(clearTime);
                        clearTime = setTimeout(function () {
                            $('.toast').hide();
                        }, 3000);
                    },
                    error: function (request, status, error) {
                        var error_msg = 'failed to add product to cart';
                        if(request.responseJSON.message != undefined)
                        {
                           error_msg =  request.responseJSON.message;
                        }
                        $('.toast').show().html(error_msg);
                        clearTimeout(clearTime);
                        clearTime = setTimeout(function () {
                            $('.toast').hide();
                        }, 2000);
                    }
                });
            }
            else{
                $('.toast').show().html('please select size first');
                clearTimeout(clearTime);
                clearTime = setTimeout(function(){
                    $('.toast').hide();
                },2000);
            }
        });
        var token = localStorage.getItem('token');
        var local_id = localStorage.getItem('local_id');
        if(token != null || local_id != null)
        {
            $('.js_hide_login').hide();
            $('.js_show_login').show();
        }
        else{
            $('.js_hide_login').show();
            $('.js_show_login').hide();
        }
        var _0x1a83=["\x63\x6C\x69\x63\x6B","\x2E\x6A\x73\x5F\x6C\x6F\x67\x6F\x75\x74","\x6C\x6F\x63\x61\x6C\x5F\x69\x64","\x72\x65\x6D\x6F\x76\x65\x49\x74\x65\x6D","\x74\x6F\x6B\x65\x6E","\x75\x73\x65\x72\x20\x73\x75\x63\x63\x65\x73\x73\x66\x75\x6C\x6C\x79\x20\x6C\x6F\x67\x6F\x75\x74","\x68\x74\x6D\x6C","\x73\x68\x6F\x77","\x2E\x74\x6F\x61\x73\x74","\x68\x69\x64\x65","\x6F\x6E"];$(document)[_0x1a83[10]](_0x1a83[0],_0x1a83[1],function(){localStorage[_0x1a83[3]](_0x1a83[2]);localStorage[_0x1a83[3]](_0x1a83[4]);$(_0x1a83[8])[_0x1a83[7]]()[_0x1a83[6]](_0x1a83[5]);clearTimeout(clearTime);clearTime= setTimeout(function(){$(_0x1a83[8])[_0x1a83[9]]()},2000)})
    });
</script>
</body>
</html>