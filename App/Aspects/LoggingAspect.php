<?php

namespace App\Aspects;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;

class LoggingAspect implements Aspect
{
    private static $logFile = 'C:/xampp/htdocs/ElectronicManager/logs/app.log';

    public static function log($message) {
        $timestamp = date('Y-m-d H:i:s');
        $formattedMessage = "[$timestamp] $message\n";
        file_put_contents(self::$logFile, $formattedMessage, FILE_APPEND);
    }
}
