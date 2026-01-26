<?php
namespace App\Controller\Admin;

use App\Helper\Response;
use App\Helper\View;
use  App\Models\Avocat;
use App\Repository\AvocatRepository;
use App\Repository\UserRepository;

class ControllerAvocats
{
   private View $view;
   private AvocatRepository $AvocatRepository;
   private UserRepository $UserRepository;
   private Response $response;
   private UserRepository $repoRepository;
  
   
   public function __construct()
   {
     $this->view = new View();
     $this->response = new Response();
     $this->AvocatRepository = new AvocatRepository();
     $this->repoRepository = new UserRepository();
     }
     
     public function index(){
        $result = $this->AvocatRepository->getALL();
        $data =[];
      //   var_dump($result);
        foreach($result as $item){
        $avocat = new Avocat();
        $avocat->hydrate($item);
        array_push($data,$avocat);

     }
    
      $this->view->render('avocats.php',['data'=> $data]);
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

      public function destroy(int $id){
       
     $this->repoRepository->delete($id);
     $this->response->header('/../avocats');
       
     }
}