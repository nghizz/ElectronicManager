<?php

namespace App\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Before;

// Xử lý việc xác thực người dùng trước khi cho phép truy cập vào các chức năng quan trọng.
class AuthenticationAspect implements Aspect
{
    /**
     * @Before("execution(public App\Controllers\Admin\*->*(*))")
     */
    public function checkAuthentication(MethodInvocation $invocation)
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (!isset($_SESSION['user'])) {
            // Chuyển hướng đến trang đăng nhập
            header('Location: /login');
            exit;
        }
    }
}
