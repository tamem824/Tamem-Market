<?php

use CORE\Router;
use HttpControllers\ProductsController;


$route->get('/home',  'HomeController');
$route->post('/login', 'LoginController');
$route->get('/','HomeController');
$route->get('/products','ProductsController');
$route->get('/product','ProductsController');

