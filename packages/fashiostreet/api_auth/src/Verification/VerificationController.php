<?php

namespace fashiostreet\api_auth\Verification;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use FS_Response;
use User;
use fashiostreet\api_auth\Verification\Verification;
use fashiostreet\api_auth\Verification\VerificationTraits;

class VerificationController extends Controller
{
    use VerificationTraits;

    public function CreateVerification($user)
    {
        $verification= null;
        if(($verification = $this->exists($user)) != false)
        {
            //send directly sms for activation because activation already exists
            return $verification;
        }
        return $this->create($user)?:false;

    }

    public function CompleteVerification($user,$code)
    {
        $user = User::findByCredential($user);
        if($user)
        {
            return FS_Response::error(500,'Invalid user credentials');
        }
        if(($this->completed($user) != false)&& ($this->exists($user) == false))
        {
            return FS_Response::error(500,'invalid request url found from verification or expire otp');
        }
        if($this->complete($user,$code))
        {
            return FS_Response::success('message','verification completed successfully');
        }
        return FS_Response::error(500,'invalid otp found');
    }


}
