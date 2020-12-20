<?php
namespace fashiostreet\api_auth\Exceptions;

use Exception;
use FS_Response;
use Illuminate\Support\Facades\DB;

class ErrorException extends Exception
{
    //Tabs Exception
    public function render($request)
    {
        DB::rollBack();
        return FS_Response::error(500,$this->getMessage());
    }
}
