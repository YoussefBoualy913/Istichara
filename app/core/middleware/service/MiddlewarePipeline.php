<?php

namespace App\Core\Middleware\Service;

class MiddlewarePipeline{

    private array $middlewares;

    public function __construct(array $middlewares) {
        $this->middlewares = $middlewares;
    }

    public function handle(){
        foreach ($this->middlewares as $middleware) (new $middleware())->handle();
    }
}
