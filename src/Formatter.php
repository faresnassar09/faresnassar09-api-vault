<?php

namespace Faresnassar09\ApiVault;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class Formatter
{

    protected ?Closure $callback = null;
    protected string $cacheKey = 'cache_key';
    protected int $timeToDestroy = 3600;
    protected mixed $data = null;
    protected string $message = 'Success';
    protected int $code = 200;
    protected array $headers=[];
    protected int $options = 0;
    protected bool $success = true;

    public function message($message){

        $this->message = $message;

        return $this;
    }

    public function data($data){

        $this->data = $data;

        return $this;
    }

    public function code($code){

        $this->code = $code;

        return $this;
    }

    public function headers($headers){

        $this->headers = $headers;

        return $this;
    }

    public function options($options){

        $this->options = $options;

        return $this;
    }

    public function callback(Closure $callback){

        $this->callback = $callback;

        return $this;

    }

    public function cache($cachingKey,$timeToDestroy){


        $this->cacheKey = $cachingKey;
        $this->timeToDestroy = $timeToDestroy;
        
        return $this;

    }

    private function dataResorver(){

        if ($this->callback && $this->cacheKey !== 'cache_key') {

            $callback = $this->callback;
            
            return Cache::remember($this->cacheKey, $this->timeToDestroy, function() use ($callback) {
                return $callback();
            });
        }
        elseif ($this->callback) {

            return ($this->callback)();
        }

        return $this->data;

        }


    public function respond(): JsonResponse {

        $data = $this->dataResorver();

        return response()->json([

            'success' => $this->success,
            'message' => $this->message,
            'data' => $data,
            'code' => $this->code,

        ], $this->code, $this->headers, $this->options);
    }
    }
