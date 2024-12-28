<?php
namespace App\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Aop\Annotation\Before;
use Psr\Log\LoggerInterface;
use App\Services\Admin\AuthService;

class AuthenticationAspect implements Aspect
{
    public static function checkCredentials($username, $password) {
        if (empty($username) || empty($password)) {
            throw new \Exception("Tên đăng nhập hoặc mật khẩu không được để trống.");
        }
    }
}
