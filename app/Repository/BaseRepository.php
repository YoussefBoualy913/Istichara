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

  public function findById(int $id): array | bool {
      $stmt = $this->pdo->prepare("select p.*, u.*, v.name as ville_name FROM ".static::$tableName." p JOIN ville v on p.ville_id = v.id JOIN users u ON u.id = p.user_id where p.id = :id");
      $stmt->execute(["id" => $id]);
      return $stmt->fetch();
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
         
  // public function update(array $user, array $pro = []): bool {
  //   $userId = $user['id'];
  //   unset($user['id']);
  //   try{
  //       $this->pdo->beginTransaction();

  //       $keys = array_keys($user);
  //       $placeholder = [];
  //       foreach($keys as $key){
  //         $placeholder[] = "$key = :$key";
  //       }

  //       $sql = "UPDATE users SET " . implode(", ", $placeholder) . " WHERE id = :id";
  //       $stm = $this->pdo->prepare($sql);
  //       $stm->execute([...$user, "id" => $userId]);

  //       if(!$pro) {
  //         $this->pdo->commit();
  //         return true;
  //       };

  //       $keys = array_keys($pro);
  //       $placeholder = [];
  //       foreach($keys as $key){
  //         $placeholder[] = "$key = :$key";
  //       }

  //       $sql = "UPDATE " . $user['role'] . " SET " . implode(", ", $placeholder) . " WHERE user_id = :id";
  //       $stm = $this->pdo->prepare($sql);
  //       $stm->execute([...$pro, "user_id" => $userId]);

  //       $this->pdo->commit();
  //       return true;
  //     } catch(PDOException $e){
  //       $this->pdo->rollBack();
  //       return false;
  //     }
  // }
  // public function create(array $user, array $pro = []): bool{
  //   try{
  //       $this->pdo->beginTransaction();

  //       $keys = array_keys($user);

  //       $sql ="insert into users (".implode(', ',$keys).") VALUES(:".implode(", :",$keys).")";
  //       $stm = $this->pdo->prepare($sql);
  //       $stm->execute($user);
        
  //       if(!$pro) {
  //         $this->pdo->commit();
  //         return true;
  //       };
          
  //       $userId = $this->pdo->lastInsertId();
  //       $keys = array_keys($pro);
  //       $keys[] = "user_id";


  //       $sql ="insert into ". $user['role'] ." (".implode(', ',$keys).") VALUES(:".implode(", :",$keys).")";
  //       var_dump("insert into ". $user['role'] ." (".implode(', ',$keys).") VALUES(:".implode(", :",$keys).")");
  //       var_dump([...$pro, "user_id" => (int) $userId]);

  //       $stm = $this->pdo->prepare($sql);
  //       $stm->execute([...$pro, "user_id" => $userId]);

  //       $this->pdo->commit();
  //       return true;
  //     } catch(PDOException $e){
  //       $this->pdo->rollBack();
  //       return false;
  //     }
  // }
}