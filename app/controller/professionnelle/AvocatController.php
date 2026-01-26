<?php

namespace App\Controller\Professionnelle;

use App\Helper\Response;
use App\Helper\View;
use App\Models\Avocat;
use App\Repository\AvocatRepository;
use App\Repository\DesponibiliteRepository;
use DateTime;

class AvocatController{
    private AvocatRepository $avocatRepo;
    private Response $response;
    private DesponibiliteRepository $dosponibleRepo;

    public function __construct() {
        $this->avocatRepo = new AvocatRepository();
        $this->response = new Response();
        $this->dosponibleRepo = new DesponibiliteRepository();
    }

    public function profile(int $id){
        $avocat = new Avocat();
        $data = $this->avocatRepo->findByUserId($id);
        if(strtoupper($data['role']) !== "AVOCAT") $this->response->header("/"); 
        $avocat->hydrate($data);
        View::render("AvocatProfile.php", ["avocat" => $avocat]);
    }

    public function configDisponibilite()
    {
         View::render("configuration-disponibilite.php",);
    }

    public function storeDisponibilite()
    {
        $dispo =[];
        $start = new DateTime('next monday');
        foreach($_POST['horaires'] as $jour =>$creneaux ){

             $dispo[$start->format('Y-m-d')][$jour] = $creneaux;
          
             $start->modify('+1 day');
            
        }
      $json = json_encode($dispo, JSON_UNESCAPED_UNICODE);
     

    }
    
}