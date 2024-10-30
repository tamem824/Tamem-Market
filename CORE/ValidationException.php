<?php

namespace CORE;

class ValidationException extends \Exception
{
    public  array $errors;
    public  array $old;

    public static function throw($errors, $old)
    {
        $instance = new static('The form failed to validate.');

        $instance->errors = $errors;
        $instance->old = $old;

        throw $instance;
    }
}