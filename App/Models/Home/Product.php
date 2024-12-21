<?php

namespace App\Models\Home;

use App\Models\Connection;

class Product
{
    public static function all()
    {
        $pdo = Connection::getInstance();
        $stmt = $pdo->query("SELECT * FROM products");
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    public static function find($id)
    {
        $pdo = Connection::getInstance();
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_OBJ);
    }
}
