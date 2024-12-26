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
     * @AfterThrowing(pointcut="execution(public App\Services\..*(..))", throwing="exception")
     */
    public function logErrors(MethodInvocation $invocation, \Throwable $exception)
    {
        $method = $invocation->getMethod()->getName();
        $className = get_class($invocation->getThis());
        $errorMessage = $exception->getMessage();

        $this->logger->error("Lỗi xảy ra: {$errorMessage}", ['trace' => $exception->getTraceAsString()]);
    }
}
