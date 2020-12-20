 <div class="col-md-8 col-sm-8" style="padding:0;border-radius:2px;background-color:#FFFFFF;box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
        <div style="text-align: center;background-color:#757575;padding: 18px;color:#FFFFFF;border-radius:2px 2px 0 0">
            <p style="font-size: 20px;margin: 0px">ADDRESS</p>
        </div>
        <div class="box box-info">
            <div class="box-body">
                <div id="viewblock">
                    @if(count($address) > 0)
                        @for($i=0;$i < count($address);$i++)
                            <div class="row" style="margin: 15px;background-color: #FAFAFA;border: 1px solid #E0E0E0;border-radius: 2px;padding: 10px 15px;color:#757575">
                                <div class="col-md-11 col-sm-11">
                                    <h4 style="font-weight: bold;">{{ $address[$i]->first_name }} {{ $address[$i]->last_name }}</h4>
                                    <p>{{ $address[$i]->address }}</p>
                                    <p>{{ $address[$i]->area }}</p>
                                    <p>Mob : {{ $address[$i]->mobile }}</p>
                                    <p><button data-address="{{ $address[$i] }}" class="mthc js_editaddress">EDIT ADDRESS</button></p>
                                </div>
                                <div class="col-md-1 col-sm-1" style="padding: 15px 0px">
                                    <a href="javascript:void(0)" class="deleteaddress" data-id="{{ $address[$i]->id }}"><span class="glyphicon glyphicon-trash" style="font-size: 18px;color:#757575"></span></a>
                                </div>
                            </div>
                        @endfor
                    @else
                        <h4 style="text-align: center;color: #757575; padding: 20px">No Address found</h4>
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