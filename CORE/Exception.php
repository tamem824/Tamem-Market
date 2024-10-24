<?php

namespace CORE;



class Exception extends \Exception
{
    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function errorMessage()
    {
        return "Error: [{$this->code}]: {$this->message}";
    }
}
