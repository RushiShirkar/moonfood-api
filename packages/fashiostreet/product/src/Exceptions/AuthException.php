<?php
namespace fashiostreet\product\Exceptions;

use Exception;
use FS_Response;
use Illuminate\Support\Facades\DB;

class AuthException extends Exception
{
    //Tabs Exception
    public function render($request)
    {
        DB::rollBack();
        return FS_Response::error(401,$this->getMessage());
    }
}
