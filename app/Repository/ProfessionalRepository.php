<?php

namespace App\Repository\RepositoryInterface;

use App\Repository\BaseRepository;

class ProfessionalRepository extends BaseRepository
{
    public static string $tableName = "professionnels"; // Table générique, mais nous allons l'adapter
    
    /**
     * Obtenir les statistiques du dashboard
     */
    public function getDashboardStats($userId, $userRole)
    {
        $profId = $this->getProfessionalId($userId, $userRole);
        
        if (!$profId) {
            return [
                'total_demands' => 0,
                'pending' => 0,
                'confirmed' => 0,
                'completed' => 0,
                'cancelled' => 0,
                'online_percentage' => 0,
                'avg_response_time' => 0,
                'rating' => 0
            ];
        }
        
        $profField = $userRole . '_id';
        
        // Statistiques des demandes
        $sql = "SELECT 
                    COUNT(*) as total_demands,
                    SUM(CASE WHEN validation_status = 'pending' THEN 1 ELSE 0 END) as pending,
                    SUM(CASE WHEN validation_status = 'confirmed' THEN 1 ELSE 0 END) as confirmed,
                    SUM(CASE WHEN validation_status = 'completed' THEN 1 ELSE 0 END) as completed,
                    SUM(CASE WHEN validation_status = 'cancelled' THEN 1 ELSE 0 END) as cancelled
                FROM demand 
                WHERE $profField = :prof_id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['prof_id' => $profId]);
        $stats = $stmt->fetch();
        
        // Pourcentage de consultations en ligne
        $onlineSql = "SELECT 
                        (COUNT(CASE WHEN meet_link IS NOT NULL AND meet_link != '' THEN 1 END) * 100.0 / 
                         COUNT(*)) as online_percentage
                      FROM demand 
                      WHERE $profField = :prof_id";
        
        $onlineStmt = $this->pdo->prepare($onlineSql);
        $onlineStmt->execute(['prof_id' => $profId]);
        $online = $onlineStmt->fetch();
        
        return [
            'total_demands' => $stats['total_demands'] ?? 0,
            'pending' => $stats['pending'] ?? 0,
            'confirmed' => $stats['confirmed'] ?? 0,
            'completed' => $stats['completed'] ?? 0,
            'cancelled' => $stats['cancelled'] ?? 0,
            'online_percentage' => $online['online_percentage'] ?? 0,
            'avg_response_time' => $this->getAverageResponseTime($profId, $userRole),
            'rating' => $this->getAverageRating($userId, $userRole)
        ];
    }
    
    /**
     * Obtenir les demandes récentes
     */
    public function getRecentDemands($userId, $userRole, $limit = 5)
    {
        $profId = $this->getProfessionalId($userId, $userRole);
        
        if (!$profId) {
            return [];
        }
        
        $profField = $userRole . '_id';
        
        $sql = "SELECT d.*, 
                       u.name as client_name, 
                       u.email as client_email,
                       TO_CHAR(d.date, 'DD/MM/YYYY') as formatted_date
                FROM demand d
                JOIN users u ON d.user_id = u.id
                WHERE d.$profField = :prof_id
                ORDER BY d.date DESC, d.id DESC
                LIMIT :limit";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['prof_id' => $profId, 'limit' => $limit]);
        return $stmt->fetchAll();
    }
    
    /**
     * Obtenir toutes les demandes
     */
    public function getAllDemands($userId, $userRole, $filter = 'all')
    {
        $profId = $this->getProfessionalId($userId, $userRole);
        
        if (!$profId) {
            return [];
        }
        
        $profField = $userRole . '_id';
        $whereClause = "WHERE d.$profField = :prof_id";
        
        if ($filter !== 'all') {
            $whereClause .= " AND d.validation_status = :status";
        }
        
        $sql = "SELECT d.*, 
                       u.name as client_name, 
                       u.email as client_email,
                       TO_CHAR(d.date, 'DD/MM/YYYY') as formatted_date
                FROM demand d
                JOIN users u ON d.user_id = u.id
                $whereClause
                ORDER BY d.date DESC, d.id DESC";
        
        $params = ['prof_id' => $profId];
        
        if ($filter !== 'all') {
            $params['status'] = $filter;
        }
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    /**
     * Obtenir le profil du professionnel
     */
    public function getProfile($userId, $userRole)
    {
        $profTable = $userRole === 'avocat' ? 'avocat' : 'huissier';
        
        $sql = "SELECT a.*, 
                       u.name, 
                       u.email,
                       u.phone,
                       v.name as ville_name
                FROM $profTable a
                JOIN users u ON a.user_id = u.id
                LEFT JOIN ville v ON a.ville_id = v.id
                WHERE a.user_id = :user_id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch();
    }
    
    /**
     * Mettre à jour le profil
     */
    public function updateProfile($userId, $userRole, $data)
    {
        $profTable = $userRole === 'avocat' ? 'avocat' : 'huissier';
        
        // Mettre à jour users table
        $userSql = "UPDATE users SET 
                    name = :name,
                    email = :email,
                    phone = :phone
                    WHERE id = :user_id";
        
        $stmt = $this->pdo->prepare($userSql);
        $stmt->execute([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'user_id' => $userId
        ]);
        
        // Mettre à jour la table professionnelle
        $profData = [
            'ville_id' => $data['ville_id'] ?? null,
            'id' => $this->getProfessionalId($userId, $userRole)
        ];
        
        if ($userRole === 'avocat') {
            $profData['specialite'] = $data['specialite'] ?? null;
            $profData['consultation_en_ligne'] = $data['consultation_en_ligne'] ?? false;
            $profData['years_of_experience'] = $data['years_of_experience'] ?? null;
        } else {
            $profData['types_actes'] = $data['types_actes'] ?? null;
            $profData['years_of_experience'] = $data['years_of_experience'] ?? null;
        }
        
        $profSql = "UPDATE $profTable SET 
                    ville_id = :ville_id,
                    years_of_experience = :years_of_experience
                    " . ($userRole === 'avocat' ? ", specialite = :specialite, consultation_en_ligne = :consultation_en_ligne" : ", types_actes = :types_actes") . "
                    WHERE id = :id";
        
        $profStmt = $this->pdo->prepare($profSql);
        return $profStmt->execute($profData);
    }
    
    /**
     * Mettre à jour le statut d'une demande
     */
    public function updateDemandStatus($demandId, $status, $meetLink, $notes, $userId, $userRole)
    {
        // Vérifier que la demande appartient au professionnel
        $profId = $this->getProfessionalId($userId, $userRole);
        $profField = $userRole . '_id';
        
        $checkSql = "SELECT id FROM demand 
                     WHERE id = :demand_id 
                     AND $profField = :prof_id";
        
        $checkStmt = $this->pdo->prepare($checkSql);
        $checkStmt->execute(['demand_id' => $demandId, 'prof_id' => $profId]);
        
        if (!$checkStmt->fetch()) {
            return ['success' => false, 'message' => 'Accès non autorisé'];
        }
        
        //modifier le statut dyal demand
        $updateSql = "UPDATE demand SET 
                      validation_status = :status,
                      meet_link = COALESCE(:meet_link, meet_link),
                      updated_at = CURRENT_TIMESTAMP
                      WHERE id = :demand_id";
        
        $updateStmt = $this->pdo->prepare($updateSql);
        $result = $updateStmt->execute([
            'status' => $status,
            'meet_link' => $meetLink,
            'demand_id' => $demandId
        ]);
        
        if ($result) {
            return ['success' => true, 'message' => 'Statut mis à jour avec succès'];
        }
        
        return ['success' => false, 'message' => 'Erreur lors de la mise à jour'];
    }
    
    //Dteails dyal kola demande
    public function getDemandDetails($demandId, $userId, $userRole)
    {
        $profId = $this->getProfessionalId($userId, $userRole);
        $profField = $userRole . '_id';
        
        $sql = "SELECT d.*, 
                       u.name as client_name, 
                       u.email as client_email,
                       u.phone as client_phone,
                       TO_CHAR(d.date, 'DD/MM/YYYY HH24:MI') as formatted_date
                FROM demand d
                JOIN users u ON d.user_id = u.id
                WHERE d.id = :demand_id 
                AND d.$profField = :prof_id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['demand_id' => $demandId, 'prof_id' => $profId]);
        return $stmt->fetch();
    }
    
    //Affichage dyal les rendez vous
    public function getUpcomingMeetings($userId, $userRole)
    {
        $profId = $this->getProfessionalId($userId, $userRole);
        $profField = $userRole . '_id';
        
        $sql = "SELECT d.*, 
                       u.name as client_name,
                       TO_CHAR(d.date, 'DD/MM/YYYY HH24:MI') as meeting_time
                FROM demand d
                JOIN users u ON d.user_id = u.id
                WHERE d.$profField = :prof_id
                AND d.validation_status = 'confirmed'
                AND d.date >= CURRENT_DATE
                ORDER BY d.date ASC
                LIMIT 5";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['prof_id' => $profId]);
        return $stmt->fetchAll();
    }
    
    
    private function getProfessionalId($userId, $userRole)
    {
        $table = $userRole === 'avocat' ? 'avocat' : 'huissier';

        $sql = "SELECT id FROM $table WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetch();
        
        return $result['id'] ?? null;
    }

    private function getAverageResponseTime($profId, $userRole)
    {
        return "24h"; 
    }
    

    private function getAverageRating($userId, $userRole)
    {
        return 4.5; 
    }
}