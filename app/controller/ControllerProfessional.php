<?php

namespace App\Controller;

use App\Repository\ProfessionalRepository;
use App\Helper\Response;
use App\Helper\Request;

class ControllerProfessional
{
    private $professionalRepo;
    
    public function __construct()
    {
        $this->professionalRepo = new ProfessionalRepository();
        
        // Vérifier l'authentification via la session
        if (!isset($_SESSION['user_id'])) {
            (new Response())->header('/login');
        }
        
        // Vérifier le rôle
        $userRole = $_SESSION['user_role'] ?? '';
        if (!in_array($userRole, ['avocat', 'huissier'])) {
            (new Response())->header('/');
        }
    }
    
    /**
     * Dashboard principal
     */
    public function index()
    {
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        
        $data = [
            'stats' => $this->professionalRepo->getDashboardStats($userId, $userRole),
            'recent_demands' => $this->professionalRepo->getRecentDemands($userId, $userRole, 5),
            'profile' => $this->professionalRepo->getProfile($userId, $userRole),
            'upcoming_meetings' => $this->professionalRepo->getUpcomingMeetings($userId, $userRole)
        ];
        
        // Inclure la vue
        require_once __DIR__ . '/../../src/views/professional_dashboard.php';
    }
    
    /**
     * Liste des demandes
     */
    public function demands()
    {
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        
        $filter = $_GET['filter'] ?? 'all';
        
        $data = [
            'demands' => $this->professionalRepo->getAllDemands($userId, $userRole, $filter),
            'filter' => $filter,
            'stats' => $this->professionalRepo->getDashboardStats($userId, $userRole)
        ];
        
        require_once __DIR__ . '/../../src/views/professional_demands.php';
    }
    
    /**
     * Calendrier
     */
    public function calendar()
    {
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        
        // Implémenter la logique du calendrier
        echo "Calendrier - À implémenter";
    }
    
    /**
     * Clients
     */
    public function clients()
    {
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        
        // Logique pour les clients
        echo "Clients - À implémenter";
    }
    
    /**
     * Documents
     */
    public function documents()
    {
        echo "Documents - À implémenter";
    }
    
    /**
     * Profil
     */
    public function profile()
    {
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Mettre à jour le profil
            $data = [
                'name' => $_POST['name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'ville_id' => $_POST['ville_id'] ?? null,
                'years_of_experience' => $_POST['years_of_experience'] ?? null
            ];
            
            if ($userRole === 'avocat') {
                $data['specialite'] = $_POST['specialite'] ?? null;
                $data['consultation_en_ligne'] = isset($_POST['consultation_en_ligne']);
            } else {
                $data['types_actes'] = $_POST['types_actes'] ?? null;
            }
            
            $result = $this->professionalRepo->updateProfile($userId, $userRole, $data);
            
            if ($result) {
                $_SESSION['success_message'] = 'Profil mis à jour avec succès';
                // Mettre à jour les données de session
                $_SESSION['user_name'] = $data['name'];
                $_SESSION['user_email'] = $data['email'];
            } else {
                $_SESSION['error_message'] = 'Erreur lors de la mise à jour';
            }
            
            (new Response())->header('/professional/profile');
        }
        
        $data = [
            'profile' => $this->professionalRepo->getProfile($userId, $userRole)
        ];
        
        require_once __DIR__ . '/../../src/views/professional_profile.php';
    }
    
    /**
     * API: Mettre à jour le statut d'une demande
     */
    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
            exit;
        }
        
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        
        $demandId = $_POST['demand_id'] ?? '';
        $status = $_POST['status'] ?? '';
        $meetLink = $_POST['meet_link'] ?? '';
        $notes = $_POST['notes'] ?? '';
        
        $result = $this->professionalRepo->updateDemandStatus(
            $demandId, 
            $status, 
            $meetLink, 
            $notes, 
            $userId, 
            $userRole
        );
        
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
    
    /**
     * API: Obtenir les détails d'une demande
     */
    public function getDemandDetails()
    {
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        
        $demandId = $_GET['id'] ?? '';
        
        $demand = $this->professionalRepo->getDemandDetails($demandId, $userId, $userRole);
        
        if ($demand) {
            echo json_encode(['success' => true, 'data' => $demand]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Demande non trouvée']);
        }
        exit;
    }
}