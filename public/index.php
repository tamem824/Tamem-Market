<?php

use CORE\Router;
use CORE\Session;
use CORE\ValidationException;

const BASE_PATH = __DIR__.'/../';

session_start();

require BASE_PATH . 'vendor/autoload.php';
require BASE_PATH . 'CORE/functions.php';
require BASE_PATH . 'bootstrap.php';

$route = new Router();
require BASE_PATH . 'routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $route->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

//    return redirect($route->previousUrl());
}

Session::unflash();


