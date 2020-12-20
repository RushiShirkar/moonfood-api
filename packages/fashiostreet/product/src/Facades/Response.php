<?php
namespace fashiostreet\product\Facades;

use Illuminate\Support\Facades\Facade;

class Response extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'FS_Response';
    }
}
