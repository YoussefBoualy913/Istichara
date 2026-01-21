<?php
namespace App\Repository;

class AvocatRepository extends BaseRepository{
  protected static string $tableName = "avocat";

    public function findByUserId(int $id): ?array{
        $stmt = $this->pdo->prepare("select p.*, v.name as ville_name from ".static::$tableName." p JOIN ville v on p.ville_id = v.id  where p.user_id = :id");
        $stmt->execute(["id" => $id]);
        return $stmt->fetch();
    }
}