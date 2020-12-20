<?php
namespace fashiostreet\api_auth\Facades;

use Illuminate\Support\Facades\Facade;

class api_auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'api_auth';
    }
}
