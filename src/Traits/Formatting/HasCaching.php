<?php

namespace Faresnassar09\ApiVault\Traits\Formatting;
use Illuminate\Support\Facades\Cache;


trait HasCaching 
{
    protected string $cacheKey = 'cache_key';
    protected int $timeToDestroy = 3600;
  
    public function cache($cachingKey,$timeToDestroy){


        $this->cacheKey = $cachingKey;
        $this->timeToDestroy = $timeToDestroy;
        
        return $this;

    }

    
    protected function resolveCachedData()
    {
        $callback = $this->callback;
        return Cache::remember($this->cacheKey, $this->timeToDestroy, function() use ($callback) {
            return $callback();
        });
    }



}
