<?php
namespace App\Controller;

use App\Helper\View;
use App\Repository\AvocatRepository;
use App\Repository\HuissiersRepository;
use App\Repository\StatistiqueRepository;
class ControllerDachboard{

   private View $view;

   public function __construct()
   {
      $this->view = new View();
   }
     public function index(){
        $repoStatistique = new StatistiqueRepository();
        $totalavocat = $repoStatistique->totalProfessionnels('avocat');
        $totalhuissier = $repoStatistique->totalProfessionnels('huissier');
        $totalPparville =  $repoStatistique->professionnelsParVille();
        $topAvocat =  $repoStatistique->topAvocat();
      
        $AvocatRepository = new AvocatRepository();
        $HuissiersRepository = new HuissiersRepository();
        $Inactifavocat = $AvocatRepository-> Inactif();
        $InactifHuissier = $HuissiersRepository-> Inactif();
        $InactifProfessionnlle = array_merge($Inactifavocat, $InactifHuissier);

          $this->view->render('admin_dashboard.php',['InactifProfessionnlle' =>  $InactifProfessionnlle,'totalavocat'=> $totalavocat,
            'totalhuissier' =>  $totalhuissier,'totalPparville' =>  $totalPparville,'topAvocat' =>  $topAvocat,]);
       
     }
}