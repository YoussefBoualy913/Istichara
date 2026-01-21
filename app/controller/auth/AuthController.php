<?php

namespace App\Controllers\auth;

use App\Helper\Request;
use App\Helper\Response;
use App\Helper\Session;
use App\Helper\Validator;
use App\Helper\View;

class AuthentificationController {
    private Request $request;
    private Response $response;
    private View $view;
    private Session $session;
    private Validator $Validator;

    public function __construct() {
        $this->request = new Request();
        $this->response = new Response();
        $this->view = new View();
        $this->session = new Session();
        $this->Validator = new Validator();
    }

    public function login() {
        if($this->session->getUserId()) {
            $this->response->header("/");
            exit();
        }
        
        if($this->request->getRequestType() === "GET"){
            $this->view->render("");
        }
        
        if($this->request->getRequestType() === "POST"){   
            $email = $this->Validator->isValidEmail($this->request->getParam("user-email"));
            $password = $this->Validator->isValidString($this->request->getParam("password"));
            $ispasswordValid = $this->Validator->isValidPassword($password, "hadi blast l password li jay men lyouser");
            
            $user = true;
            
            if(!$user){
                $this->response->header("/auth/register");
            }

            if(!$ispasswordValid){
                $this->response->header("/auth/login");
            }

            $this->session->setUserId("hna ndir l id dyal l user");
            $this->response->header("/dashboard");
        }
    }
    
    public function registerUser() {
        if($this->session->getUserId()) $this->response->header("/");
            
        // ndiro render l ui fach tji get request
        if($this->request->getRequestType() === "GET"){
            $this->view->render("");
        }

        // itra traitment dyal request fach tji post request
        if($this->request->getRequestType() === "POST"){   
            $name = $this->Validator->isValidString($this->request->getParam("name"));
            $email = $this->Validator->isValidEmail($this->request->getParam("email"));
            $password = $this->Validator->isValidString($this->request->getParam("password"));

            // user men db
            $user = false;

            if($user){
                $this->response->header("/auth/register");
            }

            if(!$password){
                $this->response->header("/auth/register");
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $this->response->header("/");
        }
    }

    public function registerAvocat() {
            // itra traitment dyal request fach tji post request
            $name = $this->Validator->isValidString($this->request->getParam("name"));
            $email = $this->Validator->isValidEmail($this->request->getParam("email"));
            $password = $this->Validator->isValidString($this->request->getParam("password"));
            $consultationEnLign = $this->Validator->isValidString($this->request->getParam("consultation"));
            $experience = $this->Validator->isValidString($this->request->getParam("experience"));
            $specialite = $this->Validator->isValidString($this->request->getParam("specialite"));
            
            // user men db
            $user = true;

            if(!$user){
                $this->response->header("/auth/register");
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
           // $this->session->setUserId($user->getId());
            $this->response->header("/");
    }
    
    public function registerHuissier() {
            // itra traitment dyal request fach tji post request
            $name = $this->Validator->isValidString($this->request->getParam("name"));
            $email = $this->Validator->isValidEmail($this->request->getParam("email"));
            $password = $this->Validator->isValidString($this->request->getParam("password"));
            $typesActes = $this->Validator->isValidString($this->request->getParam("actes"));
            $experience = $this->Validator->isValidString($this->request->getParam("experience"));

            // user men db
            $user = true;

            if(!$user){
                $this->response->header("/auth/register");
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // $this->session->setUserId($user->getId());
            $this->response->header("/");
    }

    public function logout(){
        $this->session->clearUser();
        $this->response->header("/");
    }
}