<?php

namespace FaresNassar\ApiVault\Traits\Formatting;
use Closure;


trait HasResponseMetadata
{
    
    protected mixed $data = null;
    protected string $message = 'Success';
    protected int $code = 200;
    protected array $headers=[];
    protected array $additional = [];
    protected int $jsonOptions = 0;
    protected ?Closure $callback = null;
    protected bool $success = true;



    public function success($success = true){

        $this->success = $success;

        return $this;
    }

    public function message($message){

        $this->message = $message;

        return $this;
    }

    public function data($data){

        $this->data = $data;

        return $this;
    }

    public function code($code = 200){

        $this->code = $code;

        return $this;
    }

    public function headers($headers =[]){

        $this->headers = $headers;

        return $this;
    }

    public function additional($additional = []){

        $this->additional = $additional;

        return $this;
    }

    public function jsonOptions($jsonOptions = 0){

        $this->jsonOptions = $jsonOptions;

        return $this;
    }

    public function callback(Closure $callback){

        $this->callback = $callback;

        return $this;

    }


}
