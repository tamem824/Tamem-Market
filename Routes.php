<?php

use CORE\App;
use CORE\Database;
use CORE\Router;
use Http\Controllers\HomeController;
use Http\Controllers\UsersController;
use Http\Controllers\ProductsController;
//$db=App::Container(Database::class);

$route->get('/', function() use ($db) {
    $home = new ProductsController($db);
    $home->showAll();
});

$route->get('/home', function() use ($db) {
    $home = new HomeController($db);
    $home->index();
});

$route->post('/login', function() use ($db) {
    $login = new UsersController($db);
    $login->login();
})->only('guest');
$route->get('/login', function() use ($db) {
    $login = new UsersController($db);
    $login->ShowLogin();
})->only('guest');

$route->post('/register', function() use ($db) {
    $register = new UsersController($db);
    $register->register();
})->only('guest');
;$route->get('/register', function() use ($db) {
    $register = new UsersController($db);
    $register->ViewRegister();
})->only('guest');

$route->get('/products/show', function() use ($db) {
    $productId = $_GET['id'] ?? null;
    $products = new ProductsController($db);

    $products->show($productId);
});


$route->get('/my-products', function() use ($db) {
    session_start();
    $userId = $_SESSION['user_id'] ?? null;

    if ($userId) {
        $products = new ProductsController($db);
        $products->showAll($userId);
    } else {
        echo "You must be logged in to view your products.";
    }
});
