<?php

namespace App\Controller\admin;

use App\Helper\Response;
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
   private Response $response;


   public function __construct()
   {
      $this->view = new View();
      $this->repoStatistique = new StatistiqueRepository();
      $this->AvocatRepository = new AvocatRepository();
      $this->HuissiersRepository = new HuissiersRepository();
      $this->UserRepository = new UserRepository();
      $this->response = new Response();
   }
   public function index()
   {
      $totalavocat = $this->repoStatistique->totalProfessionnels('avocat');
      $totalhuissier = $this->repoStatistique->totalProfessionnels('huissier');
      $totalPparville =  $this->repoStatistique->professionnelsParVille();
      $topAvocat =  $this->repoStatistique->topAvocat();

      $Inactifavocat = $this->AvocatRepository->Inactif();
      $InactifHuissier = $this->HuissiersRepository->Inactif();
      $InactifProfessionnlle = [];
      //  var_dump($Inactifavocat);
      //  var_dump($InactifHuissier);
      foreach (array_merge($Inactifavocat, $InactifHuissier) as $professionnlle) {
         if ($professionnlle['role'] === "avocat") {

            $avocat = new Avocat();
            $avocat->hydrate($professionnlle);
            array_push($InactifProfessionnlle, $avocat);
         }
         if ($professionnlle['role'] === "huissier") {

            $huissier = new Huissiers();
            $huissier->hydrate($professionnlle);
            array_push($InactifProfessionnlle, $huissier);
         }
      }
      shuffle($InactifProfessionnlle);


      $this->view->render('admin_dashboard.php', [
         'topAvocat' =>  $topAvocat,
         'InactifProfessionnlle' =>  $InactifProfessionnlle,
         'totalPparville' =>  $totalPparville,
         'totalavocat' =>  $totalavocat,
         'totalhuissier' =>  $totalhuissier
      ]);
   }

   public function verifyAccountDetails(int $user_id)
   {

      $pro = $this->UserRepository->findByUserId($user_id);
      if (!$pro) $this->response->header('dashboard');
      if (!in_array($pro['role'], ['avocat', 'huissier'])) $this->response->header('dashboard');

      $professionnlle = [];
      if ($pro['role'] === "avocat") {

         $avocat = new Avocat();
         $avocat->hydrate($pro);
         array_push($professionnlle, $avocat);
      }
      if ($pro['role'] === "huissier") {

         $huissier = new Huissiers();
         $huissier->hydrate($pro);
         array_push($professionnlle, $huissier);
      }
      // var_dump($professionnlle[0]->getDocument()['document']);
      $this->view->render('verifyAccount_details.php', ['professionnlle' => $professionnlle]);
   }

   public function validateAccount(int $user_id)
   {
     
      $pro = $this->UserRepository->findByUserId($user_id);
      $data['statut'] = "actif";
      $data['id'] = $user_id;

      if ($pro['role'] === "avocat") {

         $this->AvocatRepository->updateOne($data);
         $this->response->header('../dashboard');
      }

      if ($pro['role'] === "huissier") {

         $this->HuissiersRepository->updateOne($data);
         $this->response->header('../dashboard');
      }
   }

   public function rejectAccount(int $user_id)
   {
      $pro = $this->UserRepository->findByUserId($user_id);
      $data['statut'] = "refuse";
      $data['id'] = $user_id;

      if ($pro['role'] === "avocat") {
         
         $this->AvocatRepository->updateOne($data);
         $this->response->header('../dashboard');
      }

      if ($pro['role'] === "huissier") {
         
         $this->HuissiersRepository->updateOne($data);
         $this->response->header('../dashboard');
      }
   }
}
