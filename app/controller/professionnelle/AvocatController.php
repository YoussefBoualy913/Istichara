<?php

namespace App\Controller\Professionnelle;

use App\Helper\Response;
use App\Helper\View;
use App\Models\Avocat;
use App\Repository\AvocatRepository;

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
}