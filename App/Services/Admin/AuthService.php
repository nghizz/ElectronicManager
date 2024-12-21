<?php

namespace App\Services;

class AuthService
{
    private $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function login($username, $password)
    {
        $stmt = $this->db->prepare("SELECT * FROM taikhoan WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            session_start();
            $_SESSION['authenticated'] = true;
            $_SESSION['username'] = $username;
            return true;
        }

        return false;
    }

    public function logout()
    {
        session_start();
        session_destroy();
    }

    public function checkAuthentication()
    {
        session_start();
        return isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true;
    }
}
