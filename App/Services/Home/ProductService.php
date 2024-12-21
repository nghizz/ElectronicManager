<?php

namespace App\Services;

use App\Models\Home\Product;

class ProductService
{
    public function getAllProducts()
    {
        return Product::all(); // Chắc chắn `Product` đã định nghĩa phương thức `all()`
    }

    public function getProductById($productId)
    {
        return Product::find($productId); // Thêm phương thức `find()` trong lớp `Product`
    }
}
