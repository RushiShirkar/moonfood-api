<?php
namespace fashiostreet\api_auth\Exceptions;

use Exception;
use FS_Response;

class Api_authException extends Exception
{
    //Tabs Exception
    public function render($request)
    {
        return FS_Response::error(500,$this->getMessage());
    }
}
