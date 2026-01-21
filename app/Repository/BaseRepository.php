<?php
namespace  App\Repository;

use App\Models\Avocat;
use App\Models\Huissiers;
use App\Helper\Database;
use App\Models\Professionnelle;
use App\Repository\RepositoryInterface\RepositoryInterface;
use PDO;

class BaseRepository implements  RepositoryInterface {
   protected PDO  $pdo;
   public function __construct( ){
    $this->pdo = Database::getConnexion();
   }
   
   public function getALL(string $tablename) :array {
     $stmt = $this->pdo->prepare("select p.*,vi.nom as villename from ".$tablename." as p join ville vi on p.ville_id = vi.id ");
     $stmt->execute();
     return  $stmt->fetchAll();
   }
   public function delete(string $tablename,int $id):void{
     $stmt = $this->pdo->prepare("delete  from ".$tablename." where id = ?");
     $stmt->execute([$id]);
    
   }

    public function findById(string $tablename,int $id):array{
     $stmt = $this->pdo->prepare("select p.*,vi.nom as villename from ".$tablename." as p join ville vi on p.ville_id = vi.id  where p.id = ?");
     $stmt->execute([$id]);
     return $stmt->fetch();
    
   }

    public function create(array $data,string $tablename):void {
    $keys = array_keys($data);
    $sql ="insert into ".$tablename."(".implode(',',$keys).") VALUES(:".implode(",:",$keys).")";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($data);
   }

   public function updete(Professionnelle $personnes):void {

    if($personnes instanceof Avocat){

      $stmt = $this->pdo->prepare("UPDATE avocat set `nom`= :nom ,`email`= :email,
      `years_of_experience`= :years_of_experience,specialite=:specialite ,consoltation_en_ligne=:consoltation_en_ligne where id =:id");
       $stmt->execute([
        ':nom' => $personnes->getNom(),
        ':email' => $personnes->getEmail(),
        ':years_of_experience' => $personnes->getYears_of_experience(),
        ':specialite' => $personnes->getspecialite(),
        ':consoltation_en_ligne' => $personnes->getConsoltation_en_ligne(),
        ':consoltation_en_ligne' => $personnes->getConsoltation_en_ligne(),
        ':id' => $personnes->getId(),
       ]);

    }
     if($personnes instanceof Huissiers ){

       $stmt = $this->pdo->prepare("UPDATE  huissier set `nom`= :nom ,`email`= :email,
       `years_of_experience`= :years_of_experience,types_actes=:types_actes where id =:id");
       $stmt->execute([
        ':nom' => $personnes->getNom(),
        ':email' => $personnes->getEmail(),
        ':years_of_experience' => $personnes->getYears_of_experience(),
        ':types_actes' => $personnes->getTypes_actes(),
        ':id' => $personnes->getId(),
       ]);

    }

   }

   


   }