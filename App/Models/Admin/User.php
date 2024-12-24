<?php

namespace App\Models\Admin;
use App\Models\Connection;

class User
{
    private $conn;

    public function __construct()
    {
        $this->conn = Connection::getInstance();
    }

    public function getUser($username, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM taikhoan WHERE username = ? AND password = ?");
        $stmt->execute([$username, $password]);

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }
}