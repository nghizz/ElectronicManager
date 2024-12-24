<?php

namespace App\Controllers\Admin;

use App\Services\Admin\ProductService;

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
        return $products; // Return the products array
    }

    public function create()
    {
        return $this->view('admin/products/create');
    }

    public function store()
    {
        $name = $_POST['name'];
        $image = $_POST['image'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $number = $_POST['number'];

        $this->productService->createProduct($name, $image, $price, $description, $number);

        header('Location: /ElectronicManager/public/admin/products');
        exit;
    }

    public function edit($id)
    {
        $product = $this->productService->getProductById($id);
        return $this->view('admin/products/edit', ['product' => $product]);
    }

    public function update($id)
    {
        $name = $_POST['name'];
        $image = $_POST['image'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $number = $_POST['number'];

        $this->productService->updateProduct($id, $name, $image, $price, $description, $number);

        header('Location: /ElectronicManager/public/admin/products');
        exit;
    }

    public function delete($id)
    {
        $this->productService->deleteProduct($id);

        header('Location: /ElectronicManager/public/admin/products');
        exit;
    }

    private function view($view, $data = [])
    {
        extract($data);
        require __DIR__ . '/../../views/' . $view . '.php';
    }
}