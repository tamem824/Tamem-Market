<?php

use CORE\Database;
use CORE\Router;
use CORE\BaseController;


const BASE_PATH = __DIR__.'/../';
require BASE_PATH . 'CORE/Functions.php';
require BASE_PATH . 'CORE/Router.php';
$route = new Router();
require BASE_PATH . 'Routes.php';


$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
$route->route($requestUri, $requestMethod);
 $config =require ('config.php');
 $db=new Database($config['database']);