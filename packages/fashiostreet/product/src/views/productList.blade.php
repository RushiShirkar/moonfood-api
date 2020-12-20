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
                                  <a href="/admin/kolhapur/T-shirts?shop={{ $data['shop_name'] }}&gender=men&category=top wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                  <a href="/admin/kolhapur/Casual shirts?shop={{ $data['shop_name'] }}&gender=men&category=top wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Sweatshirts?shop={{ $data['shop_name'] }}&gender=men&category=top wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Jeans?shop={{ $data['shop_name'] }}&gender=men&category=bottom wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Cargos?shop={{ $data['shop_name'] }}&gender=men&category=bottom wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                  <a href="/admin/kolhapur/Socks?shop={{ $data['shop_name'] }}&gender=men&category=accessories" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Shorts and 3 by 4ths?shop={{ $data['shop_name'] }}&gender=men&category=bottom wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                  <a href="/admin/kolhapur/Handkerchiefs?shop={{ $data['shop_name'] }}&gender=men&category=accessories" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Track pants?shop={{ $data['shop_name'] }}&gender=men&category=sports wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Briefs and trunks?shop={{ $data['shop_name'] }}&gender=men&category=innerwear and sleepwear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Vests?shop={{ $data['shop_name'] }}&gender=men&category=innerwear and sleepwear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Boxers?shop={{ $data['shop_name'] }}&gender=men&category=innerwear and sleepwear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                  <a href="/admin/kolhapur/Shirts?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                  <a href="/admin/kolhapur/Tops?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Single one piece?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                  <a href="/admin/kolhapur/Dress Material?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/T-Shirts?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                  <a href="/admin/kolhapur/Leggings?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Jeans?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                  <a href="/admin/kolhapur/Salwars?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Dungarees?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                  <a href="/admin/kolhapur/Capris?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Fashion Jackets?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                  <a href="/admin/kolhapur/Sweatshirts?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Jeans?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                  <a href="/admin/kolhapur/Socks?shop={{ $data['shop_name'] }}&gender=women&category=winter and seasonal" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Tops?shop={{ $data['shop_name'] }}&gender=women&category=western wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Kurtis?shop={{ $data['shop_name'] }}&gender=women&category=ethnic wear" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                  <a href="/admin/kolhapur/T-shirts?shop={{ $data['shop_name'] }}&gender=baby and kids&category=boy's clothing" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                  <a href="/admin/kolhapur/T-shirts?shop={{ $data['shop_name'] }}&gender=baby and kids&category=baby boy" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Kurtas?shop={{ $data['shop_name'] }}&gender=baby and kids&category=boy's clothing" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                  <a href="/admin/kolhapur/Bodysuits?shop={{ $data['shop_name'] }}&gender=baby and kids&category=baby boy" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Jackets?shop={{ $data['shop_name'] }}&gender=baby and kids&category=boy's clothing" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Sweaters?shop={{ $data['shop_name'] }}&gender=baby and kids&category=boy's clothing" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                                    <a href="/admin/kolhapur/Dresses?shop={{ $data['shop_name'] }}&gender=baby and kids&category=girl's clothing" class="decoration_none" style="width: 100%;border-bottom: 0px">
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
                       <!-- <label class="filter_title">PRICE</label>
                        <form>
                          <div class="row mpzero">
                           <div class="col-md-6 mpzero"><input type="text" name="shopsearchbox" id="min"  placeholder="Min" style="width: 100%"></div>
                           <div class="col-md-6 mpzero"><input type="text" name="shopsearchbox1" id="max"  placeholder="Max" style="width: 100%"></div>
                          </div>
                        </form>
                        <button class="btn col-md-6 priceRange">APPLY</button>-->
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
                                <div class="inner_container text18 font-bold text-black">
                                                <button product-id="{{$product->id}}" class="btn btn-orange btn-block btn-sm DeleteProduct">Delete</button>
                                            </div>
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
        $(document).on('click','.DeleteProduct',function () {
                $.ajax({
                    type:'post',
                    url:'/deleteProduct',
                    data:{
                        'product_id' :$(this).attr('product-id')
                    },
                    success:function(response){
                        $('.toast').show().html(response.data);
                        console.log(response);
                        setTimeout(function () {
                            $('.toast').hide();
                        },5000);
                        window.location.reload();
                    },
                    error:function (error) {
                        setTimeout(function () {
                            $('.toast').hide();
                        },20000);
                        if(error.responseJSON.message == undefined)
                            $('.toast').show().html('failed to remove product');
                        else
                            $('.toast').show().html(error.responseJSON.message);
                    }
                });
            });
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
