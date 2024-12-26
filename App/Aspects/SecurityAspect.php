<?php

namespace App\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Around;

class SecurityAspect implements Aspect
{
    /**
     * @Around("execution(public App\Controllers\*->*(*))")
     */
    public function securityCheck(MethodInvocation $invocation)
    {
        // Kiểm tra CSRF token
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->validateCSRFToken()) {
                throw new \Exception('Invalid CSRF token');
            }
        }

        // Sanitize input data
        $_POST = $this->sanitizeInput($_POST);
        $_GET = $this->sanitizeInput($_GET);

        return $invocation->proceed();
    }

    private function validateCSRFToken()
    {
        return isset($_POST['_token']) && $_POST['_token'] === $_SESSION['csrf_token'];
    }

    private function sanitizeInput(array $data)
    {
        array_walk_recursive($data, function(&$value) {
            $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        });
        return $data;
    }
}
