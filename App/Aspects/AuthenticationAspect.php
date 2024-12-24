<?php

namespace App\Aspects;

use App\Controllers\Admin\LoginController;
use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Before;
use App\Controllers\Admin;

/**
 * Aspect kiểm tra xác thực người dùng
 */
class AuthenticationAspect implements Aspect
{
    /**
     * @Before("execution(public App\Controllers\Admin\*->*(*))")
     */
    public function checkLogin(MethodInvocation $invocation)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['user_id'])) {
            // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
            header('Location: /ElectronicManager/admin/login.php');
            exit;
        }

        // Nếu đã đăng nhập, cho phép truy cập phương thức
        return $invocation->proceed();
    }
}