<?php
namespace App\Controller;
use  App\Models\Avocat;
use App\Repository\AvocatRepository;
use App\Repository\UserRepository;

class ControllerAvocats{

     public function index(){
     $repoavocat = new AvocatRepository();
     $result = $repoavocat->getALL('avocat');
        require_once(__DIR__.'/../../src/views/avocats.php');
     }

      public function create():void{
        require_once(__DIR__.'/../../src/views/form_add_personnes.php');
     }

      public function store(){
        $data = [];
        $repoavocat = new AvocatRepository();
        
        $data['nom'] = $_POST['nom'];
        $data['email'] = $_POST['email'];
        $data['ville_id'] = $_POST['ville_id'];
        $data['years_of_experience'] = $_POST['years_of_experience'];
        $data['specialite'] = $_POST['specialite'];
        $data['consoltation_en_ligne'] = $_POST['consoltation_en_ligne'];
        
        $repoavocat->create($data);
     
        header('location:../avocats');
        exit;
       
     }

      public function edit():void{
       $repoavocat = new AvocatRepository();
     $result = $repoavocat->findById('avocat',$_GET['avocat_id']);
      require_once(__DIR__.'/../../src/views/form_updete_avocat.php');
     }

      public function update(){
        $avocat = new Avocat();
        $repoavocat = new AvocatRepository();
        var_dump($_POST['ville_id']);
       
        $avocat->setId($_GET['avocat_id']);
        $avocat->setName($_POST['nom']);
        $avocat->setEmail($_POST['email']);
        $avocat->setVille_id($_POST['ville_id']);
        $avocat->setSpecialite($_POST['specialite']);
        $avocat->setYears_of_experience($_POST['years_of_experience']);
        $avocat->setConsoltation_en_ligne($_POST['consoltation_en_ligne']);

      //   $repoavocat->update($avocat);
       header('location:../avocats');
        exit;
     }

      public function destroy(){
       $repoRepository = new UserRepository();
     
       $repoRepository->delete($_GET['avocat_id']);
       header('location:../avocats');
        exit;
     }
}