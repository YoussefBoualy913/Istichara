<?php

namespace App\Core\Middleware;
use App\Helper\Session;
use App\Helper\Response;

class HuissiserMiddleware{
    private Session $session;
    private Response $response;

    public function __construct(){
        $this->response = new Response();
        $this->session = new Session();
        $this->session->Start();
    }

    public function handle(): void {
        $user = $this->session->getUser();
        if (!$user || $user['Role'] !== 'HUISSIER') $this->response->header('/');
    }
}
