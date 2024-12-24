<?php

namespace Project;

use App\Aspects\AuthenticationAspect;
use App\Aspects\AuthorizationAspect;
use App\Aspects\ErrorHandlingAspect;
use App\Aspects\SecurityAspect;
use Go\Core\AspectKernel;
use Go\Core\AspectContainer;
use App\Aspects\LoggingAspect;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require_once __DIR__ . '/vendor/autoload.php'; // This should be at the beginning of bootstrap.php
class ApplicationAspectKernel extends AspectKernel
{


    protected function configureAop(AspectContainer $container)
    {
        // Cấu hình aspect ở đây
        $logger = new Logger('app_logger');

        // Use an absolute path to your log file
        $logFilePath = 'C:/xampp/htdocs/ElectronicManager/logs/app.log'; 
        $logger->pushHandler(new StreamHandler($logFilePath, Logger::DEBUG));
        
        // Đăng ký LoggingAspect
        $container->registerAspect(new LoggingAspect($logger));
        $container->registerAspect(new AuthenticationAspect());
        $container->registerAspect(new AuthorizationAspect());
        $container->registerAspect(new ErrorHandlingAspect($logger));
        $container->registerAspect(new SecurityAspect());
    }

    // Gọi phương thức này để bắt đầu sử dụng aspect.
    public static function applyAop()
    {
        self::getInstance()->init([
            'debug' => true,
            'cacheDir' => __DIR__ . '/../cache',
            'appDir' => __DIR__ . '/../src',
            'includePaths' => [__DIR__ . '/../src'],
        ]);
    }
}
