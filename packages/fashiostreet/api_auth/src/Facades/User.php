<?php
namespace fashiostreet\api_auth\Facades;

use Illuminate\Support\Facades\Facade;

class User extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'User';
    }
}
