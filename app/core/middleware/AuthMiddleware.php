<?php

namespace App\Core\Middleware;

use App\Helper\Response;
use App\Helper\Session;

class AuthMiddleware {
    private Session $session;
    private Response $response;

    public function __construct(){
        $this->session = new Session();
        $this->response = new Response();
    }
    
    public function handle(array $routeInfo) {
        if(!$routeInfo['auth']) return;
        $userId = $this->session->getUserId();
        if(!$userId) $this->response->header('/');
        $user = true;
        // if(!$user || !in_array($user->getRole(), $routeInfo["roles"])) $this->response->header("/");
    }
}