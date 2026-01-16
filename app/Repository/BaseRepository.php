<?php
namespace  App\Repository;

use App\Models\Avocat;
use App\Models\Huissiers;
use App\Models\Personnes;
use App\Helper\Database;
use App\Repository\RepositoryInterface\RepositoryInterface;
use PDO;

class BaseRepository implements  RepositoryInterface {
   protected PDO  $pdo;
   public function __construct( ){
    $this->pdo = Database::getConnexion();
   }
   
   public function getALL(string $tablename) :array {
     $stmt = $this->pdo->prepare("select * from".$tablename."");
     $stmt->execute();
     return  $stmt->fetchAll();
   }
   public function delete(string $tablename,int $id):void{
     $stmt = $this->pdo->prepare("dellete * from".$tablename."where id =?");
     $stmt->execute([$id]);
    
   }

    public function findById(string $tablename,int $id):void{
     $stmt = $this->pdo->prepare("select  * from".$tablename."where id =?");
     $stmt->execute([$id]);
     $stmt->fetch();
    
   }

    public function create(array $data,string $tablename):void {
    $stmt = $this->pdo->prepare("insert into ville(`nom`) VALUES(?)");
     $stmt->execute([$data['ville']]);
     $data['ville_id'] = $this->pdo->lastInsertId();
     unset($data['ville']);

    $keys = array_keys($data);
    $sql ="insert into ".$tablename."(".implode(',',$keys).") VALUES(:".implode(",:",$keys).")";
    $stmt = $this->pdo->prepare($sql);

     foreach($data as $keys =>$valus ){
          
          $data[":".$keys]= $data[$keys] ;
         unset($data[$keys]);  
          
           }
    $stmt->execute($data);
   

   }

   public function updete(Personnes $personnes):void {

    if($personnes instanceof Avocat){
      
   $stmt = $this->pdo->prepare("updete from Avocat set `nom`= :nom ,`email`= :email `ville_id`= :ville_id,
   `years_of_experience`= :years_of_experience,specialite=:specialite ,consoltation_en_ligne=:consoltation_en_ligne where id =:id");
       $stmt->execute([
        ':nom' => $personnes->getNom(),
        ':email' => $personnes->getEmail(),
        ':ville_id' => $personnes->getVille_id(),
        ':years_of_experience' => $personnes->getYears_of_experience(),
        ':specialite' => $personnes->getspecialite(),
        ':consoltation_en_ligne' => $personnes->getConsoltation_en_ligne(),
        ':consoltation_en_ligne' => $personnes->getConsoltation_en_ligne(),
        ':id' => $personnes->getId(),
       ]);

    }
     if($personnes instanceof Huissiers ){
       $stmt = $this->pdo->prepare("updete from huissier set `nom`= :nom ,`email`= :email `ville_id`= :ville_id,
       `years_of_experience`= :years_of_experience,types_actes=:types_actes where id =:id");
       $stmt->execute([
        ':nom' => $personnes->getNom(),
        ':email' => $personnes->getEmail(),
        ':ville_id' => $personnes->getVille_id(),
        ':years_of_experience' => $personnes->getYears_of_experience(),
        ':types_actes' => $personnes->getTypes_actes(),
        ':id' => $personnes->getId(),
       ]);

    }

   }

   


   }