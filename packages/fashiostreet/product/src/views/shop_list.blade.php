@extends('fashiostreet_client::layout.frame')

@section('title','fashiostreet - '.$data['city'])

@section('category_shop')
    <link rel="stylesheet" href="{{ asset('assets/css/category_city.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/category_shop.css') }}">
@endsection
@section('script')
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        $(document).ready(function(){
            var page = 1;
            $('#load_more_btn').click(function(){
                $('#loading_sign').show();
                page++;
                var path = window.location.pathname;
                path = path + '/json?shop=All Shop&page=' + page;
                ajax_call(path,'get','','','shop_load');
            });
        });
    </script>
@endsection

@section('body')
    <div class="row mob_margin" style="padding:10px 10px" id="product_list">
        <div class="col-md-12 white" style="padding: 15px 15px;font-size: 15px">
            City > {{ $data['city'] }} > All Shops
        </div>
        @if(count($shops) > 0)
        <div id="load_more_shop">
        @for($i=0;$i < count($shops);$i++)
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 border1 pzero white">
                <a href="/shop/{{ $data['city'] }}/available-category?shop={{ $shops[$i]->name }}" class="decoration_none">
                    <div class="row img_l_container hover ">
                        <div class="col-xs-4 col-sm-12 col-md-12" >
                            <div class="small_inner_container min-height">

                                <img src="{{ $shops[$i]->image }}" alt="{{ $shops[$i]->name }}" class="list-img vertical_center img-fluid"/>

                            </div>
                        </div>
                        <div class="col-xs-8 col-sm-12 col-md-12">
                            <div class="inner_container p_title text18 text-black">
                                <span class="lineclampin" style="width:80% !important;font-weight: bold">{{ $shops[$i]->name }}</span> <button type="button" class="btn btn-info btn-xs" style="position:absolute;margin-top:-22px;right:5px;">4.6 &nbsp;<span class="glyphicon glyphicon-star"></span></button>
                            </div>
                            <div class="inner_container text18 font-bold text-black lineclampin">
                                Addr : {{ $shops[$i]->address }}
                            </div>
                            <div class="inner_container font-bold text18 lineclampin" style="text-align: center;">
                                Shop Now >>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
        @endfor
        </div>
        <center><button id="load_more_btn" class="btn btn-default btn-lg" style="margin-top:10px;">Click here to load More</button></center>
        <div id="loading_sign" style="margin-top:10px;display:none"><center><img style="width:50px" src="{{ asset('assets/img/loader.gif') }}"/><h3>loading more shop</h3></center></div>
        <br/>
        @else
            @php
                $request = array('error' => 'No Shop Found at '.$data['city']);
            @endphp
            @include('fashiostreet_client::error500',['request' => $request]);
        @endif
    </div>
@endsection