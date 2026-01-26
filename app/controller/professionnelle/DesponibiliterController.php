<?php

namespace App\Controller\Professionnelle;

use App\Helper\Response;
use App\Helper\session;
use App\Helper\View;
use App\Models\Avocat;
use App\Repository\AvocatRepository;
use App\Repository\DesponibiliteRepository;
use App\Helper\Database;
use DateTime;
use PDO;

class DesponibiliterController{
    private AvocatRepository $avocatRepo;
    private Response $response;
    private session $session;
    private DesponibiliteRepository $dosponibleRepo;
    private PDO $pdo;

    public function __construct() {
        $this->avocatRepo = new AvocatRepository();
        $this->response = new Response();
        $this->dosponibleRepo = new DesponibiliteRepository();
        $this->session = new session();
        $this->pdo = Database::getConnexion();

    }

   
 public function configDisponibilite()
    {

    View::render("configuration-disponibilite.php");
    }

    public function storeDisponibilite()
    {

         $start = (new DateTime('next monday'))->format('Y-m-d');

         $stmt = $this->pdo->prepare("
         SELECT 1
         FROM disponible
         WHERE jsonb_exists(disponible, :date)
         LIMIT 1
        ");

      $stmt->execute([
        ':date' => $start
       ]);

      $exists = $stmt->fetchColumn();
      if (!$exists) {
        $dispo =[];
        $start = new DateTime('next monday');
    
        foreach($_POST['horaires'] as $jour =>$creneaux ){

             $dispo[$start->format('Y-m-d')][$jour] = $creneaux;
          
             $start->modify('+1 day');
            
        }
      $json = json_encode($dispo, JSON_UNESCAPED_UNICODE);
     $data['user_id'] = ($this->session->getUser())['id'];
     $data['disponible'] = $json;
      $this->dosponibleRepo->createDesponible($data);
     
       $this->response->header('professional/dashboard');
      }
      if($exists){
            $this->response->header('configDisponibilite');
            exit;
      }
    }
    
   
}