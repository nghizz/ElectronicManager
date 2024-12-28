<?php
require_once __DIR__ . '/../../bootstrap.php'; // Đảm bảo bootstrap.php được bao gồm

use App\Controllers\Admin\LoginController;
\Project\ApplicationAspectKernel::applyAop();
// Khởi tạo session
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Bắt đầu session nếu chưa bắt đầu
}
// Xử lý đăng nhập
$controller = new LoginController();
$controller->handleLogin();
?>

