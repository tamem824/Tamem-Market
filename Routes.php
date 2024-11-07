<?php

use CORE\App;
use CORE\Database;
use CORE\Router;
use Http\Controllers\AboutController;
use Http\Controllers\HomeController;
use Http\Controllers\MyproductsController;
use Http\Controllers\UsersController;
use Http\Controllers\ProductsController;

// Initialize database if not already done
$db = $db ?? App::Container(Database::class);

$route->get('/', function() use ($db) {
    $home = new ProductsController($db);
    $home->showAll();
});

// About Page
$route->get('/about', function() {
    $about = new AboutController();
    $about->index();
});

// Home Page
$route->get('/home', function() use ($db) {
    $home = new HomeController($db);
    $home->index();
});

// User Authentication Routes
$route->get('/login', function() use ($db) {
    $login = new UsersController($db);
    $login->ShowLogin();
})->only('guest');

$route->post('/login', function() use ($db) {
    $login = new UsersController($db);
    $login->login();
})->only('guest');

$route->get('/register', function() use ($db) {
    $register = new UsersController($db);
    $register->ViewRegister();
})->only('guest');

$route->post('/register', function() use ($db) {
    $register = new UsersController($db);
    $register->register();
})->only('guest');

$route->post('/log-out', function() use ($db) {
    $userController = new UsersController($db);
    $userController->logout();
})->only('auth');

// Product Display Routes
$route->get('/products/show', function() use ($db) {
    $products = new ProductsController($db);
    $products->showAll();
});

$route->get('/my-products', function() use ($db) {
    if (isset($_SESSION['user_id'])) {
        $products = new MyproductsController($db);
        $products->index($_SESSION['user_id']);
    } else {
        header("Location: /login");
        exit;
    }
})->only('auth');

// Product Update Routes
$route->get('/products/update', function() use ($db) {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $id = (int)$_GET['id'];
        $products = new MyproductsController($db);
        $products->UpdateView($id);
    } else {
        header("Location: /products/show");
        exit;
    }
})->only('auth');

$route->post('/products/update', function() use ($db) {
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = (int)$_POST['id'];
        $products = new MyproductsController($db);
        $products->edit($id);
    } else {
        header("Location: /products/show");
        exit;
    }
})->only('auth');

// Product Creation Routes
$route->get('/products/create', function() use ($db) {
    $products = new MyproductsController($db);
    $products->createView();
})->only('auth');

$route->post('/products/create', function() use ($db) {
    $products = new MyproductsController($db);
    $products->add();
})->only('auth');
