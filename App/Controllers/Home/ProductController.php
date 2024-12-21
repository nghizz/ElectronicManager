<?php

namespace App\Controllers\Home;

use App\Services\ProductService;

class ProductController 
{
    private $productService;

    public function __construct() 
    {
        $this->productService = new ProductService();
    }

    public function index() 
    {
        return $this->productService->getAllProducts();
    }

    public function show($id) 
    {
        return $this->productService->getProductById($id);
    }
}