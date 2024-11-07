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
            $_SESSION['message'] = "Full name must be between 2 and 50 characters.";
            $this->redirect('/register');
            return;
        }

        if (!Validator::email($email)) {
            $_SESSION['message'] = "Invalid email format.";
            $this->redirect('/register');
            return;
        }

        $userData = [
            'full_name' => $fullName,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];

        try {
            $this->DB->insert('users', $userData);
            $_SESSION['message'] = "User registered successfully.";
            $_SESSION['name'] = $fullName;
            $_SESSION['user_id'] = $userData['id'];

            $this->redirect('/');
        } catch (ValidationException $e) {
            $_SESSION['message'] = "Error registering user: " . $e->getMessage();
            $this->redirect('/register');
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
                $_SESSION['message'] = "Logged in successfully.";
                $this->redirect('/');
            } else {
                $_SESSION['message'] = "Invalid email or password.";
                $this->redirect('/login');
            }
        } catch (ValidationException $e) {
            $_SESSION['message'] = "Error during login: " . $e->getMessage();
            $this->redirect('/login');
        }
    }

    public function logout(): void
    {
        // التحقق من حالة الجلسة وبدء جلسة إذا لم تكن مهيئة
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['message'] = 'LOGOUT SUCCESSFUL';

        session_unset();

        session_destroy();

        $this->redirect('/');
    }


    public function showProfile(): void
    {
        if (!$this->isUserLoggedIn()) {
            $_SESSION['message'] = "You must be logged in to view your profile.";
            $this->redirect('/login');
            return;
        }

        try {
            $user = $this->DB->query("SELECT * FROM users WHERE id = ?", [$_SESSION['user_id']])->fetch();
            $this->view('session/profile.view.php', ['user' => $user]);
        } catch (ValidationException $e) {
            $_SESSION['message'] = "Error fetching user profile: " . $e->getMessage();
            $this->redirect('/');
        }
    }

    public function isUserLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }
}
