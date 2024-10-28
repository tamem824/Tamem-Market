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

    public function add(): void
    {

        if (!$this->isUserLoggedIn()) {
            echo "You must be logged in to add a product.";
            return;
        }



        $productData = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'user_id' => $_SESSION['user_id'],
        ];

        try {
            $this->DB->insert('products', $productData);
            echo "Product added successfully.";
        } catch (Exception $e) {
            echo "Error adding product: " . $e->getMessage();
        }
    }

    public function edit($id): void
    {

        if (!$this->isProductOwner($id)) {
            echo "You are not authorized to edit this product.";
            return;
        }


        $updatedData = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
        ];

        try {
            $this->DB->update('products', $updatedData, ['id' => $id]);
            echo "Product updated successfully.";
        } catch (Exception $e) {
            echo "Error updating product: " . $e->getMessage();
        }
    }

    public function delete($id): void
    {

        if (!$this->isProductOwner($id)) {
            echo "You are not authorized to delete this product.";
            return;
        }

        try {
            $this->DB->delete('products', ['id' => $id]);
            echo "Product deleted successfully.";
        } catch (Exception $e) {
            echo "Error deleting product: " . $e->getMessage();
        }
    }


    private function isProductOwner($productId): bool
    {

        $result = $this->DB->query("SELECT user_id FROM products WHERE id = ?", [$productId]);
        return isset($result) && $result['user_id'] === $_SESSION['user_id'];
    }
}
