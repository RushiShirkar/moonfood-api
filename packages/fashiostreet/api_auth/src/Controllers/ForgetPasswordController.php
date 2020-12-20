<?php
namespace fashiostreet\api_auth\Controllers;
use fashiostreet\api_auth\ResetPassword\ResetPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use FS_Response;
class ForgetPasswordController {

    protected $resetpassword;
    function __construct()
    {
        $this->resetpassword = new ResetPasswordController();
    }
    public function resendOTP(Request $request)
    {
        $otp = $this->resetpassword->getOTP1($request);
        
        $msg = new SendSMS();
        if($msg->send($request->mobile,$otp->code))
        {
            return FS_Response::success('message','OTP Successfully send to your mobile');
        }
        else
        {
            return FS_Response::error(500,'no otp found');
        }
        
        //return FS_Response::success('message',$otp);

    }
    public function forgetview(){
        return view('api_auth::forgetpassword');
    }
    public function completeforgetview(){
        return view('api_auth::reset_password');
    }
    public function forgetpassword(Request $request)
    {
        return $this->resetpassword->CreateResetPassword($request);
    }
    public function CompletedForgetPassword(Request $request)
    {
        return $this->resetpassword->CompleteResetPassword($request,$request->code);
    }
    public function CompletedForgetPassword1(Request $request)
    {
        $id = DB::select('select id from customer where mobile = ?',[$request->mobile]);
        if($this->resetpassword->CompleteResetPassword($request,$request->code))
        {
            return FS_Response::success('data',encrypt($id[0]->id));
        }
    }
}
