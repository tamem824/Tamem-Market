<?php

namespace CORE;

class App
{
    protected static $Container;
    public static function SetContainer($Container): void
    {
        static::$Container= $Container;
    }
    public static function Container($Container)
    {
        return static::$Container;
    }

}