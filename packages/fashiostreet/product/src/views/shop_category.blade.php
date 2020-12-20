@extends('fashiostreet_client::layout.frame')

@section('title','fashiostreet - '.$data['city'])

@section('category_shop')
    <link rel="stylesheet" href="{{ asset('assets/css/category_shop.css') }}">
@endsection
@section('script')
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        $(document).ready(function(){
            var page = 1;
            $('#show_more_product_btn').click(function(){
                page++;
                var url = '/product/topproduct/json?shop={{ $shop[0]['name'] }}&city={{ $data['city'] }}&page=' + page;
                ajax_call(url,'get','','','topproduct_load');
                console.log('new page call');
            });
        });
    </script>
@endsection


@section('body')
    <div id="product_list">
        <div class="row mob_margin">
            <div class="col-md-12" style="padding: 10px 15px;font-size: 15px">
                <a href="/shop/{{ $data['city'] }}?shop=All Shop">{{ $data['city'] }}</a> > {{ $shop[0]['name'] }}
            </div>
        </div>
        <div class="row city_row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-0 city_col1">
                <img src="{{ $shop[0]['image'][0] }}" height="190px" style="margin-top: 20px;width: 100%">
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 city_col2">
                <div class="row mpzero">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 mpzero">
                        <p class="shop_title">{{ $shop[0]['name'] }}</p>
                        <p class="shop_addr">{{ $shop[0]['address'] }}</p>
                        <p class="shop_time">Mob : {{ $shop[0]['contact'] }}/{{ $shop[0]['alternate_contact'] }}</p>
                        @php
                            $shop[0]['opening_time'] = strtotime($shop[0]['opening_time']);
                            $shop[0]['opening_time'] = date('h:ia',$shop[0]['opening_time']);

                            $shop[0]['closing_time'] = strtotime($shop[0]['closing_time']);
                            $shop[0]['closing_time'] = date('h:ia',$shop[0]['closing_time']);

                            if($shop[0]['opening_time'] == '12:00am')
                                $shop[0]['opening_time'] = '12:00pm';
                            else if($shop[0]['opening_time'] == '12:00pm')
                                $shop[0]['opening_time'] = '12:00am';

                            if($shop[0]['closing_time'] == '12:00am')
                                $shop[0]['closing_time'] = '12:00pm';
                            else if($shop[0]['closing_time'] == '12:00pm')
                                $shop[0]['closing_time'] = '12:00am';

                        @endphp
                        <p class="shop_time">Open Time :- {{ $shop[0]['opening_time'] }} - {{ $shop[0]['closing_time'] }} ({{ $shop[0]['closed_day'] }} Close)</p>
                        <span>Share : &nbsp</span>
                        <a href="" class="facebook" target="_blank">
                            <i class="fa fa-facebook-square" aria-hidden="true"></i>
                        </a>&nbsp;
                        <a href="" class="twitter" target="_blank">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>&nbsp;
                        <a href="" class="Insta" target="_blank">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                        </a>&nbsp;
                        <a href="" class="whatsapp" target="_blank">
                            <i class="fa fa-whatsapp " aria-hidden="true"></i>
                        </a>
                        <span class="shop_rats pull-right">( <span class="glyphicon glyphicon-star" style="font-size: 14px"></span> 4.3 Ratings )</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
        <h3>Offers : </h3>
        <div class="row">
            @if($shop[0]['offers'] != null)
            @for($i=0;$i < count($shop[0]['offers']);$i++)
            <div class="col-xs-6" style="background-color: white;padding:10px;border:1px solid gray;">
                <center><h3>{{ $shop[0]['offers'][$i] }}</h3></center>
            </div>
            @endfor
            @else
                <center><h3 style="background-color: white;padding:10px;">No offer found in these shop</h3></center>
            @endif
        </div>
        </div>

        <div class="row" style="padding:20px 10px">
            @if(count($products) > 0)
            <div class="col-md-12">
                <p class="trending_title">Trending Products :</p>
            </div>
            <div id="load_more_product">
            @foreach($products as $product)
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 border1 pzero white">
                    <a href="/product/{{ $product->name }}/{{ $product->id }}/buy" class="decoration_none">
                        <div class="row img_l_container hover ">
                            <div class="col-xs-4 col-sm-12 col-md-12" >
                                <div class="small_inner_container min-height">

                                    <img src="{{ $product->image[0] }}" alt="samsung-galaxy-y" class="list-img vertical_center img-fluid"/>

                                </div>
                            </div>
                            <div class="col-xs-8 col-sm-12 col-md-12">
                                <div class="inner_container p_title text18 text-black lineclampin">
                                    {{ $product->name }}
                                </div>
                                <div class="inner_container text18 font-bold text-black">
                                    <b>Rs. {{ $product->selling_price }}/-</b>
                                </div>
                                <div class="inner_container font-bold text18 lineclampin">
                                    Store : {{ $shop[0]['name'] }}
                                </div>

                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            </div>
            <div id="show_more_product_div" class="col-md-12 show-more_row">
                <a id="show_more_product_btn" class="pull-right show_more">SHOW MORE..</a>
            </div>
            @endif
        </div>

    </div>
@endsection