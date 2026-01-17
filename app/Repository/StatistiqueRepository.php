<?php
namespace App\Repository;
use App\Helper\Database;
use PDO;

class StatistiqueRepository{
  
 private ?PDO $pdo ;

   public function __construct()
   {
     $this->pdo = Database::getConnexion();
   }
   
   public function  totalProfessionnels($tablename):int  {
      $stmt = $this->pdo->prepare("select count(*) as totalprofessionnels from  ".$tablename.";");
      $stmt->execute();
     return $stmt->fetchColumn();
   }
   
   public function  professionnelsParVille():array  {
      $stmt = $this->pdo->prepare("select ville.nom,count(a.id) as totalavocat,COUNT(h.id) as totalhuissier
      from ville  
      left JOIN avocat as a on a.ville_id = ville.id
      left JOIN huissier as h on h.ville_id = ville.id
      GROUP by ville.nom;");
      $stmt->execute();
      return $stmt->fetchAll();
      }
      
      
      public function  topAvocat():array  {
         $stmt = $this->pdo->prepare("select nom ,years_of_experience
                                      from  avocat
                                      ORDER BY years_of_experience DESC
                                      LIMIT 3 ;");
         $stmt->execute();
        return $stmt->fetchAll();
      }

   


   }