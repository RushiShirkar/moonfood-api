<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 6/25/2018
 * Time: 10:56 PM
 */

namespace fashiostreet\api_auth;

use App\Http\Controllers\Controller;
use fashiostreet\api_auth\Exceptions\ErrorException;
use fashiostreet\api_auth\Exceptions\SystemException;
use Illuminate\Contracts\Encryption\DecryptException;
use FS_Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function findByCredential($user)
    {
        $id = (array) DB::select('select id,mobile from customer where mobile = ? limit 1',[$user->mobile]);
        if(count($id) <= 0)
        {
            throw new ErrorException('invalid user found');
        }
        return is_array($id)?$id[0]:null;
    }

    public function findById($id)
    {
        $user = (array) DB::select('select id from customer where id = ? limit 1',[$id]);
        if(count($user) <= 0)
        {
            throw new SystemException('invalid token found,please try to login again');
        }
        return true;
    }

    protected function decryption($data)
    {
        try
        {
            return decrypt($data);
        }
        catch (DecryptException $e)
        {
            throw new SystemException('invalid token found,please try to login again');
        }
    }

    public function getUser($request)
    {
        return array(
                    'users_id' => $this->decryption($request->header('token')),
                    'shop_id' => $this->decryption($request->header('local-id'))
                );
    }

    public function checkUser(Request $request)
    {
        $token = $this->decryption($request->header('token'));
        $refresh_token = $this->decryption($request->header('refresh-token'));
        if($token != $refresh_token)
        {
            throw new SystemException('Invalid token found');
        }
        $this->findById($token);
        return true;
    }
}
