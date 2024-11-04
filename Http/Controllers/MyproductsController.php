<?php

namespace Http\Controllers;

use CORE\BaseController;
use PDO;

class MyproductsController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }
    public function index($id): void
    {

        if ($id) {
            $statement = $this->DB->query("SELECT * FROM products WHERE user_id = ?", [$id]);
            $products = $statement->fetchAll();

            $this->view('products/UserProducts.view.php',
                ['products' => $products]);
            return;
        }
    }



            function add(): void
            {




                $productData = [
                    'full_name' => $_POST['name'],
                    'description' => $_POST['description'],
                    'price' => $_POST['price'],
                    'user_id' => $_SESSION['user-id'],
                ];

                try {
                    $this->DB->insert('products', $productData);
                    echo "Product added successfully.";
                    $this->redirect('/my-products');
                } catch (Exception $e) {
                    echo "Error adding product: " . $e->getMessage();
                }
            }

    public function edit($id): void
    {
        // Authorization Check
        if (!$this->isProductOwner($id)) {
            echo "You are not authorized to edit this product.";
            return;
        }

        // Input Validation and Sanitization
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);



        // Validate Inputs
    if (empty($name) || empty($description) || $price === false || $price <= 0) {
        echo "Invalid input data. Please ensure all fields are filled out correctly and the price is a positive number.";
        return;
    }

    $userId = $_SESSION['user-id'];

    // Prepare Update Data
    $updateData = [
        'full-name' => $name,
        'description' => $description,
        'price' => $price,
        'user_id' => $userId
    ];

    // Database Update with Error Handling
    try {
        $this->DB->update('products', $updateData, ['id' => $id]);
        echo "Product updated successfully.";

        // Redirect to product details page
        $this->redirect('/product/show?id=' . $id);
    } catch (Exception $e) {
        echo "Error updating product: " . $e->getMessage();
        // Log the error for debugging
        error_log("Error updating product: " . $e->getMessage());
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


    private function isProductOwner($productId): bool {

        $result = $this->DB->query("SELECT user_id FROM products WHERE id = ?", [$productId])->fetch(PDO::FETCH_ASSOC);
        return $result && $result['user_id'] === $_SESSION['user-id'];
    }

    public function UpdateView($id): void {
        $statement = $this->DB->query("SELECT * FROM products WHERE id = ?", [$id]);
        $product = $statement->fetch();

        if (!$product) {
            echo "Product not found.";
            return;
        }

        $this->view('products/ProductsSetting.view.php', [
            'product' => $product
        ]);
    }

    public function createView()
    {
        $this->view('products/AddProducts.view.php');
    }


}
