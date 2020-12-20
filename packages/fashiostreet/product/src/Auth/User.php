<?php
namespace fashiostreet\product\Auth;

use fashiostreet\product\Exceptions\AuthException;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use FS_Response;
use fashiostreet\product\Auth\customer as customer;
class User
{
    protected $request;
    protected $local_id;

    protected function decryptId($local_id)
    {
        try
        {
            return decrypt($local_id);
        }
        catch (DecryptException $e)
        {
            //throw new AuthException('Invalid token found');
        }
    }

    public function User(Request $request,$local_id = false)
    {
        if($local_id == false)
        {
            $local_id = $this->decryptId($request->header('local-id'));
        }

        return customer::select(['name','mobile','image','gender'])
                            ->where('id',$local_id)
                            ->take(1)
                            ->get();
    }

    public function findByCredential($credential)
    {
        $user = customer::where('mobile',$credential->mobile)
                ->take(1)
                ->get();
        if(count($user) > 0)
        {
            return $user;
        }
        return null;
    }

    public function getUserId(Request $request)
    {
        return $this->decryptId($request->header('local-id'));
    }

    public function checkUser(Request $request)
    {
        if($request->headers->has('token') && $request->headers->has('local-id')){
            $token = $this->decryptId($request->header('token'));
            $local_id = $this->decryptId($request->header('local-id'));
            if($token == $local_id)
            {
                $user = (array)$this->User($request,$local_id);
                if(is_array($user) && count($user) > 0)
                {
                    return true;
                }
            }
        }
        throw new AuthException('please login to enjoy your service');

    }
}
