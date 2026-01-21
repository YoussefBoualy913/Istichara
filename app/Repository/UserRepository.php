<?php

namespace App\Repository;

class UserRepository extends BaseRepository {
    public static string $tableName = "users";

    public function findByEmail(string $email): ?array {
        $stmt = $this->pdo->prepare("select * FROM " .static::$tableName. " WHERE email = :email");
        $stmt->execute(["email" => $email]);
        return $stmt->fetch();
    }
    
    public function getALL() :?array {
        $stmt = $this->pdo->prepare("select * FROM " . static::$tableName);
        $stmt->execute();
        return  $stmt->fetchAll();
    }

    public function delete(int $id) :bool {
        $stmt = $this->pdo->prepare("DELETE FROM " . static::$tableName . " WHERE id = :id");
        return $stmt->execute(["id" => $id]);
    }
}