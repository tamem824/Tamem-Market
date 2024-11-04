<?php

use CORE\App;
use CORE\Database;
use CORE\Router;
use Http\Controllers\AboutController;
use Http\Controllers\HomeController;
use Http\Controllers\MyproductsController;
use Http\Controllers\UsersController;
use Http\Controllers\ProductsController;
//$db=App::Container(Database::class);

$route->get('/', function() use ($db) {
    $home = new ProductsController($db);
    $home->showAll();
});

$route->get('/about', function() {
    $home = new AboutController();
    $home->index();
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

$route->get('/register', function() use ($db) {
    $register = new UsersController($db);
    $register->ViewRegister();
})->only('guest');


$route->get('/products/show', function() use ($db) {

    $products = new ProductsController($db);

    $products->showAll();});




$route->post('/log-out', function() use ($db) {
    $userController = new UsersController($db);
    $userController->logout();
})->only('auth');


$route->get('/my-products', function() use ($db) {
    $id=$_SESSION['user-id'];
    $products = new MyproductsController($db);
    $products->index($id);
})->only('auth');

$route->get('/products/update', function() use ($db) {
    $id = $_GET['id'];
    $products = new MyproductsController($db);
    $products->UpdateView($id);
})->only('auth');

$route->post('/products/update', function() use ($db) {
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
        $id = (int) $_POST['id']; // Cast to integer for safety
        $products = new MyproductsController($db);
        $products->edit($id);
    } else {
        header("Location: /products/show");
        exit;
    }
})->only('auth');
$route->get('/products/create', function() use ($db) {

    $products = new MyproductsController($db);
    $products->createView();
})->only('auth');
$route->post('/products/create', function() use ($db) {

    $products = new MyproductsController($db);
    $products->add();
})->only('auth');