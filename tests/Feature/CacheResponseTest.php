<?php

use FaresNassar\ApiVault\Formatter;
use Illuminate\Support\Facades\Cache;
use Mockery;


test('it caches the data successfully', function () {


    $cacheKey = 'my_cache_key';

    $formatter = new  Formatter();

    $formatter
        ->callback(fn() => ['user' => 'fares'])
        ->cache($cacheKey, 60) 
        ->send();

    expect(Illuminate\Support\Facades\Cache::has($cacheKey))->toBeTrue();
});