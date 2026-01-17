<?php
namespace App\Controller;
use App\Repository\StatistiqueRepository;
class ControllerAdminDachboard{

     public function show(){
        $repoStatistique = new StatistiqueRepository();
        $totalavocat = $repoStatistique->totalProfessionnels('avocat');
        $totalhuissier = $repoStatistique->totalProfessionnels('huissier');
        $totalPparville =  $repoStatistique->professionnelsParVille();
        $topAvocat =  $repoStatistique->topAvocat();
        require_once(__DIR__.'/../../src/views/admin_dashboard.php');
     }
}