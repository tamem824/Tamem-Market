<?php

namespace CORE;

use Exception;

class ValidationException extends Exception
{
    public array $errors = []; // Initialize as empty array
    public array $old = [];    // Initialize as empty array

    /**
     * @throws ValidationException
     */
    public static function throw($errors, $old)
    {
        $instance = new static('The form failed to validate.');

        $instance->errors = $errors;
        $instance->old = $old;

        throw $instance;
    }
}
