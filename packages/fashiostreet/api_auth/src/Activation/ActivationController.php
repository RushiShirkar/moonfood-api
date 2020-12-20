<?php

namespace fashiostreet\api_auth\Activation;

use fashiostreet\api_auth\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use FS_Response;
use fashiostreet\api_auth\Activation\Activation;
use fashiostreet\api_auth\Activation\ActivationTraits;

class ActivationController extends Controller
{
    use ActivationTraits;

    protected $user;

    function __construct()
    {
        $this->user = new UserController();
    }

    public function CreateActivation($user)
    {
        $activation= null;
        if(($activation = $this->exists($user)) != false)
        {
            //send directly sms for activation because activation already exists
            return $activation;
        }
        return $this->create($user)?:false;
    }

    public function CompleteActivation($user,$code)
    {
        $user = $this->user->findByCredential($user);
        if(!$user)
        {
            return FS_Response::error(500,'Invalid user credentials');
        }
        if(($this->completed($user) != false)&& ($this->exists($user) == false))
        {
            return FS_Response::error(500,'invalid request url found from activation or expire otp');
        }
        if($this->complete($user,$code))
        {
            return FS_Response::success('message','activation completed successfully');
        }
        return FS_Response::error(500,'invalid otp found');
    }

    public function getOTP($user)
    {
        
        $user = $this->user->findByCredential($user);
        $resetpassword = null;
        
        if(!$user)
        {
            return false;
        }
        

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
}
