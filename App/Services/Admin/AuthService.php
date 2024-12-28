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
        error_log("AuthService->login called with username: $username");
        $user = $this->userModel->getUserByCredentials($username, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['username'];
            error_log("Đăng nhập thành công: " . json_encode($user));
            return $user;  // Trả về đối tượng user
        }

        error_log("Đăng nhập thất bại cho username: $username");
        return null;  // Trả về null nếu không tìm thấy người dùng
    }
}
