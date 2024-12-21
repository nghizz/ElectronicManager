<?php
namespace App\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Around;
use Psr\Log\LoggerInterface;

class ErrorHandlingAspect implements Aspect
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Around("execution(public App\Controllers\*->*(*))")
     */
    public function handleError(MethodInvocation $invocation)
    {
        try {
            // Thực thi method
            return $invocation->proceed();
        } catch (\Exception $e) {
            // Ghi log lỗi
            $this->logger->error("Exception: " . $e->getMessage());

            // Hiển thị thông báo lỗi thân thiện
            echo "Đã xảy ra lỗi. Vui lòng thử lại sau."; 
            // Hoặc chuyển hướng đến trang lỗi
            // header('Location: /error');
            exit;
        }
    }
}