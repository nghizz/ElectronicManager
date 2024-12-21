<?php
namespace App\Controllers\Home;

use App\Services\Home\CartService;

class CartController
{
    private $cartService;

    public function __construct()
    {
        $this->cartService = new CartService();
    }

    public function addToCart($productId)
    {
        $this->cartService->addProductToCart($productId);
        header('Location: index.php');
    }
}
