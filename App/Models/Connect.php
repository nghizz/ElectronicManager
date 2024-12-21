<?php

namespace App\Models;

use PDO;
use PDOException;

class Connection
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $host = 'localhost';
        $dbname = 'webapp'; // Đổi thành tên database của bạn
        $username = 'root'; // Đổi thành username phù hợp
        $password = ''; // Đổi thành password phù hợp

        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Connection();
        }
        return self::$instance->getConnection();
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
