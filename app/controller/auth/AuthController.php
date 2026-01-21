<?php

namespace App\Controller\Auth;

use App\Helper\FileUploader;
use App\Helper\Request;
use App\Helper\Response;
use App\Helper\Session;
use App\Helper\Validator;
use App\Helper\View;
use App\models\Client;
use App\Repository\AvocatRepository;
use App\Repository\HuissiersRepository;
use App\Repository\UserRepository;

class AuthController {
    private Request $request;
    private Response $response;
    private View $view;
    private Session $session;
    private Validator $Validator;
    private UserRepository $userRepo;
    private FileUploader $fileUploader;
    private HuissiersRepository $huissierRepo;
    private AvocatRepository $avocatRepo;

    public function __construct() {
        $this->request = new Request();
        $this->response = new Response();
        $this->view = new View();
        $this->session = new Session();
        $this->Validator = new Validator();
        $this->userRepo = new UserRepository();
        $this->fileUploader = new FileUploader(__DIR__ . "../../../../public/assets/documents");
        $this->huissierRepo = new HuissiersRepository();
        $this->avocatRepo= new AvocatRepository();
    }

    public function login() {
        if($this->session->getUserId()) $this->response->header("/");

        $email = $this->Validator->isValidEmail($this->request->getParam("user-email"));
        $password = $this->Validator->isValidString($this->request->getParam("password"));
        
        $user  = $this->userRepo->findByEmail($email);
        if(!$user) $this->response->header("/auth/register");
        
        $ispasswordValid = $this->Validator->isValidPassword($password, $user['password']);
        if(!$ispasswordValid) $this->response->header("/auth/login");

        $this->session->setUserId((int) $user['id']);
        $this->response->header("/");
    }
    
    public function registerClient() {
        if($this->session->getUserId()) $this->response->header("/");

        $name = $this->Validator->isValidString($this->request->getParam("name"));
        $email = $this->Validator->isValidEmail($this->request->getParam("email"));
        $password = $this->Validator->isValidString($this->request->getParam("password"));

        $user = $this->userRepo->findByEmail($email);
        if($user) $this->response->header("/auth/register");

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $data = ["name" => $name, "email" => $email, "password" => $hashedPassword, "role" => "client"];

        $status = $this->userRepo->createOne($data);
        if(!$status) $this->response->header("/error");

        $user = $this->userRepo->findByEmail($email);
        $this->session->setUserId($user['id']);
        $this->response->header("/");
    }

    public function registerAvocat() {
        if($this->session->getUserId()) $this->response->header("/");
        var_dump($this->session->getUserId());
            
        $name = $this->Validator->isValidString($this->request->getParam("name"));
        $email = $this->Validator->isValidEmail($this->request->getParam("email"));
        $password = $this->Validator->isValidString($this->request->getParam("password"));
        $ville = 1;
        $consultationEnLign = $this->Validator->isValidString($this->request->getParam("consultation"));
        $experience = $this->Validator->isValidString($this->request->getParam("experience"));
        $specialite = $this->Validator->isValidString($this->request->getParam("specialite"));

        if(!$email || !$name || !$password || !$experience || !$specialite) $this->response->header('/register');

        $user = $this->userRepo->findByEmail($email);
        if($user) $this->response->header("/register");


        $documents = [];
        foreach ($_FILES as $key => $file){
            $stored = $this->fileUploader->store($file);
            $documents[$key] = $stored;
        }

          
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $userData = ['name' =>$name, "email" => $email, "password" => $hashedPassword, "role" => "avocat"];
        $huissierData = ["ville_id" => $ville, "years_of_experience" => (int) $experience, "document" => json_encode($documents), "consultation_en_ligne" => true, "specialite" => $specialite, "statut" => "inactif"];
        
        $res = $this->userRepo->createOne($userData);
        if(!$res) $this->response->header('/register');

        $user = $this->userRepo->findByEmail($email);
        if(!$user) $this->response->header('/register');

        $res = $this->avocatRepo->createOne([...$huissierData, "user_id" => $user['id']]);
        if(!$res) $this->response->header('/register');

        $this->session->setUserId($user["id"]);
        $this->response->header("/");
    }
    
    public function registerHuissier() {
        if($this->session->getUserId()) $this->response->header("/");
       
        $name = $this->Validator->isValidString($this->request->getParam("name"));
        $email = $this->Validator->isValidEmail($this->request->getParam("email"));
        $password = $this->Validator->isValidString($this->request->getParam("password"));
        $experience = $this->Validator->isValidString($this->request->getParam("experience"));
        $ville = 3;
        $typeActes = $this->Validator->isValidString($this->request->getParam("typeActes"));


        if(!$email || !$name || !$password || !$experience || !$typeActes) $this->response->header('/register');

        $user = $this->userRepo->findByEmail($email);
        if($user) $this->response->header("/register");

        $documents = [];
        foreach ($_FILES as $key => $file){
            $stored = $this->fileUploader->store($file);
            if ($stored === null) $this->response->header('/register');
            $documents[$key] = $stored;
        }
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $userData = ['name' =>$name, "email" => $email, "password" => $hashedPassword, "role" => "huissier"];
        $huissierData = ["ville_id" => $ville, "years_of_experience" => (int) $experience, "document" => json_encode($documents), "types_actes" => $typeActes, "statut" => "inactif"];
        
        $res = $this->userRepo->createOne($userData);
        $user = $this->userRepo->findByEmail($email);
        if(!$user) $this->response->header('/register');

        $res = $this->huissierRepo->createOne([...$huissierData, "user_id" => $user['id']]);
        if(!$res) $this->response->header('/register');

        $this->session->setUserId($user["id"]);
        $this->response->header("/");
    }

    public function logout(){
        $this->session->clearUser();
        $this->response->header("/");
    }
}