<?php

namespace Project;

require_once __DIR__ . '/vendor/autoload.php';

use Go\Core\AspectKernel;
use Go\Core\AspectContainer;
use App\Aspects\LoggingAspect;
use App\Aspects\AuthenticationAspect;
use App\Aspects\ErrorHandlingAspect;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use App\Services\Admin\AuthService;

class ApplicationAspectKernel extends AspectKernel
{
    protected function configureAop(AspectContainer $container)
    {
        // Đảm bảo đường dẫn và logger được tạo đúng cách
        $logger = $this->createLogger('app_logger', __DIR__ . '/logs/app.log', Logger::DEBUG);
        $errorLogger = $this->createLogger('error_logger', __DIR__ . '/logs/errors.log', Logger::ERROR);

        // Đăng ký các Aspects
        $container->registerAspect(new LoggingAspect($logger));
        $container->registerAspect(new AuthenticationAspect($logger, new AuthService()));
        $container->registerAspect(new ErrorHandlingAspect($errorLogger));
    }

    private function createLogger(string $name, string $filePath, int $logLevel): Logger
    {
        // Kiểm tra và tạo thư mục nếu chưa tồn tại
        $directory = dirname($filePath);
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        // Tạo Logger
        $logger = new Logger($name);
        $logger->pushHandler(new StreamHandler($filePath, $logLevel));
        return $logger;
    }

    public static function applyAop()
    {
        self::getInstance()->init([
            'debug' => true,
            'appDir' => __DIR__ . '/App',
            'includePaths' => [__DIR__ . '/App'],
            'cacheDir' => __DIR__ . '/cache',
        ]);

        // Log một lần khi AOP được áp dụng
        $logger = new Logger('app');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/test_app.log', Logger::DEBUG));
        $logger->info("AOP applied successfully.");
    }
}
