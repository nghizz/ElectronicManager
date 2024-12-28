<?php

namespace App\Models\Admin;

use App\Models\Connection;
use PDO;

class User
{
    private $conn;

    public function __construct()
    {
        $this->conn = Connection::getInstance();
    }

    public function getUserByCredentials($username, $password)
    {
        $query = "SELECT * FROM taikhoan WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        error_log("Đã truy vấn dữ liệu từ bảng taikhoan: " . json_encode($result));
        return $result;
    }
}
