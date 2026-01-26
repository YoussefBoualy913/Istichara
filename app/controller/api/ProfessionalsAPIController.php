<?php

namespace App\Controller\Api;

use App\Helper\Request;
use App\Helper\Validator;
use App\Repository\AvocatRepository;
use App\Repository\HuissiersRepository;

class ProfessionalsAPIController {
    private AvocatRepository $avocatRepo;
    private HuissiersRepository $huissierRepo;
    private Request $request;
    private Validator $validator;

    public function __construct() {
        $this->huissierRepo = new HuissiersRepository();
        $this->avocatRepo = new AvocatRepository();
        $this->request = new Request();
        $this->validator = new Validator();
    }

    public  function getProfessionals(){
        header('Content-Type: application/json; charset=utf-8');
        $type = $this->validator->isValidString($this->request->getQuery("type"));
        $ville = $this->validator->isValidNumber($this->request->getQuery("ville"));
        $search = $this->validator->isValidString($this->request->getQuery("search"));
        $experience = $this->validator->isValidNumber($this->request->getQuery("experience"));
        $page = $this->validator->isValidNumber($this->request->getQuery("page") ?? 1);

        $offset = ($page - 1) * 10;

        $huissier = [];
        $avocats = [];
        $profetionals = [];


        if(!$type || $type === 'huissier') $huissier = $this->huissierRepo->searchHuisser($search, $ville, $experience, $offset);
        if(!$type || $type === 'avocat') $avocats = $this->avocatRepo->searchAvocats($search, $ville, $experience, $offset);

        $profetionals = [...$huissier, ...$avocats];
        echo json_encode([ 'success' => true, 'count'  => count($profetionals), 'data'  => $profetionals]);
    }
}