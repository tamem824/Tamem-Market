<?php

namespace Http\Controllers;

use CORE\BaseController;

class MyproductsController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }
    public function index($id): void
    {

        if ($id) {
            $statement = $this->DB->query("SELECT * FROM products WHERE id = ?", [$id]);
            $products = $statement->fetch();

            if ($products) {
                $this->view('products/UserProducts.view.php', ['products' => $products]);
                return;
            }
        }}



            function add(): void
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

            public
            function edit($id): void
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

            public
            function delete($id): void
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


            private
            function isProductOwner($productId): bool
            {

                $result = $this->DB->query("SELECT user_id FROM products WHERE id = ?", [$productId]);
                return isset($result) && $result['user_id'] === $_SESSION['user_id'];
            }

    public function UpdateView($id): void

    {
        $this->DB->query("SELECT * FROM products WHERE id= ?");
        $product=$this->DB->fetch();
        $this->view('products\ProductsSetting.view.php');
    }


}
