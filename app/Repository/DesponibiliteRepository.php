<?php

namespace App\Repository;
use App\Helper\Database;
use PDO;

class DesponibiliteRepository {
    private string $tableName ="disponible";
    protected PDO $pdo;

    public function __construct(){
        $this->pdo = Database::getConnexion();
    }
     
    public function createDesponible(array $data){
     $keys = array_keys($data);
     $sql ="insert into " . static::$tableName ." (".implode(', ',$keys).") VALUES(:".implode(", :",$keys).")";
     $stm = $this->pdo->prepare($sql);
     return $stm->execute($data);
  }
   
   
}