<?php
namespace App\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Around;

class LoggingAspect implements Aspect
{
    /**
     * @Around("execution(public App\Services\*->*(*))")
     */
    public function logMethodCall(MethodInvocation $invocation)
    {
        $method = $invocation->getMethod()->getName();
        $args = $invocation->getArguments();
        error_log("Calling method $method with args: " . json_encode($args));

        // Gọi tiếp tục phương thức thực tế
        return $invocation->proceed();
    }
}
