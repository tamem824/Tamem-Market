<?php

namespace CORE;

class Container
{
    protected array $bindings=[];
    public function bind($key,$func)
    {
        $this->bindings[$key]=$func;
    }
    public function resolve($key)
    {
        if( ! array_key_exists($key,$this->bindings)) throw \Exception('SORRY NO MATCHING BINDING');


        if(array_key_exists($key,$this->bindings))
        {
            $resolver=$this->bindings[$key];
            return call_user_func($resolver);
        }
    }
}