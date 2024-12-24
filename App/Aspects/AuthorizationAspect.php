<?php

namespace App\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Before;

/**
 * Aspect kiểm tra quyền hạn của người dùng
 */
class AuthorizationAspect implements Aspect
{
    /**
     * @Before("execution(public App\Controllers\Admin\ProductController->*(*))")
     */
    public function checkAdmin(MethodInvocation $invocation)
    {
        // Kiểm tra xem người dùng có phải là admin không
        if ($_SESSION['user_id'] !== 'admin') {
            // Nếu không phải admin, hiển thị thông báo lỗi hoặc chuyển hướng
            echo "Bạn không có quyền truy cập chức năng này.";
            exit;
        }

        // Nếu là admin, cho phép truy cập phương thức
        return $invocation->proceed();
    }
}