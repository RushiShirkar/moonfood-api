<?php
namespace fashiostreet\api_auth\Verification;

use Illuminate\Http\Request;
use fashiostreet\api_auth\Verification\Verification;
use Carbon\Carbon;

trait VerificationTraits
{
    public function create($user)
    {
        $verification =  new Verification();
        $verification->users_id = $user->id;
        $verification->code = $this->generateActivationCode();
        $verification->save();
        return $verification;
    }

    public function exists($user)
    {
        $verification = Verification::where('users_id',$user->id)
            ->where('completed',0)
            ->where('created_at','>=',$this->expires())
            ->first();
        return $verification?:false;

    }

    public function complete($user,$code)
    {
        $verification = Verification::where('users_id',$user->id)
            ->where('code',$code)
            ->update([
                'completed' => 1,
                'completed_at' => Carbon::now(),
            ]);
        return $verification?:false;
    }

    public function completed($user)
    {
        $verification = Verification::where('users_id',$user->id)
            ->where('completed_at',1)
            ->first();
        return $verification?:false;
    }

    public function removeExpired()
    {
        $verification = Verification::where('completed',0)
            ->where('created_at','<',$this->expires())
            ->get();
        return $verification?:false;
    }

    public function generateActivationCode()
    {
        return str_random(4);
    }

    public function expires()
    {
        return Carbon::now()->subDay(2);
    }
}
