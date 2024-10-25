<?php

namespace Http\Controllers;

use COREApp;
use COREBaseController;
use COREDatabase;

class UsersController extends BaseController
{
    private $db;

    public function __construct()
    {
        $this->db = App::Container()->resolve(Database::class);
    }

    public function register(): void
    {
        $userData = [
            'full-name' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ];

        try {
            $this->db->insert('users', $userData);
            echo "User registered successfully.";
        } catch (Exception $e) {
            echo "Error registering user: " . $e->getMessage();
        }
    }

    public function login(): void
    {

        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            $user = $this->db->query("SELECT * FROM users WHERE email = ?", [$email]);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                echo "Login successful.";
            } else {
                echo "Invalid email or password.";
            }
        } catch (Exception $e) {
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
            $user = $this->db->query("SELECT * FROM users WHERE id = ?", [$_SESSION['user_id']]);
            $this->view('users/profile', ['user' => $user]);
        } catch (Exception $e) {
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
            $this->db->update('users', $updatedData, ['id' => $_SESSION['user_id']]);
            echo "Profile updated successfully.";
        } catch (Exception $e) {
            echo "Error updating profile: " . $e->getMessage();
        }
    }


}
