<?php

namespace Http\Controllers;

use CORE\App;
use CORE\BaseController;
use CORE\Database;

class UsersController extends BaseController
{



    public function __construct()
    {
        parent::__construct();
//        session_start();
    }
    public function ViewRegister()
    {
        $this->view('session/register.view.php');
    }
    public function ShowLogin()
    {
        $this->view('session/login.view.php');
    }

    public function register(): void
    {
        $userData = [
            'full_name' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ];

        try {
            // Insert into database logic here
            $this->DB->insert('users', $userData);
            echo "User registered successfully.";
        } catch (\Exception $e) {
            echo "Error registering user: " . $e->getMessage();
        }
        $this->view('session/register.view.php'); // Consistent view path
    }

    public function login(): void
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            $user = $this->DB->query("SELECT * FROM users WHERE email = ?", [$email])->fetch();
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];

                $this->redirect('/home');
            } else {
                echo "Invalid email or password.";
            }
        } catch (\Exception $e) {
            echo "Error during login: " . $e->getMessage();
        }
    }

    public function logout(): void
    {
        session_destroy();
        echo "Logout successful.";
    }

    public function showProfile(): void
    {
        if (!$this->isUserLoggedIn()) {
            echo "You must be logged in to view your profile.";
            return;
        }

        try {
            $user = $this->DB->query("SELECT * FROM users WHERE id = ?", [$_SESSION['user_id']])->fetch();
            $this->view('users/profile', ['user' => $user]);
        } catch (\Exception $e) {
            echo "Error fetching user profile: " . $e->getMessage();
        }
    }

    public function updateProfile(): void
    {
        if (!$this->isUserLoggedIn()) {
            echo "You must be logged in to update your profile.";
            return;
        }

        $updatedData = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
        ];

        if (!empty($_POST['password'])) {
            $updatedData['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

        try {
            $this->DB->update('users', $updatedData, ['id' => $_SESSION['user_id']]); // Assuming `update` exists in `Database` class
            echo "Profile updated successfully.";
        } catch (\Exception $e) {
            echo "Error updating profile: " . $e->getMessage();
        }
    }

 function isUserLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }
}
