<?php

namespace App\Core\Middleware;
use App\Helper\Response;
use App\Helper\Session;
use App\Repository\UserRepository;

class AuthMiddleware {
    private Session $session;
    private Response $response;
    private UserRepository $userRepo;
    public function __construct(){
        $this->session = new Session();
        $this->response = new Response();
        $this->userRepo= new UserRepository();
    }
    
    public function handle(array $routeInfo) {
        if(!$routeInfo['auth']) return;
        $userId = $this->session->getUserId();
        if(!$userId) $this->response->header('/');
        $user = $this->userRepo->findByUserId((int) $userId);
        if(!$user || !in_array(strtoupper($user['role']), $routeInfo["roles"])) $this->response->header("/");
    }
}