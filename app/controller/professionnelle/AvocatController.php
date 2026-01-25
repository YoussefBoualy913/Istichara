<?php

namespace App\Controller\Professionnelle;

use App\Helper\Response;
use App\Helper\View;
use App\Models\Avocat;
use App\Repository\AvocatRepository;
use DateTime;

class AvocatController{
    private AvocatRepository $avocatRepo;
    private Response $response;

    public function __construct() {
        $this->avocatRepo = new AvocatRepository();
        $this->response = new Response();
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
        $data =[];
        $start = new DateTime('next monday');
        foreach($_POST['horaires'] as $jour =>$creneaux ){

             $data[$start->format('Y-m-d')][$jour] = $creneaux;
          
             $start->modify('+1 day');
            
         
        }
      
    }
    
}