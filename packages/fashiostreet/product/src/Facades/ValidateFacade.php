<?php
namespace fashiostreet\product\Facades;

use Illuminate\Support\Facades\Facade;

class ValidateFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Validate';
    }
}
