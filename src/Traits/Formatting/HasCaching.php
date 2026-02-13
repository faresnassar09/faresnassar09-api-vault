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


$finalKey = $this->cacheKey;

    if (request()->has('page')) {
        $finalKey .= '_page_' . request('page', 1);
    }


    
        $callback = $this->callback;
        return Cache::remember($finalKey, $this->timeToDestroy, function() use ($callback) {
            return $callback();
        });
    }

}
