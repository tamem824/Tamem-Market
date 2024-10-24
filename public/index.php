<?php

use CORE\Database;
use CORE\Router;
use CORE\BaseController;

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'vendor/autoload.php';

require BASE_PATH . 'CORE/Functions.php';

$route = new Router();


require BASE_PATH . 'Routes.php';

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$route->route($requestUri, $requestMethod);

$config = require BASE_PATH . 'config.php';


$db = new Database($config['database'],$username='root',$password='12345');
