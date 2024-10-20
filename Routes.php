<?php

use CORE\Router;
use HttpControllers\ProductsController;

$route->route($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
$route->get('/home',  'HomeController');
$route->post('/login', 'LoginController');
$route->get('/','HomeController');
$route->get('/products','ProductsController');
$route->get('/product','ProductsController');

