<?php

namespace Http\Controllers;


use CORE\BaseController;
use CORE\Database;


class ProductsController extends BaseController
{
    private $db;

    public function __construct()
    {
        $this->db = App::Container()->resolve(Database::class);
    }

    public function index(): void
    {
        $this->view('Controller/products/show');
    }

    public function showAll(): void
    {
        try {
            $products = $this->db->query("SELECT * FROM products");
            $this->view('products/showAll', ['products' => $products]);
        } catch (Exception $e) {
            echo "Error fetching products: " . $e->getMessage();
        }
    }

    public function show($id): void
    {
        try {
            $product = $this->db->query("SELECT * FROM products WHERE id = ?", [$id]);
            if ($product) {
                $this->view('products/show', ['product' => $product]);
            } else {
                echo "Product not found.";
            }
        } catch (Exception $e) {
            echo "Error fetching product: " . $e->getMessage();
        }
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
            $this->db->insert('products', $productData);
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
            $this->db->update('products', $updatedData, ['id' => $id]);
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
            $this->db->delete('products', ['id' => $id]);
            echo "Product deleted successfully.";
        } catch (Exception $e) {
            echo "Error deleting product: " . $e->getMessage();
        }
    }


    private function isProductOwner($productId): bool
    {

        $result = $this->db->query("SELECT user_id FROM products WHERE id = ?", [$productId]);
        return isset($result) && $result['user_id'] === $_SESSION['user_id'];
    }
}
