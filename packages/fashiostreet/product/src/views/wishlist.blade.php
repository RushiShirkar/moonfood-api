<div class="col-md-8 col-sm-8" style="padding:0;border-radius:2px;background-color:#FFFFFF;box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
        <div style="text-align: center;background-color:#757575;padding: 18px;color:#FFFFFF;border-radius:2px 2px 0 0">
            <p style="font-size: 20px;margin: 0px">WISHLIST</p>
        </div>
        <div class="box box-info">
            <div class="box-body">
                @if(count($products) > 0)
                    @for($i=0;$i < count($products);$i++)
                        <div class="row" style="border-bottom: 1px solid #F0F0F0;margin: 0px;padding: 10px 15px">
                            <div class="col-md-3 col-sm-3">
                                <img src="{{ $products[$i]->image }}" class="wish_img">
                            </div>
                            <div class="col-md-8 col-sm-8" style="padding: 10px 0px;color:#757575">
                                <h4 style="font-weight: bold;">{{ $products[$i]->name }}</h4>
                                <h4 style="margin: 7px 0px"><span style="font-weight: bold;"> Rs.{{ $products[$i]->selling_price }}</span> &nbsp;<span style="text-decoration: line-through;">Rs.{{ $products[$i]->mrp_price }}</span></h4>
                                <h4>Store : <span style="font-weight: normal">{{ $products[$i]->shop_name }}</span></h4>
                            </div>
                            <div class="col-md-1 col-sm-1" style="padding: 15px 0px">
                                <a href="javascript:void(0)" class="deleteWishlist" data-id="{{ $products[$i]->id }}"><span class="glyphicon glyphicon-trash" style="font-size: 18px;color:#757575"></span></a>
                            </div>
                        </div>
                    @endfor
                @else
                    <h4 style="text-align: center;color: #757575; padding: 20px">No Product in Wishlist</h4>
                @endif

            </div>
        </div>
    </div>