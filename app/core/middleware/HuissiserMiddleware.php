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
<<<<<<< HEAD
<<<<<<< HEAD
        if (!$user || $user['Role'] !== 'HUISSIER') $this->response->header('/');
=======
        if (!$user || $user['role'] !== 'HUISSIER') $this->response->header('/');
>>>>>>> 3aed771df3dace8e84bd5e07289afe121e61afcc
=======
        if (!$user || $user['role'] !== 'HUISSIER') $this->response->header('/');
>>>>>>> 3aed771df3dace8e84bd5e07289afe121e61afcc
    }
}
