<?php

use CORE\Router;
use Http\Controller\HomeController;
use Http\Controller\LoginController;
use Http\Controller\ProductsController;


$route->get('/home', 'HomeController@index');
$route->post('/login', 'LoginController@index');
$route->get('/', 'HomeController@index');
$route->get('/products', 'ProductsController@index');
$route->get('/product', 'ProductsController@index');
