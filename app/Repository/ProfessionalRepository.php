<?php

namespace App\Repository;

use App\Repository\BaseRepository;

class ProfessionalRepository extends BaseRepository
{
    public static string $tableName = "professionnels";
    


        private function normalizeRole($userRole)
    {

        return strtolower($userRole);
    }
    
    //afficher les statistique dyal professional
    public function getDashboardStats($userId, $userRole)
    {
         $userRole = $this->normalizeRole($userRole);
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
                        (COUNT(CASE WHEN meet_link IS NOT NULL AND meet_link != '' THEN 1 END)) * 100.0 / 
                         1 as online_percentage
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
    
    // Obtenir les demandes récentes
     
    public function getRecentDemands($userId, $userRole, $limit = 5)
    {
         $userRole = $this->normalizeRole($userRole);
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
    
    
    // Obtenir toutes les demandes
     
    public function getAllDemands($userId, $userRole, $filter = 'all')
    {
         $userRole = $this->normalizeRole($userRole);
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
    
    
     // Obtenir le profil du professionnel
     
    public function getProfile($userId, $userRole)
    {
         $userRole = $this->normalizeRole($userRole);
        $profTable = $userRole === 'avocat' ? 'avocat' : 'huissier';
        
        $sql = "SELECT a.*, 
                       u.name, 
                       u.email,
                       v.name as ville_name
                FROM $profTable a
                JOIN users u ON a.user_id = u.id
                LEFT JOIN ville v ON a.ville_id = v.id
                WHERE a.user_id = :user_id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetch();
    }
    


 // Obtenir les clients d'un professionnel
 
public function getClients($userId, $userRole)
{
     $userRole = $this->normalizeRole($userRole);
    $profId = $this->getProfessionalId($userId, $userRole);
    
    if (!$profId) {
        return [];
    }
    
    $profField = $userRole . '_id';
    
    $sql = "SELECT DISTINCT u.id, u.name, u.email, COUNT(d.id) as total_demands
            FROM demand d
            JOIN users u ON d.user_id = u.id
            WHERE d.$profField = :prof_id
            GROUP BY u.id, u.name, u.email
            ORDER BY u.name";
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['prof_id' => $profId]);
    return $stmt->fetchAll();
}


 // Obtenir les documents d'un professionnel
 
public function getDocuments($userId, $userRole)
{
     $userRole = $this->normalizeRole($userRole);
    $profId = $this->getProfessionalId($userId, $userRole);
    
    if (!$profId) {
        return [];
    }
    
    $table = $userRole === 'avocat' ? 'avocat' : 'huissier';
    
    $sql = "SELECT document FROM $table WHERE id = :prof_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['prof_id' => $profId]);
    $result = $stmt->fetch();
    
    if ($result && $result['document']) {
        return json_decode($result['document'], true) ?: [];
    }
    
    return [];
}


 // Obtenir les statistiques détaillées
 
public function getStatistics($userId, $userRole, $period = 'month')
{
     $userRole = $this->normalizeRole($userRole);
    $profId = $this->getProfessionalId($userId, $userRole);
    
    if (!$profId) {
        return [];
    }
    
    $profField = $userRole . '_id';
    
    // Statistiques par mois pour les 6 derniers mois
    $sql = "SELECT 
                TO_CHAR(date, 'YYYY-MM') as month,
                COUNT(*) as total_demands,
                SUM(CASE WHEN validation_status = 'confirmed' THEN 1 ELSE 0 END) as confirmed,
                SUM(CASE WHEN validation_status = 'completed' THEN 1 ELSE 0 END) as completed
            FROM demand 
            WHERE $profField = :prof_id
            AND date >= CURRENT_DATE - INTERVAL '6 months'
            GROUP BY TO_CHAR(date, 'YYYY-MM')
            ORDER BY month DESC";
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute(['prof_id' => $profId]);
    return $stmt->fetchAll();
}
    
     // Mettre à jour le profil
     
    public function updateProfile($userId, $userRole, $data)
    {
         $userRole = $this->normalizeRole($userRole);
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
    
public function updateDemandStatus($demandId, $status, $meetLink, $notes, $userId, $userRole)
{
    error_log("=== REPOSITORY updateDemandStatus ===");
    error_log("Demand ID: $demandId");
    error_log("Status: $status");
    error_log("User ID: $userId");
    error_log("User Role: $userRole");
    
    // Vérification CRITIQUE
    if (empty($userRole) || !in_array(strtolower($userRole), ['avocat', 'huissier'])) {
        error_log("ERROR: userRole invalide: " . ($userRole ?? 'NULL'));
        return ['success' => false, 'message' => 'Rôle professionnel invalide: ' . $userRole];
    }
    
    $userRole = $this->normalizeRole($userRole);
    error_log("Normalized role: $userRole");
    
    $profId = $this->getProfessionalId($userId, $userRole);
    error_log("Professional ID: " . ($profId ?? 'null'));
    
    if (!$profId) {
        error_log("ERROR: No professional ID found for user $userId, role $userRole");
        return ['success' => false, 'message' => 'Professionnel non trouvé'];
    }
    
    $profField = $userRole . '_id';
    error_log("Professional field: $profField");
    
    // Vérifier que la demande appartient bien à ce professionnel et est en attente
    $checkSql = "SELECT id FROM demand WHERE id = :demand_id AND $profField = :prof_id AND validation_status = 'pending'";
    $checkStmt = $this->pdo->prepare($checkSql);
    $checkStmt->execute(['demand_id' => $demandId, 'prof_id' => $profId]);
    
    if (!$checkStmt->fetch()) {
        error_log("ERROR: Demand $demandId not found or not pending for professional $profId");
        return ['success' => false, 'message' => 'Demande non trouvée ou déjà traitée'];
    }
    
    // Mettre à jour le statut
    $updateSql = "UPDATE demand SET 
                  validation_status = :status,
                  meet_link = :meet_link
                  WHERE id = :demand_id";
    
    $updateStmt = $this->pdo->prepare($updateSql);
    
    $params = [
        'status' => $status,
        'meet_link' => $meetLink ?: null,
        'demand_id' => $demandId
    ];
    
    try {
        $success = $updateStmt->execute($params);
        
        if ($success) {
            error_log("Demand $demandId updated successfully to $status");
            return ['success' => true, 'message' => 'Statut mis à jour avec succès'];
        } else {
            error_log("ERROR: Update failed for demand $demandId");
            return ['success' => false, 'message' => 'Échec de la mise à jour'];
        }
    } catch (PDOException $e) {
        error_log("PDO Exception: " . $e->getMessage());
        return ['success' => false, 'message' => 'Erreur de base de données: ' . $e->getMessage()];
    }
}
    
    //Dteails dyal kola demande
    public function getDemandDetails($demandId, $userId, $userRole)
    {
         $userRole = $this->normalizeRole($userRole);
        $profId = $this->getProfessionalId($userId, $userRole);
        $profField = $userRole . '_id';
        
        $sql = "SELECT d.*, 
                       u.name as client_name, 
                       u.email as client_email,
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
         $userRole = $this->normalizeRole($userRole);
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
         $userRole = $this->normalizeRole($userRole);
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