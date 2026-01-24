<?php

namespace App\Core\Middleware;
use App\Helper\Session;
use App\Helper\Response;

class AvocatMiddleware{
    private Session $session;
    private Response $response;

    public function __construct(){
        $this->session = new Session();
        $this->response = new Response();
        $this->session->Start();
    }

    public function handle(){
        $user = $this->session->getUser();
        if ($user || $user['role'] !== 'AVOCAT') $this->response->header('/');
    }
}