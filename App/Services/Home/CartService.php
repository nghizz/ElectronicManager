<?php

namespace App\Services;

use App\Models\Home\Product;

class CartService
{
    public function addProductToCart($productId)
    {
        session_start();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $_SESSION['cart'][] = $productId;
    }

    public function removeProductFromCart($productId)
    {
        session_start();
        if (isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($id) use ($productId) {
                return $id !== $productId;
            });
        }
    }

    public function getCartProducts()
    {
        session_start();
        if (!isset($_SESSION['cart'])) {
            return [];
        }

        // Giả sử `Product` có phương thức để lấy thông tin theo ID
        return array_map(function ($productId) {
            return Product::find($productId);
        }, $_SESSION['cart']);
    }
}
