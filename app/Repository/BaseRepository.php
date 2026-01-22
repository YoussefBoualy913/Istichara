<?php
namespace  App\Repository;

use App\Helper\Database;
use PDO;

class BaseRepository {
  protected PDO  $pdo;
  protected static string $tableName;

  public function __construct(){
    $this->pdo = Database::getConnexion();
  }
   
  public function getALL() :array | bool {
    $stmt = $this->pdo->prepare("select p.*, u.*, v.name AS ville_name FROM " . static::$tableName .  " p JOIN ville v ON v.id = p.ville_id JOIN users u ON u.id = p.user_id");
    $stmt->execute();
    return $stmt->fetchAll();
  }
  
  public function findByUserId(int $id): array | null{
      $stmt = $this->pdo->prepare("select * FROM users where id = :id");
      $stmt->execute(["id" => $id]);
      $userData = $stmt->fetch();

      if(!$userData) return null;
      if(in_array($userData['role'], ["admin", "client"]) && static::$tableName !== "users") return null;
      if(in_array($userData['role'], ["admin", "client"]) && static::$tableName === "users") return $userData;

      $stmt = $this->pdo->prepare("select p.id AS professionelle_id, p.*, u.*, v.id AS ville_id, v.name AS ville_name from ". $userData['role'] ." p JOIN ville v on p.ville_id = v.id JOIN users u ON u.id = p.user_id where p.user_id = :id");
      $stmt->execute(["id" => $id]);
      $professionelleData =  $stmt->fetch();
      if(!$professionelleData) return null;
      return [...$professionelleData, ...$userData];
  }
   
  public function createOne(array $data){
     $keys = array_keys($data);
     $sql ="insert into " . static::$tableName ." (".implode(', ',$keys).") VALUES(:".implode(", :",$keys).")";
     $stm = $this->pdo->prepare($sql);
     return $stm->execute($data);
  }
     
  public function updateOne(array $data){
      $keys = array_keys($data);
      $placeholder = [];
      foreach($keys as $key){
        $placeholder[] = "$key = :$key";
      }
        
      $sql = "UPDATE " .static::$tableName . " SET " . implode(", ", $placeholder) . " WHERE id = :id";
      $stm = $this->pdo->prepare($sql);
      $stm->execute($data);
  }
}