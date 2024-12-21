<?php
// Tải các thư viện và cấu hình cần thiết
require_once __DIR__ . '../../vendor/autoload.php';

use App\Controllers\Home\ProductController;
use App\Controllers\Home\CartController;
use App\AspectKernel;
use App\Models\Connection;
use App\Services\AuthService;

// Khởi tạo Dependency Injection Container
$container = new \Illuminate\Container\Container();

$container->singleton(\Psr\Log\LoggerInterface::class, function () {
    return new \Monolog\Logger('app');
});


$container->singleton(AuthService::class, function () {
    // Lấy kết nối PDO từ lớp Database
    $pdo = Connection::getInstance();
    return new AuthService($pdo);
});

// Khởi tạo AspectKernel
$applicationAspectKernel = AspectKernel::getInstance();
$applicationAspectKernel->init(
    [
        'debug'         => true,
        'appDir'        => __DIR__ . '/../',
        'cacheDir'      => __DIR__ . '/../cache',
        'includePaths'  => [
            __DIR__ . '/../src'
        ],
        'excludePaths' => [
            __DIR__ . '/../vendor/goaop/framework' // Loại trừ thư mục Go AOP khỏi weaving
        ]
    ]
);

// Khởi tạo các controller cần thiết
$productController = new ProductController();
$cartController = new CartController();

// Xử lý các yêu cầu từ người dùng
if (isset($_GET["action"]) && $_GET["action"] == "add" && isset($_GET["id"])) {
    $cartController->addToCart($_GET["id"]);
}

// Lấy danh sách sản phẩm từ database
$products = $productController->index();

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L2N SHOP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #6a89cc, #b8e994);
            margin: 0;
            padding: 0;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 10px 0;
            text-align: center;
        }
        .product-card {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>
<body>
    <div class="hbot">
        <div class="container">
            <?php include 'partials/navbar.php'; ?>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <?php foreach ($products as $product): ?>
                    <div class='col-md-4'>
                        <a href='details.php?id=<?= $product->id ?>' class='product-card'>
                            <div class='card'>
                                <img src='<?= $product->image ?>' alt='<?= $product->name ?>' class='card-img-top'>
                                <div class='card-body'>
                                    <h5 class='card-title'><?= $product->name ?></h5>
                                    <p class='card-text'>Giá: <?= $product->price ?> VND</p>
                                    <a href='?action=add&id=<?= $product->id ?>' class='btn btn-success'>Mua ngay</a>
                                    <a href='?action=add&id=<?= $product->id ?>' class='btn btn-info'>Thêm vào giỏ hàng</a>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; Dự án web K44E</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- Thêm các script JS khác ở đây -->
</body>
</html>