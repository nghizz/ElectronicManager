<?php
// Controllers/Admin/LoginController.php

namespace App\Controllers\Admin;

use App\Services\Admin\AuthService;

class LoginController
{
    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }
    
    public function handleLogin()
    {
        session_start();
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($this->authService->login($username, $password)) {
                $userData = [
                    'user_id' => $_SESSION['user_id'],
                    'username' => $username
                ];
                header("Location: Manage.php");
                exit();
            } else {
                echo "Đăng nhập thất bại!";
            }
        }
    }
}
