<?php

namespace App\Services\Admin;

use App\Aspects\LoggingAspect;
use App\Models\Admin\User;

class AuthService
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login($username, $password)
    {


        $user = $this->userModel->getUserByCredentials($username, $password);

        if ($user) {
            LoggingAspect::log("User '$username' logged in successfully.");
            return true;
        } else {
            LoggingAspect::log("Failed login attempt for user '$username'.");
            return false;
        }
    }
}
