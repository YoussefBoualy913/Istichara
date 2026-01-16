<?php
namespace App\Controller;
use  App\Models\Avocat;
use App\Repository\AvocatRepository;
class ControllerAddAvocat{

     public function show():void{
        require_once(__DIR__.'/../../src/views/form_add_personnes.php');
     }

      public function addavocat(){
        $avocat = new Avocat();
        $repoavocat = new AvocatRepository();
       
        $avocat->setId($_GET['avocat_id']);
        $avocat->setNom($_GET['nom']);
        $avocat->setEmail($_GET['email']);
        $avocat->setVille($_GET['ville']);
        $avocat->setSpecialite($_GET['specialite']);
        $avocat->setYears_of_experience($_GET['years_of_experience']);
        $avocat->setConsoltation_en_ligne($_GET['consoltation_en_ligne']);

        $repoavocat->updete($avocat);
       header('location :../avocats');
        exit;
     }
    
}