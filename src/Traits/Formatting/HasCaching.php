<?php

namespace FaresNassar\ApiVault\Traits\Formatting;
use Illuminate\Support\Facades\Cache;


trait HasCaching 
{
    protected $cacheKey = null;
    protected int $timeToDestroy = 3600;
  
    public function cache($cachingKey,$timeToDestroy){


        $this->cacheKey = $cachingKey;
        $this->timeToDestroy = $timeToDestroy;
        
        return $this;

    }

    
    protected function resolveCachedData()
    {

        $page = request('page', 1);
        $finalKey = $this->cacheKey . '_page_' . $page;
        $callback = $this->callback;
        return Cache::remember($finalKey, $this->timeToDestroy, function() use ($callback) {
            return $callback();
        });
    }

}
