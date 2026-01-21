<?php

namespace App\Repository;

class UserRepository extends BaseRepository {
    public static string $tableName = "users";


    public function findById(int $id): array | bool {
      $stmt = $this->pdo->prepare("select * FROM ".static::$tableName." where id = :id");
      $stmt->execute(["id" => $id]);
      return $stmt->fetch();
   }



    public function findByEmail(string $email): array | bool {
        $stmt = $this->pdo->prepare("select * FROM " .static::$tableName. " WHERE email = :email");
        $stmt->execute(["email" => $email]);
        return $stmt->fetch();
    }
    
    public function getALL() : array | bool {
        $stmt = $this->pdo->prepare("select * FROM " . static::$tableName);
        $stmt->execute();
        return  $stmt->fetchAll();
    }

    public function delete(int $id) :bool {
        $stmt = $this->pdo->prepare("DELETE FROM " . static::$tableName . " WHERE id = :id");
        return $stmt->execute(["id" => $id]);
    }
}