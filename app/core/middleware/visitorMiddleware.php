<?php

namespace App\Core\Middleware;
use App\Helper\Session;
use App\Helper\Response;

class VisitorMiddleware {
    private Session $session;
    private Response $response;

    public function __construct() {
        $this->session = new Session();
        $this->response = new Response();
        $this->session->Start();
    }

    public function handle(): void {
        $user = $this->session->getUser();
        if($user) $this->response->header('/');
    }
}
