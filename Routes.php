<?php

use CORE\Router;
use Http\Controllers\HomeController;
use Http\Controllers\LoginController;
use Http\Controllers\ProductsController;

$route->get('/', function() use ($db) {
    $home = new HomeController($db);
    $home->index();
});

$route->get('/home', function() use ($db) {
    $home = new HomeController($db);
    $home->index();
});

$route->post('/login', function() use ($db) {
    $login = new UsersController($db);
    $login->index();
});
$route->post('/register', function() use ($db) {
    $login = new UsersController($db);
    $login->register();
});

$route->get('/products', function() use ($db) {
    $products = new ProductsController($db);
    $products->index();
});

$route->get('/my-products', function() use ($db) {
    $products = new ProductsController($db);
    $products->show($id);
});
