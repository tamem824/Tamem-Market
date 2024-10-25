<?php

namespace Http\Controllers;

use CORE\BaseController;
use CORE\Database;

class HomeController extends BaseController
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function index(): void
    {

        $products = $this->db->query("SELECT * FROM products")->fetchAll();


        $this->view('index.view.php', ['products' => $products]);
    }
}



