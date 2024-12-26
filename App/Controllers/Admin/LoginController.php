<?php

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
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            error_log("LoginController->handleLogin called with username: $username");

            $isLoggedIn = $this->authService->login($username, $password);

            if ($isLoggedIn) {
                header("Location: Manage.php");
                exit();
            } else {
                // Chuyển hướng về trang đăng nhập và thêm thông báo lỗi
                header("Location: ../Login.php?error=Lỗi không thể đăng nhập!");
                exit();
            }
        }
    }
}