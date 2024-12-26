<?php

namespace App\Models\Home;

class OrderModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    /**
     * Tạo đơn hàng mới
     */
    public function create($customerId, $items, $totalAmount)
    {
        try {
            $this->db->beginTransaction();

            // Insert order
            $sql = "INSERT INTO orders (customer_id, total_amount, status) VALUES (?, ?, 'pending')";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$customerId, $totalAmount]);
            $orderId = $this->db->lastInsertId();

            // Insert order items
            foreach ($items as $item) {
                $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$orderId, $item['product_id'], $item['quantity'], $item['price']]);
            }

            $this->db->commit();
            return $orderId;

        } catch (\Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }

    /**
     * Lấy thông tin đơn hàng
     */
    public function getById($orderId)
    {
        $sql = "SELECT * FROM orders WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$orderId]);
        return $stmt->fetch();
    }
}
?>
