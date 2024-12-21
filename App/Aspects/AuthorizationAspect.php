<?php

namespace App\Aspects;
use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Before;

class AuthorizationAspect implements Aspect
{
    /**
     * @Before("execution(public App\Controllers\Admin\*->*(*))")
     */
    public function checkAuthorization(MethodInvocation $invocation)
    {
        // Kiểm tra xem người dùng có phải là admin hay không
        if ($_SESSION['user']['role'] !== 'admin') {
            // Chuyển hướng đến trang lỗi hoặc hiển thị thông báo lỗi
            header('Location: /error'); 
            exit;
        }
    }
}