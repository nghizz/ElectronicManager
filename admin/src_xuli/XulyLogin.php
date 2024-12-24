<?php
require_once __DIR__ . '/../../bootstrap.php';
use App\Controllers\Admin\LoginController;

$controller = new LoginController();
$controller->handleLogin();

$file = fopen('/../../logs/test.txt', 'w');
if (!$file) {
    error_log("Error opening file!"); 
} else {
    fwrite($file, 'This is a test.');
    fclose($file);
}
?>