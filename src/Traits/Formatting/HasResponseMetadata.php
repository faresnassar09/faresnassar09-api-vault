<?php

namespace Faresnassar09\ApiVault\Traits\Formatting;
use Closure;


trait HasResponseMetadata
{
    
    protected mixed $data = null;
    protected string $message = 'Success';
    protected int $code = 200;
    protected array $headers=[];
    protected int $options = 0;
    protected ?Closure $callback = null;
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


}
