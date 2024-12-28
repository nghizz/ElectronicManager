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
        $logger = $this->createLogger('app_logger', __DIR__ . '/logs/logging.log', Logger::DEBUG);
        $errorLogger = $this->createLogger('error_logger', __DIR__ . '/logs/errors.log', Logger::ERROR);

        // Đăng ký các Aspects với Logger
        $container->registerAspect(new LoggingAspect($logger));
        $container->registerAspect(new AuthenticationAspect($logger));
        $container->registerAspect(new ErrorHandlingAspect($errorLogger));
    }

    private function createLogger(string $name, string $filePath, int $logLevel): Logger
    {
        // Kiểm tra và tạo thư mục nếu chưa tồn tại
        $directory = dirname($filePath);
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
            error_log("Directory created: $directory");
        }

        // Kiểm tra quyền ghi
        if (!is_writable($directory)) {
            error_log("Directory is not writable: $directory");
            var_dump(is_writable($directory)); // Hiển thị trạng thái quyền ghi
        } else {
            error_log("Directory is writable: $directory");
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
            'appDir' => __DIR__,
            'includePaths' => [
                __DIR__ . '/App',      // Thư mục chứa các services, models...
                __DIR__ . '/admin',    // Thư mục chứa các xử lý của admin
                __DIR__ . '/home',     // Thư mục giao diện hoặc xử lý phía home
            ],
            'cacheDir' => __DIR__ . '/cache',
        ]);
        error_log("Initializing AOP with include paths: " . implode(', ', [
            __DIR__ . '/App',
            __DIR__ . '/admin',
            __DIR__ . '/home',
        ]));
        // Log một lần khi AOP được áp dụng
        $logger = new Logger('app');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/test_app.log', Logger::DEBUG));
        $logger->info("AOP applied successfully.");
    }
}
