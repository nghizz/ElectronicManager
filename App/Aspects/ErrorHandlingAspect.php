<?php

namespace App\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Around;
use Psr\Log\LoggerInterface;

/**
 * Aspect xử lý lỗi
 */
class ErrorHandlingAspect implements Aspect
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Around("execution(public App\Controllers\Admin\ProductController->*(*))")
     */
    public function handleError(MethodInvocation $invocation)
    {
        try {
            // Thực thi phương thức
            return $invocation->proceed();
        } catch (\Exception $e) {
            // Ghi log lỗi
            $this->logger->error('Lỗi: ' . $e->getMessage());

            // Hiển thị thông báo lỗi hoặc chuyển hướng
            echo "Đã xảy ra lỗi. Vui lòng thử lại sau.";
            exit;
        }
    }
}