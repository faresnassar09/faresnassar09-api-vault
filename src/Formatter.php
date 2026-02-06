<?php

namespace Faresnassar09\ApiVault;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class Formatter
{

    /*
    
    Retrieve Success Response

    */

    public function successResponse(
        string $message,
        $data = [],
        int $code = 200,
        array $headers = [],
        int $options = 0

    ): JsonResponse {

        return response()->json([

            'success' => true,
            'message' => $message,
            'data' => $data,
            'code' => $code,

        ], $code, $headers, $options);
    }

    /*
    
    Retrieve Failed Response

    */

    public function failedResponse(
        string $message = '',
        $data = [],
        int $code = 500,
        array $headers = [],
        int $options = 0

    ): JsonResponse {

        return response()->json([

            'success' => false,
            'message' => $message,
            'data' => $data,
            'code' => $code,

        ], $code, $headers, $options);
    }

        /*
    
    Retrieve Success Response With Cached Data And Cache Data in case it's not cached

    */

    public function successResponseWithCaching(

        Closure  $callback,
        string $cacheKey = 'key', 
        int $timeToDestroy = 3600,
        string $message = 'Success', 
        int $code = 200,            
        array $headers = [],
        int $options = 0

    ) {
        
$data = Cache::remember($cacheKey, $timeToDestroy, function () use ($callback) {
    return $callback();
});

        return $this->successResponse(
            $message,
            $data,
            $code,
            $headers,
            $options
        );
    }
}
