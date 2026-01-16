<?php
namespace App\Controller;
use App\Repository\AvocatRepository;
class ControllerAdminAvocats{

     public function show(){
     $repoavocat = new AvocatRepository();
     $result = $repoavocat->getALL('avocat');
    

        require_once(__DIR__.'/../../src/views/avocats.php');
     }
}