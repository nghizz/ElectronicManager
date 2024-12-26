<?php

namespace App\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Psr\Log\LoggerInterface;

class LoggingAspect implements Aspect
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Around("execution(* App\Services\Admin\AuthService->login(..))")
     */
    public function aroundLogin(MethodInvocation $invocation)
    {
        error_log("AOP aroundLogin triggered.");
        $arguments = $invocation->getArguments();
        $username = $arguments[0] ?? 'unknown';
        $this->logger->info("Around advice: User '{$username}' is attempting to log in.");
        return $invocation->proceed();
    }
}
