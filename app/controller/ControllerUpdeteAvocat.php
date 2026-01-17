<?php
namespace App\Controller;
use  App\Models\Avocat;
use App\Repository\AvocatRepository;
class ControllerUpdeteAvocat{

     public function show():void{
       $repoavocat = new AvocatRepository();
     $result = $repoavocat->findById('avocat',$_GET['avocat_id']);
      require_once(__DIR__.'/../../src/views/form_updete_avocat.php');
     }

      public function updeteavocat(){
        $avocat = new Avocat();
        $repoavocat = new AvocatRepository();
       var_dump($_POST['ville_id']);
       
        $avocat->setId($_GET['avocat_id']);
        $avocat->setNom($_POST['nom']);
        $avocat->setEmail($_POST['email']);
        $avocat->setVille($_POST['ville']);
        $avocat->setVille_id($_POST['ville_id']);
        $avocat->setSpecialite($_POST['specialite']);
        $avocat->setYears_of_experience($_POST['years_of_experience']);
        $avocat->setConsoltation_en_ligne($_POST['consoltation_en_ligne']);

        $repoavocat->updete($avocat);
       header('location:./avocats');
        exit;
     }
    
}