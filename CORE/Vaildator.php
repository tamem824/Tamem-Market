<?php

namespace CORE;

class Validator
{
    public static function string($value, $min = 1, $max = INF): bool
    {
        if (!is_string($value)) {
            return false;
        }

        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email($value): bool
    {
        return is_string($value) && (bool) filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}
