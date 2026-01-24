<?php

namespace App\Controller\Professionnelle;

use App\Helper\View;
use App\Repository\AvocatRepository;

class AvocatController{
    private AvocatRepository $avocatRepo;

    public function __construct() {
        $this->avocatRepo = new AvocatRepository();
    }

    public function profile(int $id){
        $avocat = $this->avocatRepo->findByUserId($id);
        View::render("huissierProfile.php", ["avocat", $avocat]);
    }
}