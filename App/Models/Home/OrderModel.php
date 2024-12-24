<?php
class OrderModel {
    private $conn;

    public function __construct($db_connection) {
        $this->conn = $db_connection;
    }

    // Thêm đơn hàng vào cơ sở dữ liệu
    public function addOrder($customer_name, $customer_phone, $customer_address, $order_detail, $total_amount) {
        $sql = "INSERT INTO orders (customer_name, customer_phone, customer_address, order_detail, total_amount) 
                VALUES ('$customer_name', '$customer_phone', '$customer_address', '$order_detail', '$total_amount')";
        if ($this->conn->query($sql) === TRUE) {
            return $this->conn->insert_id;
        }
        return false;
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateProductQuantity($product_id, $quantity) {
        $update_sql = "UPDATE products SET number = number - $quantity WHERE id = $product_id";
        return $this->conn->query($update_sql);
    }
}
?>
