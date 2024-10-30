<?php

namespace Http\Controllers;

use CORE\App;
use CORE\BaseController;
use CORE\Database;
use CORE\ValidationException;
use CORE\Validator;

class UsersController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
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
            $_SESSION['message'] = "User update successfully.";
            $this->redirect('/');
        } catch (ValidationException $e) {
            echo "Error registering user: " . $e->getMessage();
        }
    }

    public function login(): void
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            $user = $this->DB->query("SELECT * FROM users WHERE email = ?", [$email])->fetch();
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $this->redirect('/');
            } else {
                echo "Invalid email or password.";
            }
        } catch (ValidationException $e) {
            echo "Error during login: " . $e->getMessage();
        }
    }

    public function logout(): void
    {
        session_destroy();
        $_SESSION['message']='log-out successfully';
        $this->redirect('/');
    }

    public function showProfile(): void
    {
        if (!$this->isUserLoggedIn()) {
            echo "You must be logged in to view your profile.";
            return;
        }

        try {
            $user = $this->DB->query("SELECT * FROM users WHERE id = ?", [$_SESSION['user_id']])->fetch();
            $this->view('session/profile.view.php', ['user' => $user]);
        } catch (ValidationException $e) {
            echo "Error fetching user profile: " . $e->getMessage();
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
            'full-name' => $username,
            'email' => $email,
        ];

        if (!empty($_POST['password'])) {
            $updatedData['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

        try {
            $this->DB->update('users', $updatedData, ['id' => $_SESSION['user_id']]);
            $_SESSION['message'] = "User update successfully.";
            $this->redirect('/');


            $_SESSION['user']=[
                'email'=>$email,
                'full-name'=>$username,
            ];
        } catch (ValidationException $e) {
            echo "Error updating profile: " . $e->getMessage();
        }
    }

    public function isUserLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }
}
