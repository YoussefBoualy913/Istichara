<?php
namespace  App\Repository;

use App\Helper\Database;
use App\Repository\RepositoryInterface\RepositoryInterface;
use PDO;
use PDOException;

class BaseRepository implements RepositoryInterface {
   protected PDO  $pdo;
   protected static string $tableName;

   public function __construct(){
    $this->pdo = Database::getConnexion();
   }
   
   public function getALL() :array {
    $stmt = $this->pdo->prepare("select p.*, v.name AS ville_name from " . static::$tableName .  " p JOIN ville v ON v.id = p.ville_id");
    $stmt->execute();
    return  $stmt->fetchAll();
   }

   public function delete(int $id):void{
      $stmt = $this->pdo->prepare("delete from ".static::$tableName." where id = :id");
      $stmt->execute(["id" => $id]);
   }

    public function findById(int $id):array{
      $stmt = $this->pdo->prepare("select p.*, v.name as ville_name from ".static::$tableName." p JOIN ville v on p.ville_id = v.id  where p.id = :id");
      $stmt->execute(["id" => $id]);
      return $stmt->fetch();
   }

    public function creat(array $data):void {
      $keys = array_keys($data);
      $sql ="insert into ". static::$tableName ."(".implode(', ',$keys).") VALUES(:".implode(", :",$keys).")";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute($data);
   }


  public function update(array $user, array $pro = []){
    $userId = $user['id'];
    unset($user['id']);
    try{
        $this->pdo->beginTransaction();

        $keys = array_keys($user);
        $placeholder = [];
        foreach($keys as $key){
          $placeholder[] = "$key = :$key";
        }

        $sql = "UPDATE users SET " . implode(", ", $placeholder) . " WHERE id = :id";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([...$user, "id" => $userId]);

        if(!$pro) {
          $this->pdo->commit();
          return true;
        };

        $keys = array_keys($pro);
        $placeholder = [];
        foreach($keys as $key){
          $placeholder[] = "$key = :$key";
        }

        $sql = "UPDATE " . $user['role'] . " SET " . implode(", ", $placeholder) . " WHERE user_id = :id";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([...$pro, "user_id" => $userId]);

        $this->pdo->commit();
      } catch(PDOException $e){
        $this->pdo->rollBack();
        return false;
      }
  }

  public function create(array $user, array $pro = []){
    try{
        $this->pdo->beginTransaction();

        $keys = array_keys($user);

        $sql ="insert into users (".implode(', ',$keys).") VALUES(:".implode(", :",$keys).")";
        $stm = $this->pdo->prepare($sql);
        $stm->execute($user);

        
        if(!$pro) {
          $this->pdo->commit();
          return true;
          };
          
        $userId = $this->pdo->lastInsertId();
        $keys = array_keys($pro);
        $placeholder = [];
        $keys[] = "user_id";


        $sql ="insert into ". $user['role'] ."(".implode(', ',$keys).") VALUES(:".implode(", :",$keys).")";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([...$pro, "user_id" => $userId]);

        $this->pdo->commit();
      } catch(PDOException $e){
        $this->pdo->rollBack();
        return false;
      }
  }
}