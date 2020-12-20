<?php
namespace fashiostreet\api_auth\Activation;

use Carbon\Carbon;
use fashiostreet\api_auth\Exceptions\SystemException;
use Illuminate\Http\Request;
use fashiostreet\api_auth\ResetPassword\ResetPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait ResetPasswordTraits
{
    public function create($user)
    {
        $reset_password =  new ResetPassword();
        $reset_password->users_id = $user->id;
        $reset_password->code = $this->generateResetPasswordCode();
        $reset_password->save();
        return $reset_password;
    }

    public function exists($user,$json = 'no')
    {
        $reset_password = ResetPassword::where('users_id',$user->id)
            ->where('completed',0)
            ->where('created_at','>=',$this->expires())
            ->first();
     //   if($json != 'no')
     //   {
            return $reset_password?:false;
      //  }
       // return $reset_password?'otp already send to your mobile':false;

    }

    public function complete($user,$code)
    {
        DB::beginTransaction();
        $reset_password = ResetPassword::where('users_id',$user->id)
            ->where('code',$code)
            ->update([
                'completed' => 1,
                'completed_at' => Carbon::now(),
            ]);
        $this->ChangePassword($user);
        DB::commit();
        return $reset_password?:false;
    }

    protected function ChangePassword($user)
    {
        $newpassword = Hash::make($user->password);
        $user = DB::table('customer')
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

    public function completed($user)
    {
        $reset_password = ResetPassword::where('users_id',$user->id)
            ->where('completed',1)
            ->first();
        return $reset_password?:false;
    }

    public function removeExpired()
    {
        $reset_password = ResetPassword::where('completed',0)
            ->where('created_at','<',$this->expires())
            ->get();
        return $reset_password?:false;
    }

    public function generateResetPasswordCode()
    {
        return mt_rand(1000, 9999);
    }

    public function expires()
    {
        return Carbon::now()->subDay(2);
    }
}
