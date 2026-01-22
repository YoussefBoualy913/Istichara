<?php
namespace App\Controller;

use App\Helper\View;
use App\Repository\AvocatRepository;
use App\Repository\HuissiersRepository;
use App\Repository\StatistiqueRepository;
use App\Repository\UserRepository;

class ControllerDachboard
{

   private View $view;
   private StatistiqueRepository $repoStatistique;
   private AvocatRepository $AvocatRepository;
   private HuissiersRepository $HuissiersRepository;
   private UserRepository $UserRepository;
  

   public function __construct()
   {
      $this->view = new View();
      $this->repoStatistique = new StatistiqueRepository();
      $this->AvocatRepository = new AvocatRepository();
      $this->HuissiersRepository = new HuissiersRepository();
      $this->UserRepository = new UserRepository();
   }
     public function index(){
        $totalavocat = $this->repoStatistique->totalProfessionnels('avocat');
        $totalhuissier = $this->repoStatistique->totalProfessionnels('huissier');
        $totalPparville =  $this->repoStatistique->professionnelsParVille();
        $topAvocat =  $this->repoStatistique->topAvocat();
    
        $Inactifavocat = $this->AvocatRepository-> Inactif();
        $InactifHuissier = $this->HuissiersRepository-> Inactif();
        $InactifProfessionnlle = array_merge($Inactifavocat, $InactifHuissier);
         // var_dump($InactifProfessionnlle);
          $this->view->render('admin_dashboard.php',['topAvocat' =>  $topAvocat,'InactifProfessionnlle' =>  $InactifProfessionnlle,
          'totalPparville' =>  $totalPparville,'totalavocat' =>  $totalavocat,'totalhuissier' =>  $totalhuissier]);
       
     }

      public function verifyAccountDetails(){
       
       $professionnlle = $this->UserRepository->findByUserId($_GET['user_id']);
      

      }
}