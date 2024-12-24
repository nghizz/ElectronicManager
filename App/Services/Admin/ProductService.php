<?php
namespace App\Services\Admin;

use App\Models\Admin\Product;

class ProductService
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function getAllProducts()
    {
        // Trả về danh sách sản phẩm từ cơ sở dữ liệu hoặc cache
        return $this->productModel->getAllProducts();
    }

    public function createProduct($name, $image, $price, $description, $number)
    {
        // Lưu sản phẩm vào cơ sở dữ liệu
        $this->productModel->createProduct($name, $image, $price, $description, $number);
    }

    public function updateProduct($id, $name, $image, $price, $description, $number)
    {
        // Cập nhật thông tin sản phẩm
        $this->productModel->updateProduct($id, $name, $image, $price, $description, $number);
    }

    public function deleteProduct($id)
    {
        // Xóa sản phẩm
        $this->productModel->deleteProduct($id);
    }

    public function getProductById($id)
    {
        return $this->productModel->getProductById($id);
    }
}
