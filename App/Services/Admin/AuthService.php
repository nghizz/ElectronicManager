<?php

namespace App\Services\Admin;

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
            $_SESSION['user_id'] = $user['username'];
            return true;
        }
        return false;
    }
}
