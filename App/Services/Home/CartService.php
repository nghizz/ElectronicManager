<?php

namespace App\Services\Home;

class CartService
{
    /**
     * Thêm sản phẩm vào giỏ hàng
     */
    public function addToCart($productId, $quantity = 1)
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }

    /**
     * Lấy thông tin giỏ hàng
     */
    public function getCart()
    {
        return $_SESSION['cart'] ?? [];
    }

    /**
     * Cập nhật số lượng sản phẩm
     */
    public function updateQuantity($productId, $quantity)
    {
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$productId]);
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }
}
