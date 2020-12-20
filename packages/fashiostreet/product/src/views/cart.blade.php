@extends('fashiostreet_client::layout.orders')

@section('title','order cart,fashiostreet')
@section('body')
    <div class="col-md-8 col-sm-8" style="margin: 0px 25px;padding:0;border-radius:2px;background-color:#FFFFFF;box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
        <div style="text-align: center;background-color:#757575;padding: 18px;color:#FFFFFF;border-radius:2px 2px 0 0">
            <p style="font-size: 20px;margin: 0px">
                HOME DELIVERY CART ({{ count($product) }})
                <a href=""><span class="glyphicon glyphicon-menu-left pull-left"></span></a>
            </p>
        </div>
        <div class="box box-info">
            <div class="box-body">
                @for($i=0;$i < count($product);$i++)
                    <div class="row" style="border-bottom: 1px solid #F0F0F0;margin: 0px;padding: 10px 15px">
                    <div class="col-md-3 col-sm-3">
                        <img src="{{ $product[$i]->image }}" class="wish_img">
                    </div>
                    <div class="col-md-8 col-sm-8" style="padding: 10px 0px;color:#757575">
                        <h4 style="font-weight: bold;">{{ $product[$i]->name }}</h4>
                        <p style="margin: 3px 0px"><span class="glyphicon glyphicon-stop" style="font-size: 18px"></span>{{ $product[$i]->color }}<br></p>
                        <p style="margin: 3px 0px">Sizes : {{ $product[$i]->size }}</p>
                        <p style="margin: 3px 0px">Store : {{ $product[$i]->shop_name }}</p>
                        <h4 style="margin: 7px 0px"><span style="font-weight: bold;"> Rs.{{ $product[$i]->selling_price }}</span> &nbsp;<span style="text-decoration: line-through;">Rs.{{ $product[$i]->mrp_price }}</span></h4>
                        <p><button data-cart_id="{{ $product[$i]->cart_id }}" data-id="{{ $product[$i]->id }}" class="mthc MoveToWishlist">MOVE TO WISHLIST</button></p>
                    </div>
                    <div class="col-md-1 col-sm-1" style="padding: 15px 0px">
                        <a class="DeleteProductFromCart" href="javascript:void(0)" data-cart_id="{{ $product[$i]->cart_id }}"><span class="glyphicon glyphicon-trash" style="font-size: 18px;color:#757575"></span></a>
                    </div>
                </div>
                @endfor
                @if(count($product) == 0)
                    <h4 style="text-align: center;color: #757575; padding: 20px">No Product in Cart</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('order_btn')
    @if(count($product) != 0)
        <a href="address" class="mthc btn-block" style="text-align:center;padding: 15px;font-weight: bold;background-color:#00E676">CONTINUE</a>
    @endif
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $(document).on('click','.DeleteProductFromCart',function () {
                $.ajax({
                    type:'post',
                    url:'/user/removefromcart',
                    data:{
                        'cart_id' :$(this).attr('data-cart_id')
                    },
                    success:function(response){
                        $('.toast').show().html('successfully remove from cart');
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        },1000);
                    },
                    error:function (error) {
                        setTimeout(function () {
                            $('.toast').hide();
                        },2000);
                        if(error.responseJSON.message == undefined)
                            $('.toast').show().html('failed to remove product from cart');
                        else
                            $('.toast').show().html(error.responseJSON.message);
                    }
                });
            });
            $(document).on('click','.MoveToWishlist',function () {
                $.ajax({
                    type:'post',
                    url:'/user/movetocart',
                    data:{
                        'cart_id' :$(this).attr('data-cart_id'),
                        'product_id' : $(this).attr('data-id')
                    },
                    success:function(response){
                        $('.toast').show().html('successfully move to wishlist');
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        },1000);
                    },
                    error:function (error) {
                        setTimeout(function () {
                            $('.toast').hide();
                        },2000);
                        if(error.responseJSON.message == undefined)
                            $('.toast').show().html('failed to move product');
                        else
                            $('.toast').show().html(error.responseJSON.message);
                    }
                });
            });
        });
    </script>
@endsection