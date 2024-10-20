<?php

function Dd($key)
{
    echo '<pre>';
    var_dump($key);
    echo '</pre>';
    die();
}

function CheckUrl($Uri): bool
{
    return $_SERVER['REQUEST_METHOD'] === $Uri;
}

function abort($Code = 404)
{
    http_response_code($Code);
    require BASEPATH('views/' . $Code . '.php');
    die();
}

function BASEPATH($path)
{
    return BASE_PATH . $path;
}





