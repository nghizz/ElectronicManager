<?php
require_once __DIR__ . '/../../bootstrap.php';
use App\Controllers\Admin\LoginController;

// Khởi tạo session
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

$controller = new LoginController();
$controller->login($username, $password);
}
?>

