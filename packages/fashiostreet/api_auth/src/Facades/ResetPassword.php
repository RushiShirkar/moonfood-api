<?php
namespace fashiostreet\api_auth\Facades;

use Illuminate\Support\Facades\Facade;

class ResetPassword extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ResetPassword';
    }
}
