<?php
namespace App\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Before;
use Go\Lang\Annotation\After;
use Psr\Log\LoggerInterface;
use App\Services\Admin\AuthService;

class AuthenticationAspect implements Aspect
{
    private $logger;
    private $authService;

    public function __construct(LoggerInterface $logger, AuthService $authService)
    {
        $this->logger = $logger;
        $this->authService = $authService;  // Khởi tạo authService
    }

    /**
     * @Before("execution(public App\Services\Admin\AuthService->login())")
     */
    public function logAfterLogin(\Go\Aop\Intercept\MethodInvocation $invocation)
    {
        // Lấy các tham số của phương thức login
        $arguments = $invocation->getArguments();
        $username = $arguments[0] ?? 'unknown';

        // Ghi log
        $this->logger->info("AuthenticationAspect: Login process completed for user '{$username}'.");
    }
}
?>
