<?php

namespace App\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Around;
use Psr\Log\LoggerInterface;

class LoggingAspect implements Aspect
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Around("execution(public App\Services\Admin\AuthService->login(*))") 
     */
    public function logLogin(MethodInvocation $invocation)
    {
        $arguments = $invocation->getArguments();
        $username = $arguments[0] ?? 'Unknown'; 

        try {
            $this->logger->debug('Login attempt: ' . $username); 
            $result = $invocation->proceed(); 

            if ($result) {
                $this->logger->info('Login successful: ' . $username);
            } else {
                $this->logger->warning('Login failed: ' . $username); 
            }
            return $result;
        } catch (\Exception $e) {
            $this->logger->error('Login error: ' . $username . ' - ' . $e->getMessage());
            throw $e; 
        }
    }
}