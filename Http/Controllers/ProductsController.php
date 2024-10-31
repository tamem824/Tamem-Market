<?php

namespace Http\Controllers;

use CORE\BaseController;

class ProductsController extends BaseController
{


    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $this->view('products/showall.view.php');
    }

    public function showAll(): void
    {
        try {
            $products = $this->DB->query("SELECT * FROM products");
            $this->view('products/showall.view.php', ['products' => $products]);
        } catch (Exception $e) {
            echo "Error fetching products: " . $e->getMessage();
        }
    }

    public function show($id = null)
    {
        if ($id) {
            $statement = $this->DB->query("SELECT * FROM products WHERE id = ?", [$id]);
            $product = $statement->fetch();

            if ($product) {
                $this->view('products/show.view.php', ['product' => $product]);
                return;
            }
        }
        echo "Product not found.";
    }
}