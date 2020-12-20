<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 6/25/2018
 * Time: 11:19 PM
 */

namespace fashiostreet\api_auth\ResetPassword;

use App\Http\Controllers\Controller;
use fashiostreet\api_auth\Activation\ResetPasswordTraits;
use fashiostreet\api_auth\UserController;
use FS_Response;
use fashiostreet\api_auth\Controllers\SendSMS as SendSMS;

class ResetPasswordController extends Controller
{
    use ResetPasswordTraits;
    protected $user;

    function __construct()
    {
        $this->user = new UserController();
    }

    public function CreateResetPassword($user)
    {
        $mobile = $user->mobile;
        $msg = new SendSMS();
        $resetpassword= null;
        $user = $this->user->findByCredential($user);
        if(($resetpassword = $this->exists($user,'yes')) != false)
        {
            $msg->send($mobile,$resetpassword->code);
            //send directly sms for activation because activation already exists
            return FS_Response::error('message','OTP already send to your account');
        }
        if($user = $this->create($user)) {
            $msg->send($mobile,$user->code);
            return FS_Response::success('message', 'please verify user');
        }
        else
            return FS_Response::error(500,'failed to create user');
    }

    public function CompleteResetPassword($user,$code)
    {
        $tmp = $user->password;
        $user = $this->user->findByCredential($user);
        $user->{'password'} = $tmp;
        unset($tmp);
        if(!$user)
        {
            return FS_Response::error(500,'Invalid user credentials');
        }
        if(($this->completed($user) != false)&& ($this->exists($user) == false))
        {
            return FS_Response::error(500,'invalid request url found from reset password or expire otp');
        }
        if($this->complete($user,$code))
        {
            return FS_Response::success('message','password successfully reset');
        }
        return FS_Response::error(500,'invalid otp found');
    }
    public function getOTP($user)
    {
        $user = $this->user->findByCredential($user);
        $resetpassword = null;
        if(($resetpassword = $this->exists($user)) != false)
        {
            return $resetpassword;
        }
        if($user = $this->create($user)) 
        {

            return FS_Response::success('message', 'please verify user');
        }
        else
        {
            return FS_Response::error(500,'failed to create user');
        }
    }
    public function getOTP1($user)
    {
        $user = $this->user->findByCredential($user);
        $resetpassword = null;
        if(($resetpassword = $this->exists($user)) != false)
        {
            return $resetpassword;
        }
        if($user = $this->create($user)) 
        {

            return $user;
        }
        else
        {
            return FS_Response::error(500,'failed to create user');
        }
    }
}
