@extends('fashiostreet_client::layout.orders')

@section('title','select address for order,fashiostreet')

@section('body')
    @parent
    <div class="col-md-8 col-sm-8" style="margin: 0px 25px;padding:0;border-radius:2px;background-color:#FFFFFF;box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
        <div style="text-align: center;background-color:#757575;padding: 18px;color:#FFFFFF;border-radius:2px 2px 0 0">
            <p style="font-size: 20px;margin: 0px">ADDRESS</p>
        </div>
        <div class="box box-info">
            <div class="box-body">
                <div id="viewblock">
                    @if(count($address) > 0)
                        @for($i=0;$i < count($address);$i++)

                            <div class="row" style="margin: 15px;background-color: #FAFAFA;border: 1px solid #E0E0E0;border-radius: 2px;padding: 10px 15px;color:#757575">
                                <label style="display: block;cursor: pointer">
                                    <input data-address_id="{{ $address[$i]->id }}" class="setAddressId" name="address" value="on" type="radio" style="position: absolute;vertical-align: middle;margin:15px 10px;cursor: pointer">
                                    <div style="margin-left: 30px">
                                        <div class="col-md-11 col-sm-11">
                                            <h4 style="font-weight: bold;">{{ $address[$i]->first_name }} {{ $address[$i]->last_name }}</h4>
                                            <p>{{ $address[$i]->address }}</p>
                                            <p>{{ $address[$i]->area }}</p>
                                            <p>Mob : {{ $address[$i]->mobile }}</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @endfor
                    @else
                        <h4 style="text-align: center;color: #757575; padding: 20px">No Address Found</h4>
                    @endif
                </div>
                <div style="margin: 15px;border: 1px solid #E0E0E0;border-radius: 2px">
                    <button class="mthc btn-block" id="addbtn" style="padding: 15px;background-color: #9E9E9E">+ ADD ADDRESS</button>
                </div>
                <div id="addblock" class="row" style="display:none;margin: 15px;background-color: #FAFAFA;border: 1px solid #E0E0E0;border-radius: 2px;padding: 10px 15px;color:#757575">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">First name :</label>
                            <div class="col-lg-8">
                                <input class="form-control" id="fname_txt" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Last name :</label>
                            <div class="col-lg-8">
                                <input class="form-control" id="lname_txt" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Mobile :</label>
                            <div class="col-lg-8">
                                <input class="form-control" id="mobile_txt" type="number" maxlength="10">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Area/Locality :</label>
                            <div class="col-lg-8">
                                <input class="form-control" id="area_txt" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Detail Address :</label>
                            <div class="col-md-8">
                                <input class="form-control" id="address_txt" type="text">
                            </div>
                        </div>
                        <p style="text-align: center;padding:20px;margin: 0px"><button type="button" class="mthc js_saveaddress" style="padding: 6px 25px">SAVE</button><button id="cancelbtn" type="button" class="mthc_can" style="margin-left: 30px">CANCEL</button></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('order_btn')
    <button class="mthc btn-block" id="cont_with_address" style="text-align:center;padding: 15px;font-weight: bold;background-color:#00E676" dis>CONTINUE</button>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            var address_id = null;
            var selected = $("input[type='radio'][name='address']:checked");
            if (selected.length > 0) {
                address_id = selected.attr('data-address_id');
            }
            $(document).on('click','#cont_with_address',function () {
                if(address_id == null)
                {
                    setTimeout(function () {
                        $('.toast').hide();
                    },2000);
                    $('.toast').show().html('select address before continue');
                    return false;
                }
                window.location.href = 'confirm_address?a_id=' + address_id;
            });
            $(document).on('click','.setAddressId',function(){
                address_id = $(this).attr('data-address_id');
            });
            $(document).on('click','#addbtn',function(){
                $('#viewblock').hide();
                $('#addblock').show();
            });
            $(document).on('click','#cancelbtn',function(){
                $('#addblock').hide();
                $('#viewblock').show();
            });
            $(document).on('click','.deleteaddress',function () {
                $.ajax({
                    type:'post',
                    url:'/user/deleteaddress',
                    data:{
                        'address_id' : $(this).attr('data-id')
                    },
                    success:function(response){
                        $('.toast').show().html('address successfully remove');
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        },1000);
                    },
                    error:function (request, status, error) {
                        setTimeout(function () {
                            $('.toast').hide();
                        },2000);
                        $('.toast').show().html('failed to delete address');
                    }
                });
            });
            $(document).on('click','.js_editaddress',function(){
                console.log($(this).attr('data-product'));
                var product = JSON.parse($(this).attr('data-address'));
                console.log(product);

                $('#fname_txt').val(product.first_name);
                $('#lname_txt').val(product.last_name);
                $('#address_txt').val(product.address);
                $('#area_txt').val(product.area);
                $('#mobile_txt').val(product.mobile);
                $('.js_saveaddress').attr('data-id',product.id);
                $('#addblock').show();
                $('#viewblock').hide();
            });
            $(document).on('click','.js_saveaddress',function () {
                var url = '/user/';
                var data = {
                    'first_name' : $('#fname_txt').val(),
                    'last_name' : $('#lname_txt').val(),
                    'address' : $('#address_txt').val(),
                    'area' : $('#area_txt').val(),
                    'mobile' : $('#mobile_txt').val(),
                };
                if($(this).attr('data-id') != null || $(this).attr('data-id') != undefined)
                {
                    url = url + 'editAddress';
                    data.address_id = $(this).attr('data-id');
                }
                else{
                    url = url + 'addAddress';
                }
                console.log(url);
                $.ajax({
                    type:'post',
                    url:url,
                    data:data,
                    success:function(response){
                        $('.toast').show().html('address successfully updated');
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        },2000);
                    },
                    error:function (request, status, error) {
                        setTimeout(function () {
                            $('.toast').hide();
                        },2000);
                        $('.toast').show().html('failed to updated address');
                    }
                });
            })
        });

        $(document).on('click','.addressList',function (e) {
            $(this).find('input').prop('checked', function (i, checked) {
                return !checked
            });
        });
    </script>
@endsection