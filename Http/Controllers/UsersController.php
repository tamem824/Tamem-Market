<?php

namespace Http\Controllers;

use CORE\App;
use CORE\BaseController;
use CORE\Database;
use CORE\Validator;

class UsersController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register(): void
    {
        $fullName = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!Validator::string($fullName, 2, 50)) {
            echo "Full name must be between 2 and 50 characters.";
            return;
        }

        if (!Validator::email($email)) {
            echo "Invalid email format.";
            return;
        }

        $userData = [
            'full_name' => $fullName,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];

        try {
            $this->DB->insert('users', $userData);
            echo "User registered successfully.";
        } catch (\Exception $e) {
            echo "Error registering user: " . $e->getMessage();
        }
    }

    public function updateProfile(): void
    {
        if (!$this->isUserLoggedIn()) {
            echo "You must be logged in to update your profile.";
            return;
        }

        $username = $_POST['username'];
        $email = $_POST['email'];

        if (!Validator::string($username, 2, 50)) {
            echo "Username must be between 2 and 50 characters.";
            return;
        }

        if (!Validator::email($email)) {
            echo "Invalid email format.";
            return;
        }

        $updatedData = [
            'username' => $username,
            'email' => $email,
        ];

        if (!empty($_POST['password'])) {
            $updatedData['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

        try {
            $this->DB->update('users', $updatedData, ['id' => $_SESSION['user_id']]);
            echo "Profile updated successfully.";
        } catch (\Exception $e) {
            echo "Error updating profile: " . $e->getMessage();
        }
    }
}
