<?php

namespace App\Controllers\Admin;

use App\Aspects\LoggingAspect;
use App\Aspects\AuthenticationAspect;
use App\Aspects\ErrorHandlingAspect;
use App\Services\Admin\AuthService;

class LoginController
{
    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function login($username, $password)
    {
        try {
            AuthenticationAspect::checkCredentials($username, $password);

            LoggingAspect::log("Processing login for user '$username'.");

            $result = $this->authService->login($username, $password);

            if ($result) {
                LoggingAspect::log("Redirecting user '$username' to Manage.php.");
                header("Location: Manage.php");
                exit();
            } else {
                echo "Đăng nhập thất bại!";
            }
        } catch (\Exception $e) {
            ErrorHandlingAspect::handleError($e);
        }
    }
}