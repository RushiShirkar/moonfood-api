<?php

namespace fashiostreet\api_auth\Controllers;

use Activation;
use fashiostreet\api_auth\Activation\ActivationController;
use fashiostreet\api_auth\Exceptions\SystemException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use FS_Response;
use Illuminate\Support\Facades\DB;
use Validate;
use fashiostreet\api_auth\Exceptions\ErrorException;
use Illuminate\Support\Facades\Hash;
use fashiostreet\api_auth\Controllers\UserModel as UserModel;
use fashiostreet\api_auth\Controllers\SendSMS as SendSMS;

class RegisterController extends Controller
{
    protected $request;
    protected $activation;

    function __construct(Request $request)
    {
        $request = (object)$request->only(['mobile','password','code']);
        $this->request = $request;
        $this->activation = new ActivationController();
    }

    /*public function completeregister(){
        return view('api_auth::otpverify');
    }*/

    public function registerview(){
        return view('api_auth::register');
    }

    public function Register(Request $request)
    {
        DB::beginTransaction();
        $this->CredentialsValidate();
        $this->CheckUserExistsorNot();
        $user = $this->createUser($request);
        $user = $this->activation->CreateActivation($user);
        //send sms function is left
        $msg = new SendSMS();
        $msg->send($request->mobile,$user->code);
        DB::commit();
        return FS_Response::success('message',$user);
    }

    public function CompleteRegistration()
    {
        return $this->activation->CompleteActivation($this->request,$this->request->code);
    }

    public function resendOTP(Request $request)
    {
        $otp = $this->activation->getOTP($this->request);
        

            $msg = new SendSMS();
            if($msg->send($this->request->mobile,$otp->code))
            {
                return FS_Response::success('message','OTP Successfully send to your mobile');
            }
            else
            {
                return FS_Response::error(500,'no otp found');
            }
  

    }

    protected function CredentialsValidate()
    {
        if(!Validate::numericOnly($this->request->mobile,true,0,10)) {
            throw new ErrorException('Invalid mobile number found');
        }
    }

    public function hashPassword()
    {
        return Hash::make($this->request->password);
    }

    protected function createUser()
    {
        try{
            $user = new UserModel();
            $user->mobile = $this->request->mobile;
            $user->password = Hash::make($this->request->password);
            $user->save();
            return $user;
        }
        catch (QueryException $e)
        {
            throw new SystemException('failed to create user try again or contact to our customer service');
        }
    }

    protected function CheckUserExistsorNot()
    {
        $user = (array) DB::select('select id from customer where mobile = ? limit 1',[$this->request->mobile]);
        if(count($user) > 0)
        {
            throw new ErrorException('user already exists');
        }
        return $user;
    }
}