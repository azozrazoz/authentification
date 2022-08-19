<?php

namespace App\Exceptions;

use Exception;

class TokenException extends Exception
{
    public function __construct()
    {
        parent::__construct();
    }

    public function render($request)
    {       
        return response()->json(["error" => true, "token" => $this->getMessage()]);       
    }
}
