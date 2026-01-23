<?php
namespace App\Repository;

class AvocatRepository extends BaseRepository{
    protected static string $tableName = "avocat";

    public function searchAvocats(?string $query = null, ?int $villeId = null, ?int $experience = null) {
        $sql = "SELECT p.*, v.name AS ville_name, u.* FROM " . static::$tableName . " p JOIN ville v ON p.ville_id = v.id JOIN users u ON p.user_id = u.id WHERE 1=1";
        $params = [];

        if ($query) {
            $sql = $sql . " AND u.name ILIKE :search ";
            $params['search'] = "%$query%";
        }

        if ($villeId) {
            $sql = $sql . " AND p.ville_id = :villeId";
            $params['villeId'] = $villeId;
        }
        
        if ($experience) {
            $sql = $sql . " AND p.years_of_experience >= :exp";
            $params['exp'] = $experience;
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    public function Inactif(): array | null{
        $stmt = $this->pdo->prepare("select users.*,".static::$tableName.".*,ville.name as ville_name
                                     from users
                                     join ".static::$tableName." on users.id = ".static::$tableName.".user_id
                                     join ville on  ville.id = ".static::$tableName.".ville_id
                                     where statut = 'inactif'"
                                       );
        $stmt->execute();
        return $stmt->fetchAll();
    }
}