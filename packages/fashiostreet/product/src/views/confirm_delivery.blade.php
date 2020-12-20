@extends('fashiostreet_client::layout.orders')

@section('title','confirm delivery,fashiostreet')

@section('body')
    <div class="col-md-8 col-sm-8" style="margin: 0px 25px;padding:0;border-radius:2px;background-color:#FFFFFF;box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
        <div style="text-align: center;background-color:#757575;padding: 18px;color:#FFFFFF;border-radius:2px 2px 0 0">
            <p style="font-size: 20px;margin: 0px">
                CONFIRM DELIVERY
            </p>
        </div>
        <div class="box box-info">
            <div class="box-body">
                <h5 style="padding: 8px 15px;font-weight: bold;color:#757575">ORDER ITEMS ({{ count($product) }})</h5>
                <div class="row" style="margin: 15px;background-color: #FAFAFA;border: 1px solid #E0E0E0;border-radius: 2px;padding: 10px 15px;color:#757575">
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
                            </div>
                        </div>
                    @endfor
                    @if(count($product) == 0)
                        <center><h3>No product in order list</h3></center>
                    @endif
                </div>
                <h5 style="padding: 8px 15px;font-weight: bold;color:#757575">DELIVERY ADDRESS</h5>
                @if(count($address) > 0)
                    <div class="row" style="margin: 15px;background-color: #FAFAFA;border: 1px solid #E0E0E0;border-radius: 2px;padding: 10px 15px;color:#757575">
                        <div class="col-md-12 col-sm-12">
                            <h4 style="font-weight: bold;">{{ $address[0]->first_name }} {{ $address[0]->last_name }}</h4>
                            <p>{{ $address[0]->address }}</p>
                            <p>{{ $address[0]->area }}</p>
                            <p>Mob : {{ $address[0]->mobile }}</p>
                        </div>
                    </div>
                @else
                    <div class="row" style="margin: 15px;background-color: #FAFAFA;border: 1px solid #E0E0E0;border-radius: 2px;padding: 10px 15px;color:#757575">
                        <div class="col-md-12 col-sm-12">
                            <center><h3>No address selected</h3></center>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('order_btn')
    <button class="mthc btn-block PlacedOrder" id="cont_with_address" style="text-align:center;padding: 15px;font-weight: bold;background-color:#00E676" dis>Confirm Order</button>
    <p style="color:red;margin-top:10px;">Note : only cash on delivery available</p>
@endsection

@section('extra_data')
    <div class="prof_sidebar" style="padding: 0px 15px;margin-top: 15px">
        <div style="padding:10px 0px;color:#757575">
            <h5 style="font-weight: bold">ESTIMATED DELIVERY</h5>
            @php
                $time = \Carbon\Carbon::now();
                $hr = date('h',strtotime($time));
                $timeFlag = date('A',strtotime($time));
                $delivery_time = '';
                $day = '';
                                if($timeFlag == 'PM' && $hr >= 7 && $hr <= 8)
                                {
                                    $day = 'tomorrow';
                                    $delivery_time = '11:00 AM';
                                }
                                else if($timeFlag == 'PM' && $hr > 8 && $hr < 12)
                                {
                                    $day = 'tomorrow';
                                    $delivery_time = '3:00 PM';
                                }
                                else if($timeFlag == 'AM' && $hr >= 0 && $hr <= 12)
                                {
                                    $day = 'today';
                                    if($hr >= 9)
                                    {
                                        $hr = (int) $hr;
                                        $delivery_time = $hr + 5;
                                        if($delivery_time > 12)
                                        {
                                            $delivery_time -= 12;
                                        }
                                        $delivery_time = $delivery_time.':00 PM';
                                        }
                                    else{
                                        $delivery_time = '3:00 PM';
                                    }
                                }
                                else{
                                    $day = 'today';
                                    $hr = (int) $hr;
                                    $delivery_time = $hr + 5;
                                    if($delivery_time > 12)
                                    {
                                        $delivery_time -= 12;
                                    }
                                    $delivery_time = $delivery_time.':00 PM';
                                }
            @endphp
            <p>Deliver By : {{ $day }} - {{ $delivery_time }}</p>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function(){
            $(document).on('click','.PlacedOrder',function () {
                $.ajax({
                    type:'post',
                    url:'http://localhost/laravel/fashiostreet_client/public/user/placeOrder',
                    data:{
                        'customer_name' : '{{ $address[0]->first_name }} {{ $address[0]->last_name }}',
                        'address' : '{{ $address[0]->address }} {{ $address[0]->area }}',
                        'contact' : '{{ $address[0]->mobile }}'
                    },
                    success:function(response){
                        $('.toast').show().html('successfully order placed');
                        setTimeout(function () {
                            window.location.href = 'ordersHistory';
                        },2000);
                    },
                    error:function (error) {
                        setTimeout(function () {
                            $('.toast').hide();
                        },2000);
                        if(error.responseJSON.message == undefined)
                            $('.toast').show().html('failed to placed order');
                        else
                            $('.toast').show().html(error.responseJSON.message);
                    }
                });
            });
        });
    </script>
@endsection