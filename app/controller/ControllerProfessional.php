<?php

namespace App\Controller;

use App\Repository\ProfessionalRepository;
use App\Helper\Response;
use App\Helper\View;


session_start();
$_SESSION['user_id'] = 1;
$_SESSION['user_role'] = 'avocat';
$_SESSION['user_name'] = 'Maître Jean Dupont';
$_SESSION['user_email'] = 'jean.dupont@avocat.fr';

class ControllerProfessional
{
    private $professionalRepo;
    
    public function __construct()
    {
        $this->professionalRepo = new ProfessionalRepository();
        
    }
    
    // Dashboard principal
    public function index()
    {
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        
        $stats = $this->professionalRepo->getDashboardStats($userId, $userRole);
        $recent_demands = $this->professionalRepo->getRecentDemands($userId, $userRole, 5);
        $profile = $this->professionalRepo->getProfile($userId, $userRole);
        $upcoming_meetings = $this->professionalRepo->getUpcomingMeetings($userId, $userRole);
        
        View::render('professional_dashboard.php', [
            'stats' => $stats,
            'recent_demands' => $recent_demands,
            'profile' => $profile,
            'upcoming_meetings' => $upcoming_meetings
        ]);
    }
    
    // Liste des demandes
    public function demands()
    {
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        
        $filter = $_GET['filter'] ?? 'all';
        
        $demands = $this->professionalRepo->getAllDemands($userId, $userRole, $filter);
        $stats = $this->professionalRepo->getDashboardStats($userId, $userRole);
        
        View::render('professional_demands.php', [
            'demands' => $demands,
            'filter' => $filter,
            'stats' => $stats
        ]);
    }
    
    // Profil
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
                $_SESSION['user_name'] = $data['name'];
                $_SESSION['user_email'] = $data['email'];
            } else {
                $_SESSION['error_message'] = 'Erreur lors de la mise à jour';
            }
            
            (new Response())->header('/professional/profile');
        }
        
        $profile = $this->professionalRepo->getProfile($userId, $userRole);
        
        View::render('professional_profile.php', [
            'profile' => $profile
        ]);
    }
    
    // Mettre à jour le statut
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
    
    // Obtenir les détails d'une demande
    public function getDemandDetails()
    {
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        
        $demandId = $_GET['id'] ?? '';
        
        $demand = $this->professionalRepo->getDemandDetails($demandId, $userId, $userRole);
        
        header('Content-Type: application/json');
        if ($demand) {
            echo json_encode(['success' => true, 'data' => $demand]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Demande non trouvée']);
        }
        exit;
    }
}