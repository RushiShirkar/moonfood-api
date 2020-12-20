<?php
namespace fashiostreet\product\Exceptions;

use Exception;
use Illuminate\Support\Facades\DB;
use FS_Response;

class ErrorException extends Exception
{
    //Tabs Exception
    public function render($request)
    {
        DB::rollBack();
        return FS_Response::error(500,$this->getMessage());
    }
}
