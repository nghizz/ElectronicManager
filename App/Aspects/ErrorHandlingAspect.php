<?php

namespace App\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\AfterThrowing;
use Monolog\Logger;

class ErrorHandlingAspect implements Aspect
{
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @AfterThrowing(pointcut="execution(public App\Services\Admin\AuthService->login(*, *))", throwing="exception")
     */
    public function logErrors(MethodInvocation $invocation, \Throwable $exception)
    {
        $arguments = $invocation->getArguments();
        $username = $arguments[0] ?? 'unknown';

        $this->logger->error("Error occurred during login for user '{$username}': {$exception->getMessage()}");
    }
}
