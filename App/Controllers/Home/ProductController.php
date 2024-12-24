<?php

namespace App\Controllers\Home;

use App\Services\Home\ProductService;

class ProductController
{
    private $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();
        return $products;
    }

    public function show($id)
    {
        return $this->productService->getProductById($id);
    }
}
