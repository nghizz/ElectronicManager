<?php

namespace App\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Before;

class SecurityAspect implements Aspect
{
    /**
     * Kiểm tra quyền truy cập trước khi gọi phương thức.
     * @Before("execution(public **->*(*))")
     */
    public function checkAdminAccess(MethodInvocation $invocation)
    {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            die("Access denied: You do not have permission to access this page.");
        }
    }
}
