<?php
namespace App\Controller;
use App\Repository\HuissiersRepository;
use  App\Models\Huissiers;
class ControllerHuissiers{

     public function index(){
     $repoHuissiers = new HuissiersRepository();
     $result = $repoHuissiers->getALL('Huissier');
        require_once(__DIR__.'/../../src/views/Huissiers.php');
     }

      public function create():void{
        require_once(__DIR__.'/../../src/views/form_add_personnes.php');
     }

      public function store(){
        $data = [];
        $repoHuissiers = new HuissiersRepository();
        
        $data['nom'] = $_POST['nom'];
        $data['email'] = $_POST['email'];
        $data['ville'] = $_POST['ville'];
        $data['years_of_experience'] = $_POST['years_of_experience'];
        $data['types_actes'] = $_POST['types_actes'];
       
        
        $repoHuissiers->create($data,'Huissier');
     
        header('location:../Huissiers');
        exit;
       
     }

      public function edit():void{
       $repoHuissiers = new HuissiersRepository();
     $result = $repoHuissiers->findById('Huissier',$_GET['Huissiers_id']);
      require_once(__DIR__.'/../../src/views/form_updete_Huissiers.php');
     }

      public function update(){
        $Huissiers = new Huissiers();
        $repoHuissiers = new HuissiersRepository();
      
       
        $Huissiers->setId($_GET['Huissiers_id']);
        $Huissiers->setNom($_POST['nom']);
        $Huissiers->setEmail($_POST['email']);
        $Huissiers->setVille($_POST['ville']);
        $Huissiers->setVille_id($_POST['ville_id']);
        $Huissiers->setTypes_actes($_POST['types_actes']);
        $Huissiers->setYears_of_experience($_POST['years_of_experience']);
        

        $repoHuissiers->updete($Huissiers);
       header('location:../Huissiers');
        exit;
     }

      public function destroy(){
       $repoHuissiers = new HuissiersRepository();
   //   echo $_GET['Huissiers_id'];
       $repoHuissiers->delete('Huissier',$_GET['Huissiers_id']);
       header('location:../Huissiers');
        exit;
     }
}