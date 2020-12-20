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

    <title>fashiostreet - {{ $data['sub_category'] }} - {{ $data['city'] }}</title>
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
        .out_wishlist{
            color:#BDBDBD;
        }
        .in_wishlist{
            color:red;
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
<body class="light_gray marg-head_top">
<center>
    <div class="toast" style="position:fixed;z-index:99999;font-size:18px;left:50%;transform:translate(-50%,0);bottom:30px;display:none;padding:10px;background-color: black;color:white;opacity: 0.8;">
    </div>
</center>
<nav class="navbar navbar-fixed-top pzero desktop">
    <div class="row pzero h_row1">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 logo_col">
            <a href="/" class="pzero"><img src="{{ asset('assets/img/fashiostreet_logo.png') }}" style="width:135%" alt="Fashiostreet,Fashionstreet,Fashion street"></a>
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
                        @php
                            $value = '';
                            if(isset($data['q']))
                                $value = $data['q'];
                        @endphp
                        <input type="text" id="product_search_txt" class="mzero search_pro" placeholder="Search Product in this city" value="{{ $value }}" autocomplete="off">
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
                                         <img src="{{ asset('assets/img/handkerchief.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
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
                                         <img src="{{ asset('assets/img/vest.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
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
                                         <img src="{{ asset('assets/img/w_sock.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
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
                                         <img src="{{ asset('assets/img/shrug.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
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
                                         <img src="{{ asset('assets/img/b_suit.jpg') }}" alt="samsung-galaxy-y" class="vertical_center img-fluid" style="max-width:100% !important;height:100% !important" />
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
<!--***********************************   Main Content   *****************************-->
<div class="mobile">


    <!--   Main Div -->
    <div id="main" style="">
        <div class="back" id="mobile_header" style="top: 0;left: 0;">
            <div class="row  listfilter" >
                <div class="col-xs-3 back">
                    <a href="/shop/{{ $data['city'] }}?shop={{ $data['shop_name'] }}"><i class="fa fa-angle-left textcolor height" aria-hidden="true" style="font-size:30px"></i></a>
                </div>
                <div class="col-xs-3 back" id="location">
                    <span  class="glyphicon glyphicon-map-marker textcolor glyphicon-height height"></span>
                </div>
                <div class="col-xs-3 back" id="shop">
                    <i class="fa fa-building-o textcolor glyphicon-height height" aria-hidden="true"></i>
                </div>
                <div class="col-xs-3 back" id="category">
                    <span class="glyphicon glyphicon-menu-hamburger textcolor glyphicon-height height"></span>
                </div>

            </div>
        </div>

        <div class="row" style="text-align: left;margin-top:5px;">
            <div class="col-xs-12 " style=" background-color:#f5f5f5;">
            @if(isset($data['q']))
                <h3>Search : {{ $data['q'] }}</h3>
                <span><a href="/shop/{{ $data['city'] }}?shop=All Shop">{{ $data['city'] }}</a> > <a href="/shop/{{ $data['city'] }}/available-category?shop={{ $data['shop_name'] }}">{{ $data['shop_name'] }}</a> > {{ $data['q'] }}</span>
            @else
                <span><a href="/shop/{{ $data['city'] }}?shop=All Shop">{{ $data['city'] }}</a> > <a href="/shop/{{ $data['city'] }}/available-category?shop={{ $data['shop_name'] }}">{{ $data['shop_name'] }}</a> > {{ $data['sub_category'] }}</span>
            @endif
            </div>
        </div>

        <div class="row bottomstyle textcolor"  >
            <div  class="col-xs-6 col back glyphicon-height " id="filter">
                <span class="glyphicon glyphicon-filter textcolor height" >
            </span > &nbsp filter</div>
            <div class="col-xs-6 col back glyphicon-height dropup" style="border-left: 1px solid #9e9e9e">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#fff">
                    <span class="glyphicon glyphicon-sort height textcolor"></span>&nbsp sort-by
                    <ul class="dropdown-menu" style="width:100%;text-align: center;">
                        <li><a class="product_sort_click" data-value="ltoh" href="javascript:void(0)"> Price: Low to High</a></li>
                        <li><a class="product_sort_click" data-value="htol" href="javascript:void(0)">Price: High to Low</a></li>
                    </ul>
                </a>
            </div>

        </div>


    </div>

    <!--   Filter Div -->
    <div id="showfilter" style="display: none;">


        <div class="row back" >
            <div class="col-xs-2 padsearchselect">
                <i class="fil-back_btn" class="fa fa-angle-left textcolor height" aria-hidden="true" style="font-size:30px"></i>
            </div>
            <div class="col-xs-10  padsearchselect" >

                <span class="float-left textcolor glyphicon-height height" > Filters </span>

            </div>
        </div>

        <div id="mobile_filter_js" class="margin" style="height: 90vh">

        </div>

        <div class="row bottomstyle" >
            <div class="col-xs-12 back" >
                <form>
                    <input type="button" class="back textcolor height glyphicon-height fil-back_btn" name="apply" value="Apply" style="border:0;outline: none;">
                </form>

            </div>
        </div>
    </div>

    <!--   Search Location Div -->
    <div id="searchlocation"  style="display: none;">

        <div class="row back" style="padding-top:10px;padding-bottom: 10px">
            <div class="col-xs-2 back" >
                <i id="loc-back_btn" class="fa fa-angle-left textcolor" aria-hidden="true" style="font-size:30px"></i>
            </div>
            <div class="col-xs-10 padsearchselect float-left" >

                <span class="float-left textcolor" > Select Location </span>

            </div>
        </div>

        <div class="col-xs-12" style="margin-top: 10px">

            <div class="searchbox-border">
                <form id="mob_city_selector_form">
                    <input type="text" id="mob_city_search_txt" name="searchbox"  placeholder="Enter your city" class="search" autocomplete="off">
                </form>
            </div>
            <div class="suggestion_div" style="width:100% !important;margin-top:15px;"><ul>
            <div class="city_suggestion_box ">

            </div>
                </ul></div>

            <div id="static_city_suggestion">
                <ul>
                    <div class="static_city_suggestion">
                    </div>
                </ul>
            </div>
        </div>
    </div>

    <!--   Select Shop Div -->
    <div id="selectshop" style="display: none;">

        <div class="row back" style="padding-top:10px;padding-bottom: 10px" >
            <div class="col-xs-2 back">
                <i id="sh-back_btn" class="fa fa-angle-left textcolor" aria-hidden="true" style="font-size:30px"></i>
            </div>
            <div class="col-xs-10 padsearchselect float-left" >

                <span class="float-left textcolor"> Select Shop </span>

            </div>
        </div>

        <div class="col-xs-12" style="margin-top: 10px">

            <div class="searchbox-border">
                <form id="mob_shop_search_form">
                    <input type="text" id="mob_shop_search_txt" name="searchbox" placeholder="Enter Shop Name" class="search" autocomplete="off">
                </form>
            </div>
            <div class="suggestion_div" style="width:100% !important;margin-top:15px;">
            <ul>
            <div class="shop_suggestion_box">
            </div>
            </ul>
            </div>

            <div id="static_shop_suggestion">
                <ul>
                    <div class="static_shop_suggestion">
                    </div>
                </ul>
            </div>


        </div>

    </div>

    <!-- select category -->
    <div id="select_category" style="display: none;">


        <div class="row back" style="padding-top:10px;padding-bottom: 10px">
            <div class="col-xs-2 back" >
                <i id="cat-back_btn" class="fa fa-angle-left textcolor" aria-hidden="true" style="font-size:30px"></i>
            </div>
            <div class="col-xs-10 padsearchselect float-left" >

                <span class="float-left textcolor" > Select Category </span>

            </div>
        </div>


        <div class="col-xs-12" style="margin-top : 10px;padding-bottom:10px;border-bottom: 1px solid #BDBDBD;">
            <div class="searchbox-border">
                <form method="post" action="" >
                    <input type="text" id="mob_product_search_txt" name="searchbox"  placeholder="Search Products in this city" class="search">
                    <span class="glyphicon glyphicon-remove js_clear_btn" style="display:none;position:absolute;padding:6px;margin-top:6px;color:white;border-radius:50%;right:20px;background-color:#263238;"></span>
                </form>
            </div>
        </div>
        <div class="mob_product_suggestion_div suggestion_div" style="position:relative !important;margin-top:60px;width:100% !important;padding-left:10px;">

        </div>
        <div class="js_gender_category">
            <div class="menu-container1" style="padding-top: 60px;">
                <div class="menu1">
                    <ul>
                        <li><a href="javascript:void(0)">Top Wears</a>
                            <ul>
                                <li><a href="/product/{{ $data['city']}}/T-shirts?shop={{ $data['shop_name'] }}&gender=men&category=top wear">T-Shirts</a></li>
                                <li><a href="/product/{{ $data['city']}}/Formal shirts?shop={{ $data['shop_name'] }}&gender=men&category=top wear">Formal Shirts</a></li>
                                <li><a href="/product/{{ $data['city']}}/Casual shirts?shop={{ $data['shop_name'] }}&gender=men&category=top wear">Casual Shirts</a></li>
                                <li><a href="/product/{{ $data['city']}}/Jackets?shop={{ $data['shop_name'] }}&gender=men&category=top wear">Jackets</a></li>
                                <li><a href="/product/{{ $data['city']}}/Sweatshirts?shop={{ $data['shop_name'] }}&gender=men&category=top wear">Sweatshirts</a></li>
                                <li><a href="/product/{{ $data['city']}}/Sweaters?shop={{ $data['shop_name'] }}&gender=men&category=top wear">Sweaters</a></li>
                                <li><a href="/product/{{ $data['city']}}/Kurtas?shop={{ $data['shop_name'] }}&gender=men&category=top wear">Kurtas</a></li>
                                <li><a href="/product/{{ $data['city']}}/Sherwanis?shop={{ $data['shop_name'] }}&gender=men&category=top wear">Sherwanis</a></li>
                                <li><a href="/product/{{ $data['city']}}/Suits?shop={{ $data['shop_name'] }}&gender=men&category=top wear">Suits</a></li>
                                <li><a href="/product/{{ $data['city']}}/Blazers?shop={{ $data['shop_name'] }}&gender=men&category=top wear">Blazers</a></li>
                                <li><a href="/product/{{ $data['city']}}/Pullovers?shop={{ $data['shop_name'] }}&gender=men&category=top wear">Pullovers</a></li>
                                <li><a href="/product/{{ $data['city']}}/Cardigans?shop={{ $data['shop_name'] }}&gender=men&category=top wear">Cardigans</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Bottom Wears</a>
                            <ul>
                                <li><a href="/product/{{ $data['city']}}/Jeans?shop={{ $data['shop_name'] }}&gender=men&category=bottom wear">Jeans</a></li>
                                <li><a href="/product/{{ $data['city']}}/Trousers?shop={{ $data['shop_name'] }}&gender=men&category=bottom wear">Trousers</a></li>
                                <li><a href="/product/{{ $data['city']}}/Cargos?shop={{ $data['shop_name'] }}&gender=men&category=bottom wear">Cargos</a></li>
                                <li><a href="/product/{{ $data['city']}}/Shorts and 3 by 4ths?shop={{ $data['shop_name'] }}&gender=men&category=bottom wear">Shorts & 3/4ths</a></li>
                                <li><a href="/product/{{ $data['city']}}/Track pants?shop={{ $data['shop_name'] }}&gender=men&category=bottom wear">Track pants</a></li>
                                <li><a href="/product/{{ $data['city']}}/Dhotis?shop={{ $data['shop_name'] }}&gender=men&category=bottom wear">Dhotis</a></li>
                                <li><a href="/product/{{ $data['city']}}/Lungis?shop={{ $data['shop_name'] }}&gender=men&category=bottom wear">Lungis</a></li>
                                <li><a href="/product/{{ $data['city']}}/Pyjamas?shop={{ $data['shop_name'] }}&gender=men&category=bottom wear">Pyjamas</a></li>
                            </ul>
                        </li>/
                        <li><a href="javascript:void(0)">Sports Wears</a>
                            <ul>
                                <li><a href="/product/{{ $data['city']}}/Sports T-Shirts?shop={{ $data['shop_name'] }}&gender=men&category=sports wear">Sports T-Shirts</a></li>
                                <li><a href="/product/{{ $data['city']}}/Track pants?shop={{ $data['shop_name'] }}&gender=men&category=sports wear">Track pants</a></li>
                                <li><a href="/product/{{ $data['city']}}/Track Suits?shop={{ $data['shop_name'] }}&gender=men&category=sports wear">Track suits</a></li>
                                <li><a href="/product/{{ $data['city']}}/Shorts?shop={{ $data['shop_name'] }}&gender=men&category=sports wear">Shorts</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">InnerWears & SleepWears</a>
                            <ul>
                                <li><a href="/product/{{ $data['city']}}/Briefs and trunks?shop={{ $data['shop_name'] }}&gender=men&category=innerwear and sleepwear">Briefs & trunks</a></li>
                                <li><a href="/product/{{ $data['city']}}/Vests?shop={{ $data['shop_name'] }}&gender=men&category=innerwear and sleepwear">Vests</a></li>
                                <li><a href="/product/{{ $data['city']}}/Boxers?shop={{ $data['shop_name'] }}&gender=men&category=innerwear and sleepwear">Boxers</a></li>
                                <li><a href="/product/{{ $data['city']}}/Thermals?shop={{ $data['shop_name'] }}&gender=men&category=innerwear and sleepwear">Thermals</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Fabrics</a>
                            <ul>
                                <li><a href="/product/{{ $data['city']}}/Shirt Fabrics?shop={{ $data['shop_name'] }}&gender=men&category=fabrics">Shirt fabrics</a></li>
                                <li><a href="/product/{{ $data['city']}}/Multi-purpose Fabrics?shop={{ $data['shop_name'] }}&gender=men&category=fabrics">Multi-purpose fabrics</a></li>
                                <li><a href="/product/{{ $data['city']}}/Kurta Fabrics?shop={{ $data['shop_name'] }}&gender=men&category=fabrics">Kurta fabrics</a></li>
                                <li><a href="/product/{{ $data['city']}}/Trouser Fabrics?shop={{ $data['shop_name'] }}&gender=men&category=fabrics">Trouser fabrics</a></li>
                                <li><a href="/product/{{ $data['city']}}/Suit Fabrics?shop={{ $data['shop_name'] }}&gender=men&category=fabrics">Suit fabrics</a></li>
                                <li><a href="/product/{{ $data['city']}}/Safari Fabrics?shop={{ $data['shop_name'] }}&gender=men&category=fabrics">Safari fabrics</a></li>
                            </ul>
                        </li>

                        <li><a href="javascript:void(0)">Accessories</a>
                            <ul>
                                <li><a href="/product/{{ $data['city']}}/Socks?shop={{ $data['shop_name'] }}&gender=men&category=accessories">Socks</a></li>
                                <li><a href="/product/{{ $data['city']}}/Ties?shop={{ $data['shop_name'] }}&gender=men&category=accessories">Ties</a></li>
                                <li><a href="/product/{{ $data['city']}}/Cufflinks?shop={{ $data['shop_name'] }}&gender=men&category=accessories">Cufflinks</a></li>
                                <li><a href="/product/{{ $data['city']}}/Mufflers?shop={{ $data['shop_name'] }}&gender=men&category=accessories">Mufflers</a></li>
                                <li><a href="/product/{{ $data['city']}}/Scarfs?shop={{ $data['shop_name'] }}&gender=men&category=accessories">Scarfs</a></li>
                                <li><a href="/product/{{ $data['city']}}/Shirts Studs?shop={{ $data['shop_name'] }}&gender=men&category=accessories">Shirt Studs</a></li>
                                <li><a href="/product/{{ $data['city']}}/Cravats?shop={{ $data['shop_name'] }}&gender=men&category=accessories">Cravats</a></li>
                                <li><a href="/product/{{ $data['city']}}/Bandanas?shop={{ $data['shop_name'] }}&gender=men&category=accessories">Bandanas</a></li>
                                <li><a href="/product/{{ $data['city']}}/Arm Warmers?shop={{ $data['shop_name'] }}&gender=men&category=accessories">Arm warmers</a></li>
                                <li><a href="/product/{{ $data['city']}}/Pocket Squares?shop={{ $data['shop_name'] }}&gender=men&category=accessories">Pocket squares</a></li>
                                <li><a href="/product/{{ $data['city']}}/Handkerchiefs?shop={{ $data['shop_name'] }}&gender=men&category=accessories">Handkerchiefs</a></li>
                                <li><a href="/product/{{ $data['city']}}/Suspenders?shop={{ $data['shop_name'] }}&gender=men&category=accessories">Suspenders</a></li>
                                <li><a href="/product/{{ $data['city']}}/Gloves?shop={{ $data['shop_name'] }}&gender=men&category=accessories">Gloves</a></li>
                                <li><a href="/product/{{ $data['city']}}/Turbans?shop={{ $data['shop_name'] }}&gender=men&category=accessories">Turbans</a></li>
                                <li><a href="/product/{{ $data['city']}}/Towels?shop={{ $data['shop_name'] }}&gender=men&category=accessories">Towels</a></li>
                            </ul>
                        </li>

                        <li><a href="javascript:void(0)">Others</a>
                            <ul>
                                <li><a href="/product/{{ $data['city']}}/Raincoats?shop={{ $data['shop_name'] }}&gender=men&category=others">Raincoats</a></li>
                                <li><a href="/product/{{ $data['city']}}/Wind Cheaters?shop={{ $data['shop_name'] }}&gender=men&category=others">Wind cheaters</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="menu-container1">
                <div class="menu2">
                    <ul>
                        <li><a href="javascript:void(0)">Western Wears</a>
                            <ul>
                                <li><a href="/product/{{ $data['city']}}/Shirts?shop={{ $data['shop_name'] }}&gender=women&category=western wear">Shirts</a></li>
                                <li><a href="/product/{{ $data['city']}}/Tops?shop={{ $data['shop_name'] }}&gender=women&category=western wear">Tops</a></li>
                                <li><a href="/product/{{ $data['city']}}/Tunics?shop={{ $data['shop_name'] }}&gender=women&category=western wear">Tunics</a></li>
                                <li><a href="/product/{{ $data['city']}}/Kaftans?shop={{ $data['shop_name'] }}&gender=women&category=western wear">Kaftans</a></li>
                                <li><a href="/product/{{ $data['city']}}/Bodysuits?shop={{ $data['shop_name'] }}&gender=women&category=western wear">BodySuits</a></li>
                                <li><a href="/product/{{ $data['city']}}/T-Shirts?shop={{ $data['shop_name'] }}&gender=women&category=western wear">Polos and T-Shirts</a></li>
                                <li><a href="/product/{{ $data['city']}}/Dresses?shop={{ $data['shop_name'] }}&gender=women&category=western wear">Dresses</a></li>
                                <li><a href="/product/{{ $data['city']}}/Jeans?shop={{ $data['shop_name'] }}&gender=women&category=western wear">Jeans</a></li>
                                <li><a href="/product/{{ $data['city']}}/Trousers?shop={{ $data['shop_name'] }}&gender=women&category=western wear">Trousers</a></li>
                                <li><a href="/product/{{ $data['city']}}/Capris?shop={{ $data['shop_name'] }}&gender=women&category=western wear">Capris</a></li>
                                <li><a href="/product/{{ $data['city']}}/Cargos?shop={{ $data['shop_name'] }}&gender=women&category=western wear">Cargos</a></li>
                                <li><a href="/product/{{ $data['city']}}/Dungarees?shop={{ $data['shop_name'] }}&gender=women&category=western wear">Dungarees</a></li>
                                <li><a href="/product/{{ $data['city']}}/Shorts and Skirts?shop={{ $data['shop_name'] }}&gender=women&category=western wear">Shorts & Skirts</a></li>
                                <li><a href="/product/{{ $data['city']}}/Fashion Jackets?shop={{ $data['shop_name'] }}&gender=women&category=western wear">Fashion Jackets</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Ethnic Wears</a>
                            <ul>
                                <li><a href="/product/{{ $data['city']}}/Sarees?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear">Sarees</a></li>
                                <li><a href="/product/{{ $data['city']}}/Kurtas?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear">Kurtas</a></li>
                                <li><a href="/product/{{ $data['city']}}/Dress Material?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear">Dress Material</a></li>
                                <li><a href="/product/{{ $data['city']}}/Lehenga Choli?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear">Lehenga Choli</a></li>
                                <li><a href="/product/{{ $data['city']}}/Blouse?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear">Blouse</a></li>
                                <li><a href="/product/{{ $data['city']}}/Harem Pants?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear">Harem Pants</a></li>
                                <li><a href="/product/{{ $data['city']}}/Patialas?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear">Patialas</a></li>
                                <li><a href="/product/{{ $data['city']}}/Leggings?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear">Leggings</a></li>
                                <li><a href="/product/{{ $data['city']}}/Anarkali?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear">Anarkali</a></li>
                                <li><a href="/product/{{ $data['city']}}/Salwars?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear">Salwars</a></li>
                                <li><a href="/product/{{ $data['city']}}/Blouse Fabric?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear">Blouse Fabrics</a></li>
                                <li><a href="/product/{{ $data['city']}}/Chudidars?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear">Chudidars</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Winter & Seasonal</a>
                            <ul>
                                <li><a href="/product/{{ $data['city']}}/Sweaters?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal">Sweaters</a></li>
                                <li><a href="/product/{{ $data['city']}}/Pullovers?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal">Pullovers</a></li>
                                <li><a href="/product/{{ $data['city']}}/Sweatshirts?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal">SweatShirts</a></li>
                                <li><a href="/product/{{ $data['city']}}/Jackets?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal">Jackets</a></li>
                                <li><a href="/product/{{ $data['city']}}/Raincoats?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal">Raincoats</a></li>
                                <li><a href="/product/{{ $data['city']}}/Windcheaters?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal">Windcheaters</a></li>
                                <li><a href="/product/{{ $data['city']}}/Cardigans?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal">cardigans</a></li>
                                <li><a href="/product/{{ $data['city']}}/Coats?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal">coats</a></li>
                                <li><a href="/product/{{ $data['city']}}/Ponchos?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal">Ponchos</a></li>
                                <li><a href="/product/{{ $data['city']}}/Thermals?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal">Thermals</a></li>
                                <li><a href="/product/{{ $data['city']}}/Winter Jackets?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal">Winter Jackets</a></li>
                                <li><a href="/product/{{ $data['city']}}/Shawls?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal">Shawls</a></li>
                                <li><a href="/product/{{ $data['city']}}/Mufflers?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal">Mufflers</a></li>
                                <li><a href="/product/{{ $data['city']}}/Gloves?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal">Gloves</a></li>
                                <li><a href="/product/{{ $data['city']}}/Socks?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal">Socks</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Sports & Gym Wears</a>
                            <ul>
                                <li><a href="/product/{{ $data['city']}}/Track Pants?shop={{ $data['shop_name'] }}&gender=women&category=sports and gym wear">Track Pants</a></li>
                                <li><a href="/product/{{ $data['city']}}/Track Suits?shop={{ $data['shop_name'] }}&gender=women&category=sports and gym wear">Track Suits</a></li>
                                <li><a href="/product/{{ $data['city']}}/Track Tops?shop={{ $data['shop_name'] }}&gender=women&category=sports and gym wear">Track Tops</a></li>
                                <li><a href="/product/{{ $data['city']}}/T-shirts?shop={{ $data['shop_name'] }}&gender=women&category=sports and gym wear">T-Shirts</a></li>
                                <li><a href="/product/{{ $data['city']}}/Socks and Stockings?shop={{ $data['shop_name'] }}&gender=women&category=sports and gym wear">Socks & Stockings</a></li>
                                <li><a href="/product/{{ $data['city']}}/Tights?shop={{ $data['shop_name'] }}&gender=women&category=sports and gym wear">Tights</a></li>
                                <li><a href="/product/{{ $data['city']}}/Caps?shop={{ $data['shop_name'] }}&gender=women&category=sports and gym wear">Caps</a></li>
                                <li><a href="/product/{{ $data['city']}}/Sports Bras?shop={{ $data['shop_name'] }}&gender=women&category=sports and gym wear">Sports Bras</a></li>
                                <li><a href="/product/{{ $data['city']}}/Shorts?shop={{ $data['shop_name'] }}&gender=women&category=sports and gym wear">Shorts</a></li>
                                <li><a href="/product/{{ $data['city']}}/Sports Jackets?shop={{ $data['shop_name'] }}&gender=women&category=sports and gym wear">Sports Jackets</a></li>
                                <li><a href="/product/{{ $data['city']}}/Sarongs?shop={{ $data['shop_name'] }}&gender=women&category=sports and gym wear">Sarongs</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Lingerie & Sleep Wears</a>
                            <ul>
                                <li><a href="/product/{{ $data['city']}}/Bras?shop={{ $data['shop_name'] }}&gender=women&category=Lingerie and sleep wear">Bras</a></li>
                                <li><a href="/product/{{ $data['city']}}/Panties?shop={{ $data['shop_name'] }}&gender=women&category=Lingerie and sleep wear">Panties</a></li>
                                <li><a href="/product/{{ $data['city']}}/Night Dresses and Suits?shop={{ $data['shop_name'] }}&gender=women&category=Lingerie and sleep wear">Night Dresses & Suits</a></li>
                                <li><a href="/product/{{ $data['city']}}/Swim and BeachWears?shop={{ $data['shop_name'] }}&gender=women&category=Lingerie and sleep wear">Swim & BeachWears</a></li>
                                <li><a href="/product/{{ $data['city']}}/Gowns?shop={{ $data['shop_name'] }}&gender=women&category=Lingerie and sleep wear">Gowns</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="menu-container1">
                <div class="menu3">
                    <ul>
                        <li><a href="javascript:void(0)">Boy's Clothing</a>
                            <ul>
                                <li><a href="/product/{{ $data['city']}}/T-shirts?shop={{ $data['shop_name'] }}&gender=baby and kids&category=boy's clothing">Polos & T-Shirts</a></li>
                                <li><a href="/product/{{ $data['city']}}/Kurtas?shop={{ $data['shop_name'] }}&gender=baby and kids&category=boy's clothing">Kurtas</a></li>
                                <li><a href="/product/{{ $data['city']}}/Raincoats?shop={{ $data['shop_name'] }}&gender=baby and kids&category=boy's clothing">Raincoats</a></li>
                                <li><a href="/product/{{ $data['city']}}/Jackets?shop={{ $data['shop_name'] }}&gender=baby and kids&category=boy's clothing">Jackets</a></li>
                                <li><a href="/product/{{ $data['city']}}/Sweatshirts?shop={{ $data['shop_name'] }}&gender=baby and kids&category=boy's clothing">Sweatshirts</a></li>
                                <li><a href="/product/{{ $data['city']}}/Sweaters?shop={{ $data['shop_name'] }}&gender=baby and kids&category=boy's clothing">Sweaters</a></li>
                                <li><a href="/product/{{ $data['city']}}/Pullovers?shop={{ $data['shop_name'] }}&gender=baby and kids&category=boy's clothing">Pullovers</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Baby Boy</a>
                            <ul>
                                <li><a href="/product/{{ $data['city']}}/Sleep Suits?shop={{ $data['shop_name'] }}&gender=baby and kids&category=baby boy">Sleep Suits</a></li>
                                <li><a href="/product/{{ $data['city']}}/Bodysuits?shop={{ $data['shop_name'] }}&gender=baby and kids&category=baby boy">Body Suits</a></li>
                                <li><a href="/product/{{ $data['city']}}/T-shirts?shop={{ $data['shop_name'] }}&gender=baby and kids&category=baby boy">Polos & T-Shirts</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Baby Girl</a>
                            <ul>
                                <li><a href="/product/{{ $data['city']}}/Sleep Suits?shop={{ $data['shop_name'] }}&gender=baby and kids&category=baby girl">Sleep Suits</a></li>
                                <li><a href="/product/{{ $data['city']}}/Bodysuits?shop={{ $data['shop_name'] }}&gender=baby and kids&category=baby girl">Body Suits</a></li>
                                <li><a href="/product/{{ $data['city']}}/Baby Girl Dresses?shop={{ $data['shop_name'] }}&gender=baby and kids&category=baby girl">Baby Girl Dresses</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">Girl's Clothing</a>
                            <ul>
                                <li><a href="/product/{{ $data['city']}}/Dresses?shop={{ $data['shop_name'] }}&gender=baby and kids&category=girl's clothing">Dresses</a></li>
                                <li><a href="/product/{{ $data['city']}}/Skirts?shop={{ $data['shop_name'] }}&gender=baby and kids&category=girl's clothing">Skirts</a></li>
                                <li><a href="/product/{{ $data['city']}}/Salwar Kurtas?shop={{ $data['shop_name'] }}&gender=baby and kids&category=girl's clothing">Salwar Kurtas</a></li>
                                <li><a href="/product/{{ $data['city']}}/Kurtas?shop={{ $data['shop_name'] }}&gender=baby and kids&category=girl's clothing">Kurtas</a></li>
                                <li><a href="/product/{{ $data['city']}}/Lehenga Choli?shop={{ $data['shop_name'] }}&gender=baby and kids&category=girl's clothing">Lehenga Choli</a></li>
                                <li><a href="/product/{{ $data['city']}}/Ethnic Sets?shop={{ $data['shop_name'] }}&gender=baby and kids&category=girl's clothing">Ethnic Sets</a></li>
                                <li><a href="/product/{{ $data['city']}}/Sarees?shop={{ $data['shop_name'] }}&gender=baby and kids&category=girl's clothing">Sarees</a></li>
                                <li><a href="/product/{{ $data['city']}}/Mufflers?shop={{ $data['shop_name'] }}&gender=baby and kids&category=girl's clothing">Mufflers</a></li>
                                <li><a href="/product/{{ $data['city']}}/Thermals?shop={{ $data['shop_name'] }}&gender=baby and kids&category=girl's clothing">Thermals</a></li>
                                <li><a href="/product/{{ $data['city']}}/Sweaters?shop={{ $data['shop_name'] }}&gender=baby and kids&category=girl's clothing">Sweaters</a></li>
                                <li><a href="/product/{{ $data['city']}}/Sweatshirts?shop={{ $data['shop_name'] }}&gender=baby and kids&category=girl's clothing">Sweatshirts</a></li>
                                <li><a href="/product/{{ $data['city']}}/Raincoats?shop={{ $data['shop_name'] }}&gender=baby and kids&category=girl's clothing">Raincoats</a></li>
                                <li><a href="/product/{{ $data['city']}}/Jackets?shop={{ $data['shop_name'] }}&gender=baby and kids&category=girl's clothing">Jackets</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

<!--mobile head end -->


    <div class="container-fluid mpzero" id="product_list">
        <div class="row" >
            @if(!isset($data['flag']))
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-0 pzero product_filter_row filter_col" id="product_filter_row" style="background-color: #FFF;border-right: 1px solid #E0E0E0;padding: 4px 0px !important" >
                <div class="js_filter_loading loading_product_div">
                </div>
                <div id="pc_product_filter" class="row filter_col">
                    <div style="background-color: #FFFFFF !important;">
                    <div class="col-md-12 filter_row">
                        <label class="applied_filter">Filters</label>
                        <a href="javascript:void(0)" class="clear_all clear_all_filter">CLEAR ALL</a>
                        <div class="product_filter_result">

                        </div>
                    </div>
                    <div class="col-md-12 filter_row ">
                        <label class="filter_title">Shop</label>
                        <a href="javascript:void(0)" class="clear_all js_all_shop_btn">All Shop</a>
                        <div class="form-group">
                            <input type="search" placeholder="search shop" class="shop_name_search form-control">
                        </div>
                        <div class="js_check_shop">

                        </div>
                        <div class="js_search_shop_result">
                            <div class="checkbox">
                                <label class="container"><input type="checkbox" class="filter-input" name="shop" value="DRESS CODE">&nbsp
                                    <span class="checkmark"></span>
                                    DRESS CODE</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 filter_row">
                        <label class="filter_title">PRICE</label>
                        <form>
                            <div class="checkbox">
                                <label class="container"><input type="checkbox" class="filter-input" name="price" value="0-500">&nbsp
                                    <span class="checkmark"></span>
                                    Below 500</label>
                            </div>
                            <div class="checkbox">
                                <label class="container"><input type="checkbox" class="filter-input" name="price" value="500-700">&nbsp
                                    <span class="checkmark"></span>
                                    500 - 700</label>
                            </div>
                            <div class="checkbox">
                                <label class="container"><input type="checkbox" class="filter-input" name="price" value="700-1000">&nbsp
                                    <span class="checkmark"></span>
                                    700 - 1000</label>
                            </div>
                            <div class="checkbox">
                                <label class="container"><input type="checkbox" class="filter-input" name="price" value="1000-1300">&nbsp
                                    <span class="checkmark"></span>
                                    1000 - 1300</label>
                            </div>
                            <div class="checkbox">
                                <label class="container"><input type="checkbox" class="filter-input" name="price" value="1300-1500">&nbsp
                                    <span class="checkmark"></span>
                                    1300 - 1500</label>
                            </div>
                            <div class="checkbox">
                                <label class="container"><input type="checkbox" class="filter-input" name="price" value="1500-2000">&nbsp
                                    <span class="checkmark"></span>
                                    1500 - 2000</label>
                            </div>
                            <div class="checkbox">
                                <label class="container"><input type="checkbox" class="filter-input" name="price" value="2000-100000">&nbsp
                                    <span class="checkmark"></span>
                                    Above 2000</label>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-12 filter_row js_sizes_filter">
                        <label class="filter_title">SIZE</label>
                        <div class="js_size_filter" style="max-height:200px;overflow-x: auto">
                            <center style="margin-top:10px;"><img style="width:40px" src="{{ asset('assets/img/loader.gif') }}"/></center>
                        </div>
                        <br/>
                    </div>
                    <div class="col-md-12 filter_row">
                        <label class="filter_title">COLOR</label>
                        <div class="checkbox">
                            <label class="container"><input type="checkbox" class="filter-input" name="color" value="black">&nbsp
                                <span class="checkmark"></span>
                                <span class="glyphicon glyphicon-stop" style="font-size:18px;color: #000000;"></span> Black</label>
                        </div>
                        <div class="checkbox">
                            <label class="container"><input type="checkbox" class="filter-input" name="color" value="green">&nbsp
                                <span class="checkmark"></span>
                                <span class="glyphicon glyphicon-stop" style="font-size:18px;color: #4CAF50;"></span> Green</label>
                        </div>
                        <div class="checkbox">
                            <label class="container"><input type="checkbox" class="filter-input" name="color" value="yellow">&nbsp
                                <span class="checkmark"></span>
                                <span class="glyphicon glyphicon-stop" style="font-size:18px;color: #FFEB3B;"></span> Yellow</label>
                        </div>
                        <div class="checkbox">
                            <label class="container"><input type="checkbox" class="filter-input" name="color" value="gray">&nbsp
                                <span class="checkmark"></span>
                                <span class="glyphicon glyphicon-stop" style="font-size:18px;color: #9E9E9E;"></span> Gray</label>
                        </div>
                        <div class="checkbox">
                            <label  class="container"><input type="checkbox" class="filter-input" name="color" value="maroon">&nbsp
                                <span class="checkmark"></span>
                                <span class="glyphicon glyphicon-stop" style="font-size:18px;color: #800000;"></span> Maroon</label>
                        </div>
                        <div class="checkbox">
                            <label  class="container"><input type="checkbox" class="filter-input" name="color" value="blue">&nbsp
                                <span class="checkmark"></span>
                                <span class="glyphicon glyphicon-stop" style="font-size:18px;color: #2196F3;"></span> Blue</label>
                        </div>
                        <div class="checkbox">
                            <label  class="container"><input type="checkbox" class="filter-input" name="color" value="dark Blue">&nbsp
                                <span class="checkmark"></span>
                                <span class="glyphicon glyphicon-stop" style="font-size:18px;color: #0D47A1;"></span> Dark Blue</label>
                        </div>
                        <div class="checkbox">
                            <label  class="container"><input type="checkbox" class="filter-input" name="color" value="skin colour">&nbsp
                                <span class="checkmark"></span>
                                <span class="glyphicon glyphicon-stop" style="font-size:18px;color: #CC8443;"></span> Skin Colour</label>
                        </div>
                        <div class="checkbox">
                            <label  class="container"><input type="checkbox" class="filter-input" name="color" value="white">&nbsp
                                <span class="checkmark"></span>
                                <span class="glyphicon glyphicon-stop" style="font-size:18px;color: #FFFFFF;"></span> White</label>
                        </div>
                        <div class="checkbox">
                            <label  class="container"><input type="checkbox" class="filter-input" name="color" value="brown">&nbsp
                                <span class="checkmark"></span>
                                <span class="glyphicon glyphicon-stop" style="font-size:18px;color: #795548;"></span> Brown</label>
                        </div>
                        <div class="checkbox">
                            <label  class="container"><input type="checkbox" class="filter-input" name="color" value="orange">&nbsp
                                <span class="checkmark"></span>
                                <span class="glyphicon glyphicon-stop" style="font-size:18px;color: #FF9800;"></span> Orange</label>
                        </div>
                        <div class="checkbox">
                            <label  class="container"><input type="checkbox" class="filter-input" name="color" value="purple">&nbsp
                                <span class="checkmark"></span>
                                <span class="glyphicon glyphicon-stop" style="font-size:18px;color: #9C27B0;"></span> Purple</label>
                        </div>
                        <div class="checkbox">
                            <label  class="container"><input type="checkbox" class="filter-input" name="color" value="multicolor">&nbsp
                                <span class="checkmark"></span>
                                <span class="glyphicon glyphicon-stop" style="font-size:18px;color: #FFFFFF;"></span> Multicolour</label>
                        </div>
                        <div class="checkbox">
                            <label  class="container"><input type="checkbox" class="filter-input" name="color" value="red">&nbsp
                                <span class="checkmark"></span>
                                <span class="glyphicon glyphicon-stop" style="font-size:18px;color: #D50000;"></span> Red</label>
                        </div>
                        <div class="checkbox">
                            <label  class="container"><input type="checkbox" class="filter-input" name="color" value="pink">&nbsp
                                <span class="checkmark"></span>
                                <span class="glyphicon glyphicon-stop" style="font-size:18px;color: #E91E63;"></span> Pink</label>
                        </div>
                    </div>
                    <div class="col-md-12 filter_row">
                        <label class="filter_title">DISCOUNT</label>
                        <div class="checkbox">
                            <label class="container"><input type="checkbox" class="filter-input" name="discount" value="0-20">&nbsp
                                <span class="checkmark"></span>
                                0 - 20%</label>
                        </div>
                        <div class="checkbox">
                            <label class="container"><input type="checkbox" class="filter-input" name="discount" value="20-40">&nbsp
                                <span class="checkmark"></span>
                                20 - 40%</label>
                        </div>
                        <div class="checkbox">
                            <label class="container"><input type="checkbox" class="filter-input" name="discount" value="40-60">&nbsp
                                <span class="checkmark"></span>
                                40 - 60%</label>
                        </div>
                        <div class="checkbox">
                            <label class="container"><input type="checkbox" class="filter-input" name="discount" value="60-80">&nbsp
                                <span class="checkmark"></span>
                                60 - 80%</label>
                        </div>
                        <div class="checkbox">
                            <label class="container"><input type="checkbox" class="filter-input" name="discount" value="80-100">&nbsp
                                <span class="checkmark"></span>
                                Above 80%</label>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12 white mpzero">
                
                <div class="js_filter_loading loading_product_div">

                </div>
                <div class="row sort_row" style="padding:10px 10px;">
                    <div class="col-lg-6 col-md-6" style="padding-top:5px" >
                        @if(isset($data['q']))
                            <h3>Search : {{ $data['q'] }}</h3>
                            <span style="font-size: 1.1vmax"><a href="/shop/{{ $data['city'] }}?shop=All Shop">{{ $data['city'] }}</a> > <a href="/shop/{{ $data['city'] }}/available-category?shop={{ $data['shop_name'] }}">{{ $data['shop_name'] }}</a> > {{ $data['q'] }}</span>
                        @else
                            <span style="font-size: 1.1vmax"><a href="/shop/{{ $data['city'] }}?shop=All Shop">{{ $data['city'] }}</a> > <a href="/shop/{{ $data['city'] }}/available-category?shop={{ $data['shop_name'] }}">{{ $data['shop_name'] }}</a> > {{ $data['sub_category'] }}</span>
                        @endif

                    </div>
                    <div class="col-lg-6 col-md-6 mpzero">
                        <div style="float: right;">
                            <label style="font-weight: 700">Sort by :</label>
                            <select class="product_sort" style="padding: 5px;font-size: 1.1vmax">
                                <option value="htol">
                                    <a href="javascript:void(0)">Price : High to Low</a>
                                </option>
                                <option value="ltoh">
                                    <a href="javascript:void(0)">Price : Low to High</a>
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- list of product -->
                    <div class="more_product_div" id="product_body_div">
                    @if(count($products) > 0)
                    @foreach($products as $product)

                            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 border1 pzero">
                                <div data-w_flag="{{ $product->wishlistflag }}" data-id="{{ $product->id }}" class="wishlist_btn" style="cursor: pointer">
                                    @php
                                        if($product->wishlistflag == 0)
                                        {
                                            $class = 'out_wishlist';
                                        }
                                        else{
                                            $class = 'in_wishlist';
                                        }

                                    @endphp
                                    <span class="glyphicon glyphicon-heart {{ $class }}" style="font-size: 22px"></span>
                                </div>
                                <a target="_blank" href="/product/{{ $data['city'] }}/{{ $product->name }}/{{ $product->id }}/buy?shop={{ $product->shop_name }}" class="decoration_none">
                                    <div class="row img_l_container hover">
                                        <div class="col-xs-4 col-sm-12 col-md-12">
                                            <div class="small_inner_container min-height ">

                                                <img src="{{ $product->image[0] }}" alt="{{ $product->name }}" class="list-img vertical_center img-fluid"/>

                                            </div>
                                        </div>
                                        <div class="col-xs-8 col-sm-12 col-md-12">
                                            <div class="inner_container p_title text18 text-black lineclampin">
                                                {{ $product->name }}
                                            </div>
                                            @php
                                                $discount = ($product->selling_price * 100)/$product->mrp_price;
                                                $discount = (int)$discount;
                                                $discount = 100 - $discount;
                                            @endphp
                                            <div class="inner_container text18 font-bold text-black">
                                                <b>Rs. {{ $product->selling_price }}/-</b> &nbsp <small style="color:green"><del style="color:gray !important;">{{ $product->mrp_price }}</del> &nbsp {{ $discount }}% off</small>
                                            </div>
                                            <div class="inner_container font-bold text18 mr_3 lineclampin">
                                                Store : {{ $product->shop_name }}
                                            </div>

                                        </div>
                                    </div>
                                </a>
                            </div>

                    @endforeach
                    @else
                        @if(isset($data['q']))
                            @include('fashiostreet_client::error500',['request' => array('error' => 'No '.$data['q'].' Found')]);
                        @else
                            @include('fashiostreet_client::error500',['request' => array('error' => 'No '.$data['sub_category'].' Found')]);
                        @endif
                    @endif
                    </div>
                    <br/><br/><br/>
                    <div style="margin-top:50px;"></div>
                    <div class="z-depth-3 js_scroll_top" style="position:fixed;padding:10px 10px;background-color:white;color:#333;bottom:70px;right:20px;z-index: 999">
                        <span class="glyphicon glyphicon-chevron-up"></span>
                    </div>
                    <!---->
                </div>
            </div>
            @if(count($products) > 0 && count($products) >= 14)
                <center><button id="load_more_product_btn" class="btn btn-default btn-lg" style="margin-top:10px;">Click here to load More</button></center>
                <div id="loading_sign" style="margin-top:10px;display:none"><center><img style="width:50px" src="{{ asset('assets/img/loader.gif') }}"/><h3>loading more shop</h3></center></div>
            @endif
            @else
                @php
                    $request->error = 'Aaaah! Something went wrong';
                @endphp
                @include('fashiostreet_client::error500',['request' => $request]);
            @endif
            <br/><br/>
                <div style="margin-top:150px;">
                <center style="color:silver">www.fashiostreet.com</center>
                </div>
        </div>
    </div>

<!-- Custom StyleSheet -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/category.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/shop_city_list.js') }}"></script>
<script>
    $(document).ready(function(){
        var clearTime = null;
        $(document).on('click','.wishlist_btn',function(){
            var element = this;
            if(localStorage.getItem('token') == null && localStorage.getItem('local_id') == null)
            {
                $('.toast').show().html('Please login to add product into wishlist - <a href="/api/auth/login">login</a>');
                clearTimeout(clearTime);
                clearTime = setTimeout(function () {
                    $('.toast').hide();
                }, 4000);
                return false;
            }
            var product_id = $(this).attr('data-id');
            var wishlist_flag = $(this).attr('data-w_flag');
            //return 'p_id : ' + product_id + ' | w_id : ' + wishlist_flag;
            if(wishlist_flag == 1) {
                $.ajax({
                    type: 'post',
                    url: '/user/deletewishlist/json',
                    data: {
                        'product_id': $(this).attr('data-id')
                    },
                    success: function (response) {
                        $(element).attr('data-w_flag',0);
                        console.log('wishlist flag : ' + $(element).attr('data-w_flag'));
                        $('.toast').show().html('product remove from wishlist');
                        console.log($(this).children('span'));
                        if($(element).has('span'))
                        {
                            $(element).find('span').removeClass('in_wishlist');
                            $(element).find('span').addClass('out_wishlist');
                        }
                        else{
                            $(element).removeClass('in_wishlist');
                            $(element).addClass('out_wishlist');
                        }
                        clearTimeout(clearTime);
                        clearTime = setTimeout(function () {
                            $('.toast').hide();
                        }, 1000);
                    },
                    error: function (request, status, error) {
                        $('.toast').show().html('failed to delete product from wishlist');
                        clearTimeout(clearTime);
                        clearTime = setTimeout(function () {
                            $('.toast').hide();
                        }, 2000);
                    }
                });
            }
            else{
                $.ajax({
                    type: 'post',
                    url: '/user/addtowishlist/json',
                    data: {
                        'product_id': $(this).attr('data-id')
                    },
                    headers:{
                        'token' : localStorage.getItem('token'),
                        'local-id' : localStorage.getItem('local_id')
                    },
                    success: function (response) {
                        $(element).attr('data-w_flag',1);
                        console.log('wishlist flag : ' + $(element).attr('data-w_flag'));
                        var msg = 'product added to wishlist';
                        console.log(response);
                        if(response.result != undefined)
                        {
                            msg = response.result;
                        }
                        $('.toast').show().html(msg);
                        if($(element).has('span'))
                        {
                            $(element).find('span').removeClass('out_wishlist');
                            $(element).find('span').addClass('in_wishlist');
                        }
                        else{
                            $(element).removeClass('out_wishlist');
                            $(element).addClass('in_wishlist');
                        }
                        clearTimeout(clearTime);
                        clearTime = setTimeout(function () {
                            $('.toast').hide();
                        }, 1000);
                    },
                    error: function (request, status, error) {
                        console.log(request.responseJSON);
                        var msg = 'failed to add product to wishlist';
                        if(request.responseJSON.message == "product already in wishlist")
                        {
                            msg = "product already in wishlist";
                        }
                        $('.toast').show().html(msg);
                        clearTimeout(clearTime);
                        clearTime = setTimeout(function () {
                            $('.toast').hide();
                        }, 2000);
                    }
                });
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
