<?php

namespace App\Models\Admin;

use App\Models\Connection;
use PDO;

class Product
{
    private $conn;

    public function __construct()
    {
        $this->conn = Connection::getInstance();
    }

    public function getAllProducts()
    {
        $stmt = $this->conn->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createProduct($name, $image, $price, $description, $number)
    {
        $stmt = $this->conn->prepare("INSERT INTO products (name, image, price, description, number) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $image, $price, $description, $number]);
    }

    public function getProductById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduct($id, $name, $image, $price, $description, $number)
    {
        $stmt = $this->conn->prepare("UPDATE products SET name = ?, image = ?, price = ?, description = ?, number = ? WHERE id = ?");
        $stmt->execute([$name, $image, $price, $description, $number, $id]);
    }

    public function deleteProduct($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
    }
}