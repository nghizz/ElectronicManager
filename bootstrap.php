<?php

namespace Project;

use Go\Core\AspectKernel;
use Go\Core\AspectContainer;
use App\Aspects\LoggingAspect;
use App\Aspects\AuthenticationAspect;
use App\Aspects\ErrorHandlingAspect;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use App\Services\Admin\AuthService;

require_once __DIR__ . '/vendor/autoload.php';
class ApplicationAspectKernel extends AspectKernel
{
    protected function configureAop(AspectContainer $container)
    {
        $logger = $this->createLogger('app_logger', __DIR__ . '/logs/app.log', Logger::DEBUG);
        $login = $this->createLogger('login_logger', __DIR__ . '/logs/login.log', Logger::INFO);

        // Đăng ký các Aspects
        $container->registerAspect(new LoggingAspect($logger));
        $logger->info("LoggingAspect has been registered.");
        $container->registerAspect(new AuthenticationAspect($logger, new AuthService()));
    }

    private function createLogger(string $name, string $filePath, int $logLevel): Logger
    {
        try {
            $directory = dirname($filePath);

            // Tạo thư mục nếu chưa tồn tại
            if (!is_dir($directory)) {
                if (!mkdir($directory, 0777, true)) {
                    throw new \RuntimeException("Failed to create directory: $directory");
                }
            }

            // Tạo file log nếu chưa tồn tại
            if (!file_exists($filePath)) {
                $handle = fopen($filePath, 'w');
                if ($handle === false) {
                    throw new \RuntimeException("Failed to create log file: $filePath");
                }
                fclose($handle);
            }

            // Kiểm tra quyền ghi
            if (!is_writable($directory)) {
                throw new \RuntimeException("Directory is not writable: $directory");
            }
            if (!is_writable($filePath)) {
                throw new \RuntimeException("Log file is not writable: $filePath");
            }

            $logger = new Logger($name);
            $handler = new StreamHandler($filePath, $logLevel);
            $logger->pushHandler($handler);

            return $logger;
        } catch (\Exception $e) {
            error_log("Logger creation failed: " . $e->getMessage());
            throw $e;
        }
    }

    public static function applyAop()
    {
        // Thêm log để theo dõi
        error_log("Applying AOP...");

        self::getInstance()->init([
            'debug' => true,
            'appDir' => __DIR__ . '/App',
            'includePaths' => [__DIR__ . '/App'],
            'cacheDir' => __DIR__ . '/cache',
        ]);

        // Log sau khi AOP được áp dụng
        $logger = new Logger('app');
        $logger->pushHandler(new StreamHandler(__DIR__ . '/logs/test_app.log', Logger::DEBUG));
        $logger->info("AOP applied successfully.");
    }
}
