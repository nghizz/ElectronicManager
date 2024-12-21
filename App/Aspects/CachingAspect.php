<?php
namespace App\Aspects;

use Go\Lang\Annotation\Around;
use Psr\SimpleCache\CacheInterface;
use Go\Aop\Aspect;

class CachingAspect implements Aspect
{
    private $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * @Around("execution(* App\Controllers\*.getProducts())")
     */
    public function cacheGetProducts($joinPoint)
    {
        $cacheKey = 'products';
        if ($this->cache->has($cacheKey)) {
            return $this->cache->get($cacheKey);
        }

        $result = $joinPoint->proceed();
        $this->cache->set($cacheKey, $result, 3600);
        return $result;
    }
}