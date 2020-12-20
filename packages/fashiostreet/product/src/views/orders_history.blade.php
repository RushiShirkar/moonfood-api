
    <div class="col-md-8 col-sm-8" style="padding:0;border-radius:2px;background-color:#FFFFFF;box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
        <div style="text-align: center;background-color:#757575;padding: 18px;color:#FFFFFF;border-radius:2px 2px 0 0">
            <p style="font-size: 20px;margin: 0px">HD ORDERS</p>
        </div>
        <div class="box box-info">
            <div class="box-body">
                @if(count($order) <= 0)
                    <h2>No orders found</h2>
                @else
                @for($i=0;$i < count($order);$i++)
                    <div style="margin: 15px;background-color: #FAFAFA;border: 1px solid #E0E0E0;border-radius: 2px">
                    <div style="background-color: #9E9E9E;padding: 15px;color: #FFFFFF">
                        ORDER NO : {{ $order[$i]['order_id'] }}
                        @if($order[$i]['order_status'] != 1)
                            @php
                                $hr = date('h',strtotime($order[$i]['order_date']));
                                $timeFlag = date('A',strtotime($order[$i]['order_date']));
                                $delivery_time = '';
                                if($timeFlag == 'PM' && $hr >= 7 && $hr <= 8)
                                {
                                    $delivery_time = '11:00 AM';
                                }
                                else if($timeFlag == 'PM' && $hr > 8 && $hr < 12)
                                {
                                    $delivery_time = '3:00 PM';
                                }
                                else if($timeFlag == 'AM' && $hr >= 0 && $hr <= 12)
                                {
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
                                    $hr = (int) $hr;
                                    $delivery_time = $hr + 5;
                                    if($delivery_time > 12)
                                    {
                                        $delivery_time -= 12;
                                    }
                                    $delivery_time = $delivery_time.':00 PM';
                                }
                            @endphp
                            <span class="pull-right">YET TO DELIVER > Deliver within : {{ $delivery_time }}</span>
                        @else
                            <span class="pull-right">Delivered : {{ date('d M Y h:i A',strtotime($order[$i]['completed_at'])) }}</span>
                        @endif
                    </div>
                    <div class="row" style="margin: 0px">
                        <div class="col-md-9 col-sm-9" style="padding: 0px;border-right: 1px solid #F0F0F0">
                            @for($j=0;$j < count($order[$i]['products']);$j++)
                                @php
                                    $product = (array) $order[$i]['products'][$j];
                                @endphp
                                <div class="row" style="border-bottom: 1px solid #F0F0F0;margin: 0px">
                                <div class="col-md-4 col-sm-4">
                                    <img src="https://seller.fashiostreet.com/products/compress/{{ $product['image'] }}" class="wish_img">
                                </div>
                                <div class="col-md-8 col-sm-8" style="padding: 10px 0px;color:#757575">
                                    <h4 style="font-weight: bold;">{{ $product['name'] }}</h4>
                                    <p style="margin: 3px 0px">{{ $product['color'] }}</p>
                                    <p style="margin: 3px 0px">Sizes : {{ $product['size'] }}</p>
                                    <p style="margin: 3px 0px">Store : {{ $product['shop_name'] }}</p>
                                    <h4 style="margin: 7px 0px"><span style="font-weight: bold;"> Rs.{{ $product['selling_price'] }}</span> &nbsp;<span style="text-decoration: line-through;">Rs.{{ $product['mrp_price'] }}</span></h4>
                                </div>
                            </div>
                            @endfor
                        </div>
                        @php
                            $status = array('','','','');
                            if($order[$i]['order_status'] == 0)
                            {
                                $status[0] = 'active';
                            }
                            else if($order[$i]['order_status'] == 5)
                            {
                                $status[0] = 'active';
                                $status[1] = 'active';
                            }
                            else if($order[$i]['order_status'] == 6)
                            {
                                $status[0] = 'active';
                                $status[1] = 'active';
                                $status[2] = 'active';
                            }
                            else if($order[$i]['order_status'] == 1)
                            {
                                $status[0] = 'active';
                                $status[1] = 'active';
                                $status[2] = 'active';
                                $status[3] = 'active';
                            }
                        @endphp
                        <div class="col-md-3 col-sm-3" style="padding: 60px 0px;border-left: 1px solid #F0F0F0; padding-left: 20px">
                            @if($order[$i]['order_status'] != 2)
                                <div><span class="dot {{ $status[0] }}"></span><span style="padding:10px;top:-5px;position:relative;font-size:12px">ORDER PLACED</span></div>
                                <div class="vl {{ $status[1] }}"></div>
                                <div><span class="dot {{ $status[1] }}"></span><span style="padding:10px;top:-5px;position:relative;font-size:12px">PICKED UP</span></div>
                                <div class="vl {{ $status[2] }}"></div>
                                <div><span class="dot {{ $status[2] }}"></span><span style="padding:10px;top:-5px;position:relative;font-size:12px">ON THE WAY</span></div>
                                <div class="vl {{ $status[3] }}"></div>
                                <div><span class="dot {{ $status[3] }}"></span><span style="padding:10px;top:-5px;position:relative;font-size:12px">DELIVERED</span></div>
                            @else
                                <div style="padding:10px;background-color: red;max-width:100%;color:white;font-size: 18px;">
                                    cancel
                                </div>
                            @endif
                        </div>
                    </div>
                    <div style="background-color: #9E9E9E;padding: 15px;color: #FFFFFF">DELIVERY ADDRESS : {{ $order[$i]['address'] }}</div>
                </div>
                @endfor
                @endif
                @php
                    $page = 1;
                    if(isset($_GET['page']))
                    {
                        $page = (int) $_GET['page'];
                    }
                @endphp
                @if(count($order) == 15 && $page <= 1)
                    <center><a href="/user/ordersHistory?page={{ $page + 1 }}" id="loadmoreOrder" style="padding:10px;font-size:18px;background-color:silver;color:black">next</a></center>
                @elseif(count($order) == 15 && $page > 1)
                    <center><a href="/user/ordersHistory?page={{ $page - 1 }}" id="loadmoreOrder" style="padding:10px;font-size:18px;background-color:silver;color:black">prev</a> | <a href="/user/ordersHistory?page={{ $page + 1 }}" id="loadmoreOrder" style="padding:10px;font-size:18px;background-color:silver;color:black">next</a></center>
                @elseif(count($order) < 15 && $page > 1)
                    <center><a href="/user/ordersHistory?page={{ $page - 1 }}" id="loadmoreOrder" style="padding:10px;font-size:18px;background-color:silver;color:black">prev</a></center>
                @endif

            </div>
        </div>
    </div>