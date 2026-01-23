<?php
namespace App\Controller;

use App\Helper\View;
use App\Models\Avocat;
use App\Models\Huissiers;
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
        $InactifProfessionnlle = [];
      //  var_dump($Inactifavocat);
      //  var_dump($InactifHuissier);
        foreach(array_merge($Inactifavocat, $InactifHuissier) as $professionnlle){
         if($professionnlle['role'] === "avocat" ){
           
            $avocat = new Avocat();
            $avocat->hydrate($professionnlle); 
            array_push($InactifProfessionnlle , $avocat); 
          
         }
         if($professionnlle['role'] === "huissier" ){
                    
            $huissier = new Huissiers();
            $huissier->hydrate($professionnlle); 
            array_push($InactifProfessionnlle , $huissier); 
         }
        }
         shuffle($InactifProfessionnlle);
       

          $this->view->render('admin_dashboard.php',['topAvocat' =>  $topAvocat,'InactifProfessionnlle' =>  $InactifProfessionnlle,
          'totalPparville' =>  $totalPparville,'totalavocat' =>  $totalavocat,'totalhuissier' =>  $totalhuissier]);
       
     }

      public function verifyAccountDetails(){
      
       $pro = $this->UserRepository->findByUserId($_GET['user_id']);
       $professionnlle =[];
       if($pro['role'] === "avocat" ){
           
            $avocat = new Avocat();
            $avocat->hydrate($pro); 
            array_push($professionnlle , $avocat); 
          
         }
         if($pro['role'] === "huissier" ){
                    
            $huissier = new Huissiers();
            $huissier->hydrate($pro); 
            array_push($professionnlle , $huissier); 
         }
      
      
        $this->view->render('verifyAccount_details.php',['professionnlle' =>$professionnlle]);
      }
}