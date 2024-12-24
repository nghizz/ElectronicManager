<?php
namespace App\Services\Admin;

use App\Models\Connection;

class AuthService
{
    public function login(string $username, string $password): bool
    {
        $conn = Connection::getInstance();
        $stmt = $conn->prepare("SELECT * FROM taikhoan WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch();
            $_SESSION['user_id'] = $user['username'];
            return true;
        }

        return false;
    }
}