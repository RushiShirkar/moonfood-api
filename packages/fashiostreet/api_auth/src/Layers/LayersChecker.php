<?php
namespace fashiostreet\api_auth\Layers;
use fashiostreet\api_auth\Activation\ActivationController;
use fashiostreet\api_auth\Exceptions\Api_authException;

class LayersChecker {
    protected $activation;
    function __construct()
    {
        $this->activation = new ActivationController();
    }

    public function Logincheck($user){
        if(!$this->activation->completed($user))
        {
            throw new Api_authException('please activate your account before login');
        }
        return true;
    }
}
