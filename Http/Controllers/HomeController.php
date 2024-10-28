<?php

namespace Http\Controllers;

use CORE\BaseController;

class HomeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {

        $products = $this->DB->query("SELECT * FROM products")->fetchAll();

        $this->view('index.view.php', ['products' => $products]);
    }
}
