<?php

namespace App\Repository;
use App\Helper\Database;
use PDO;

class DemandRepository {
    protected PDO $pdo;

    public function __construct(){
        $this->pdo = Database::getConnexion();
    }

    public function findByUserId(int $userId): array {
        $stmt = $this->pdo->prepare("SELECT * FROM demand WHERE user_id = :user_id ORDER BY date DESC ");
        $stmt->execute([ 'user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countByUserId(int $userId): int {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM demand WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return (int) $stmt->fetchColumn();
    }

    public function getUserDemandAproved(int $userId): int {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM demand WHERE user_id = :user_id AND validation_status = 'approved' ");
        $stmt->execute(['user_id' => $userId]);
        return (int) $stmt->fetchColumn();
    }
   
    public function getUserDemandStatsDenied(int $userId): int {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM demand WHERE user_id = :user_id AND validation_status = 'pending' ");
        $stmt->execute(['user_id' => $userId]);
        return (int) $stmt->fetchColumn();
    }
   
}