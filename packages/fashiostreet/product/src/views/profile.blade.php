<div class="col-md-8 col-sm-8" style="padding:0;border-radius:2px;background-color:#FFFFFF;box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
        <div style="text-align: center;background-color:#757575;padding: 18px;color:#FFFFFF;border-radius:2px 2px 0 0">
            <p style="font-size: 20px;margin: 0px">PROFILE</p>
        </div>
        <div class="box box-info" style="padding-top: 20px">
            <div class="box-body">
                <div class="clearfix"></div>
                <div class="row" style="margin: 15px;background-color: #FAFAFA;border: 1px solid #E0E0E0;border-radius: 2px;padding: 20px 15px;color:#757575">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Name :</label>
                            <div class="col-lg-8">
                                <input class="form-control" value="{{ $user[0]->name }}" type="text" name="name_txt">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Mobile :</label>
                            <div class="col-lg-8">
                                <input class="form-control" value="{{ $user[0]->mobile }}" type="number" name="mobile_txt" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Gender :</label>
                            <div class="col-md-8 col-sm-8">
                                @if($user[0]->gender == 'male')
                                    <input type="radio" name="gender" value="male" checked> Male
                                @else
                                    <input type="radio" name="gender" value="male"> Male
                                @endif
                                @if($user[0]->gender == 'female')
                                        <input type="radio" name="gender" value="female" checked> Female
                                @else
                                        <input type="radio" name="gender" value="female"> Female
                                @endif
                            </div>
                        </div>
                        <p style="text-align: center;padding:20px;margin: 0px"><button type="button" class="mthc js_saveProfile" style="padding: 6px 25px">SAVE</button></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
