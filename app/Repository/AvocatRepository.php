<?php
namespace App\Repository;

class AvocatRepository extends BaseRepository{
  protected static string $tableName = "avocat";

    public function findByUserId(int $id): array | null{
        $stmt = $this->pdo->prepare("select p.*, u.*, v.name as ville_name from ".static::$tableName." p JOIN ville v on p.ville_id = v.id JOIN users u ON u.id = p.user_id where p.user_id = :id");
        $stmt->execute(["id" => $id]);
        return $stmt->fetch();
    }


    public function searchAvocats(?string $query = null, ?int $villeId = null) {
        $sql = "SELECT p.*, v.name AS ville_name, u.* FROM " . static::$tableName . " p JOIN ville v ON p.ville_id = v.id JOIN users u ON p.user_id = u.id WHERE 1=1";
        $params = [];

        if ($query) {
            $sql = $sql . " AND (u.name ILIKE :search OR u.email ILIKE :search OR u.role ILIKE :search)";
            $params['search'] = "%$query%";
        }

        if ($villeId) {
            $sql = $sql . " AND p.ville_id = :villeId";
            $params['villeId'] = $villeId;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
    }
    
    public function Inactif(): array | null{
        $stmt = $this->pdo->prepare("select * from ".static::$tableName."   where statut = 'inactif'");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}