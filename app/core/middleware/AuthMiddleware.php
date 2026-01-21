<?php

namespace App\Core\Middlewares;

use App\Helper\Response;
use App\Helper\Session;

class AuthMiddleware {
    private Session $session;
    private Response $response;

    public function __construct(){
        $this->session = new Session();
        $this->response = new Response();
    }
    
    public function handle(bool $requiredAuth, array $routeInfo) {
        if($requiredAuth) return;
        $userId = $this->session->getUserId();

        if($routeInfo['auth'] && !$userId) $this->response->header('/');

        $user = true;
        if($user) $this->response->header("/");
    }
}