<?php

namespace App\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\AfterReturning;
use Go\Lang\Annotation\After;
use Psr\Log\LoggerInterface;

class LoggingAspect implements Aspect
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Ghi log sau khi phương thức 'login' trả về kết quả thành công
     * @AfterReturning(pointcut="execution(public App/Services/Admin/AuthService->login(*, *))", returning="result")
     */
    public function afterLogin(MethodInvocation $invocation, $result)
    {
        $arguments = $invocation->getArguments();
        $username = $arguments[0] ?? 'unknown';

        // Ghi log kết quả trả về với thông tin chi tiết của user
        if ($result) {
            $this->logger->info("Login successful", [
                'username' => $username,
                'user_data' => $result, // Đối tượng user (có thể là mảng hoặc đối tượng)
            ]);
        } else {
            $this->logger->error("Login failed", [
                'username' => $username,
            ]);
        }
    }


    /**
     * Ghi log sau khi 'login' được gọi (chỉ theo dõi việc gọi phương thức)
     * @After("execution(public App/Services/Admin/AuthService->login(*, *))")
     */
    public function logAfterLogin(MethodInvocation $invocation)
    {
        $arguments = $invocation->getArguments();
        $username = $arguments[0] ?? 'unknown';
        $this->logger->info("AuthService->login called", [
            'username' => $username,
        ]);
    }
}
