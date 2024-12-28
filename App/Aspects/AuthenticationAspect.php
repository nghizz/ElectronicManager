<?php
namespace App\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Before;
use Psr\Log\LoggerInterface;

class AuthenticationAspect implements Aspect
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Ghi log trước khi kiểm tra xác thực
     * @Before("execution(public App/Services/Admin/AuthService->login(*, *))")
     */
    public function logBeforeAuthentication(MethodInvocation $invocation)
    {
        $arguments = $invocation->getArguments();
        $username = $arguments[0] ?? 'unknown';

        $this->logger->info("Authentication check started", [
            'username' => $username,
        ]);
    }
}

