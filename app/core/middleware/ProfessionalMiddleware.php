<?php

namespace App\Core\Middleware;
use App\Helper\Session;
use App\Helper\Response;

class ProfessionalMiddleware {
    private Session $session;
    private Response $response;

    public function __construct(){
        $this->response = new Response();
        $this->session = new Session();
        $this->session->Start();
    }

    public function handle(): void {
        $user = $this->session->getUser();
        if (!$user || !in_array($user['role'], ['AVOCAT', 'HUISSIER'])) $this->response->header('/');
    }
}
