<?php

namespace App\Controller\Professionnelle;

use App\Helper\View;

class AvocatController{
    
    public function profile(){
        View::render("huissierProfile.php");
    }
}