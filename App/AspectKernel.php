<?php
namespace App;

use Go\Core\AspectKernel as GoAspectKernel;
use Go\Core\AspectContainer;

class AspectKernel extends GoAspectKernel
{
    protected function configureAop(AspectContainer $container)
    {
        // Chỉ cần đăng ký các Aspect, không cần khởi tạo chúng ở đây
        $container->registerAspect(new \App\Aspects\LoggingAspect());
        $container->registerAspect(new \App\Aspects\SecurityAspect());
        $container->registerAspect(new \App\Aspects\AuthenticationAspect());
        $container->registerAspect(new \App\Aspects\AuthorizationAspect());
        // $container->registerAspect(new \App\Aspects\CachingAspect(new \Symfony\Component\Cache\Adapter\AdapterInterface())); // Không cần khởi tạo CacheInterface ở đây
        // $container->registerAspect(new \App\Aspects\ErrorHandlingAspect());
    }
}
