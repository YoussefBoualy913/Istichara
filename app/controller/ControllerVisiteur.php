<?php
namespace App\Controller;

use App\Helper\Response;
use App\Helper\Session;
use App\Helper\View;

class ControllerVisiteur {
    private View $view;
    private Session $session;
    private Response $response;
    public function __construct() {
        $this->view = new View();
        $this->session = new Session();
        $this->response = new Response();
    }
     public function index(){
        $this->view->render('visiteur.php');
        }
        
    public function register(){
    if($this->session->getUserId()) $this->response->header("/"); 
        $this->view->render('register.php');
    }
}