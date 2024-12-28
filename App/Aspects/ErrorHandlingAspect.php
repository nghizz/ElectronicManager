<?php
namespace App\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Aop\Annotation\AfterThrowing;
use Psr\Log\LoggerInterface;

class ErrorHandlingAspect implements Aspect
{
    public static function handleError($exception) {
        LoggingAspect::log("Error: " . $exception->getMessage());
        echo "Đã xảy ra lỗi: " . $exception->getMessage();
    }
}

