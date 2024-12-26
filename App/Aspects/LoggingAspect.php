<?php
namespace App\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Aop\Annotation\Before;
use Go\Aop\Annotation\After;
use Psr\Log\LoggerInterface;

class LoggingAspect implements Aspect
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Ghi log trước khi phương thức 'login' trong AuthService được gọi
     * @Before("execution(public App\Services\Admin\AuthService->login(*, *))")
     */
    public function beforeLogin(MethodInvocation $invocation)
    {
        $arguments = $invocation->getArguments();
        $username = $arguments[0] ?? 'unknown';
        
        $this->logger->info("Before login attempt for user '{$username}'");
    }

    /**
     * Ghi log sau khi phương thức 'login' trong AuthService được gọi
     * @After("execution(public App\Services\Admin\AuthService->login(*, *))")
     */
    public function afterLogin(MethodInvocation $invocation)
    {
        $arguments = $invocation->getArguments();
        $username = $arguments[0] ?? 'unknown';
        
        $this->logger->info("After login attempt for user '{$username}'");
    }
}
