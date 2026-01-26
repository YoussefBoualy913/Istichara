<?php
namespace App\Controller;

use App\Helper\Session;
use App\Helper\View;
use App\models\Demande;
use App\Models\User;
use App\Repository\DemandRepository;
use App\Repository\UserRepository;

class ControllerVisiteur {
    private UserRepository  $userRepo;
    private Session  $session;
    private DemandRepository $demandRepo;

    public function __construct() {
        $this->userRepo = new UserRepository();
        $this->session = new Session();
        $this->demandRepo = new DemandRepository();
    }

    public function index(){
        View::render('visiteur.php');
    }
        
    public function register(){
        View::render('register.php');
    }

    public function profile(){
        $client = new User();
        $userId = (int) $this->session->getUser()['id'];
        $data = $this->demandRepo->findByUserId($userId);
        $total = count($data);
        $demands =[];

        foreach($data as $d){
            $demand = new Demande();
            $demand->hydrate($d);
            $demands[]= $demand;
        }

        $approved = $this->demandRepo->getUserDemandAproved($userId);
        $denied = $this->demandRepo->getUserDemandStatsDenied($userId);
        $client->hydrate($this->userRepo->findByUserId($userId));
        $vars = ["client" => $client, "total" => $total, "approved" => $approved, "denied" => $denied, "demands" => $demands];
        View::render('cleintProfile.php', $vars);
    }
}