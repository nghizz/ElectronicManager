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

            $isLoggedIn = $this->authService->login($username, $password);

            if ($isLoggedIn) {
                header("Location: Manage.php");
                exit();
            } else {
                echo "Đăng nhập thất bại!";
                header("Location: ../Login.php");
            }
        }
    }
}

?>
