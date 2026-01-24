<?php

namespace App\Controller\Professionnelle;

use App\Helper\Response;
use App\Helper\View;
use App\Models\Huissiers;
use App\Repository\HuissiersRepository;

class HuissierController{
    private HuissiersRepository $huissierRepo;
    private Response $response;

    public function __construct() {
        $this->huissierRepo = new HuissiersRepository();
        $this->response= new Response();
    }


    public function profile(int $id){
        $huissier = new Huissiers();
        $data = $this->huissierRepo->findByUserId($id);
        if(strtoupper($data['role']) !== "HUISSIER") $this->response->header("/"); 
        $huissier->hydrate($data);
        View::render("huissierProfile.php", ["huissier" => $huissier]);
    }
}