<?php
namespace fashiostreet\api_auth\Controllers;
use fashiostreet\api_auth\Exceptions\ErrorException;
use fashiostreet\api_auth\Exceptions\SystemException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController {
    public function changeUserPassword(Request $request)
    {

    }
    protected function changepassword($user)
    {
        $newpassword = Hash::make($user->password);
        $user = DB::table('users')
            ->where('id',$user->id)
            ->update([
                'password' => $newpassword
            ]);
        if($user <= 0 || $user == null || $user == false)
        {
            throw new SystemException('failed to change user password,please try again after something or contact our customer service');
        }
        return true;
    }
}
