<?php
namespace App\Controller;
use  App\Models\Avocat;
use App\Repository\AvocatRepository;
class ControllerAddAvocat{

     public function show():void{
        require_once(__DIR__.'/../../src/views/form_add_personnes.php');
     }

      public function addavocat(){
        $data = [];
        $repoavocat = new AvocatRepository();
        
        $data['nom'] = $_POST['nom'];
        $data['email'] = $_POST['email'];
        $data['ville'] = $_POST['ville'];
        $data['years_of_experience'] = $_POST['years_of_experience'];
        $data['specialite'] = $_POST['specialite'];
        $data['consoltation_en_ligne'] = $_POST['consoltation_en_ligne'];
        
        $repoavocat->create($data,'avocat');
       
     }
}