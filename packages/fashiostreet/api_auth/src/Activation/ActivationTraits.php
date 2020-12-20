<?php
namespace fashiostreet\api_auth\Activation;

use fashiostreet\api_auth\Exceptions\SystemException;
use Illuminate\Database\QueryException;
use fashiostreet\api_auth\Activation\Activation as Activation;
use Carbon\Carbon;

trait ActivationTraits
{
    public function create($user)
    {
        return $this->withError(function () use ($user){
            $activation =  new Activation();
            $activation->users_id = $user->id;
            $activation->code = $this->generateActivationCode();
            $activation->save();
            return $activation;
        });
    }

    public function exists($user)
    {
        return $this->withError(function () use ($user){
            $activation = Activation::where('users_id',$user->id)
                ->where('completed',0)
                ->where('created_at','>=',$this->expires())
                ->first();
            return $activation?:false;
        });


    }

    public function complete($user,$code)
    {
        return $this->withError(function () use($user,$code){
            $activation = Activation::where('users_id',$user->id)
                ->where('code',$code)
                ->update([
                    'completed' => 1,
                    'completed_at' => Carbon::now(),
                ]);
                return $activation?:false;
        });

    }

    public function completed($user)
    {
        return $this->withError(function () use ($user){
            $activation = Activation::where('users_id',$user->id)
                ->where('completed',1)
                ->first();
            return $activation?:false;
        });

    }

    public function removeExpired()
    {
        return $this->withError(function (){
            $activation = Activation::where('completed',0)
                ->where('created_at','<',$this->expires())
                ->get();
            return $activation?:false;
        });

    }

    public function generateActivationCode()
    {
        return mt_rand(1000, 9999);
    }

    public function expires()
    {
        return Carbon::now()->subDay(2);
    }

    protected function withError($callback)
    {
        try
        {
            return $callback();
        }
        catch (QueryException $e)
        {
            throw new SystemException('Activation, server error found please try again or contact our customer service');
        }
    }
}
