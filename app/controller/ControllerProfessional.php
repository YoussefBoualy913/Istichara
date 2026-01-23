<?php

namespace App\Controller;

use App\Repository\ProfessionalRepository;
use App\Repository\UserRepository;
use App\Helper\Response;
use App\Helper\View;
use App\Helper\Session;
use App\Helper\Request;

class ControllerProfessional
{
    private ProfessionalRepository $professionalRepo;
    private Session $session;
    private UserRepository $userRepo;
    private Response $response;
    
    public function __construct()
    {
        $this->session = new Session();
        $this->response = new Response();
        $this->professionalRepo = new ProfessionalRepository();
        $this->userRepo = new UserRepository();
        
        // Démarrer la session
        $this->session->Start();
        
        // Vérifier si l'utilisateur est connecté
        $userId = $this->session->getUserId();
        if (!$userId) {
            $this->response->header('/register');
            exit;
        }
        
        // Obtenir les informations utilisateur depuis la base de données
        $userData = $this->userRepo->findByUserId($userId);
        
        if (!$userData) {
            $this->response->header('/register');
            exit;
        }
        
        // Stocker les informations utilisateur dans la session
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_role'] = $userData['role'] ?? '';
        $_SESSION['user_name'] = $userData['name'] ?? '';
        $_SESSION['user_email'] = $userData['email'] ?? '';
        
        // Vérifier le rôle
        $userRole = $userData['role'] ?? '';
        if (!in_array($userRole, ['avocat', 'huissier'])) {
            $this->response->header('/');
            exit;
        }
    }
    
    /**
     * Dashboard principal
     */
    public function index()
    {
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        
        $stats = $this->professionalRepo->getDashboardStats($userId, $userRole);
        $recent_demands = $this->professionalRepo->getRecentDemands($userId, $userRole, 5);
        $profile = $this->professionalRepo->getProfile($userId, $userRole);
        $upcoming_meetings = $this->professionalRepo->getUpcomingMeetings($userId, $userRole);
        
        // Passer aussi les données utilisateur à la vue
        View::render('professional_dashboard.php', [
            'stats' => $stats,
            'recent_demands' => $recent_demands,
            'profile' => $profile,
            'upcoming_meetings' => $upcoming_meetings,
            'user_name' => $_SESSION['user_name'],
            'user_role' => $userRole,
            'user_email' => $_SESSION['user_email']
        ]);
    }
    
    /**
     * Liste des demandes
     */
    public function demands()
    {
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        
        $request = new Request();
        $filter = $request->getQuery('filter') ?? 'all';
        
        $demands = $this->professionalRepo->getAllDemands($userId, $userRole, $filter);
        $stats = $this->professionalRepo->getDashboardStats($userId, $userRole);
        
        View::render('professional_dashboard.php', [
            'demands' => $demands,
            'filter' => $filter,
            'stats' => $stats,
            'user_name' => $_SESSION['user_name'],
            'user_role' => $userRole,
            'user_email' => $_SESSION['user_email']
        ]);
    }
    
    /**
     * Calendrier
     */
    public function calendar()
    {
        View::render('professional_calendar.php', [
            'user_name' => $_SESSION['user_name'],
            'user_role' => $_SESSION['user_role']
        ]);
    }
    
    /**
     * Clients
     */
    public function clients()
    {
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        
        // Implémentez la méthode getClients dans ProfessionalRepository
        $clients = $this->professionalRepo->getClients($userId, $userRole);
        
        View::render('professional_clients.php', [
            'clients' => $clients,
            'user_name' => $_SESSION['user_name'],
            'user_role' => $_SESSION['user_role']
        ]);
    }
    
    /**
     * Documents
     */
    public function documents()
    {
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        
        // Implémentez la méthode getDocuments dans ProfessionalRepository
        $documents = $this->professionalRepo->getDocuments($userId, $userRole);
        
        View::render('professional_documents.php', [
            'documents' => $documents,
            'user_name' => $_SESSION['user_name'],
            'user_role' => $_SESSION['user_role']
        ]);
    }
    
    /**
     * Profil
     */
    public function profile()
    {
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        
        $request = new Request();
        
        if ($request->getRequestType() === 'POST') {
            // Mettre à jour le profil
            $data = [
                'name' => $request->getParam('name') ?? '',
                'email' => $request->getParam('email') ?? '',
                'ville_id' => $request->getParam('ville_id') ?? null,
                'years_of_experience' => $request->getParam('years_of_experience') ?? null
            ];
            
            if ($userRole === 'avocat') {
                $data['specialite'] = $request->getParam('specialite') ?? null;
                $data['consultation_en_ligne'] = $request->getParam('consultation_en_ligne') === 'on';
            } else {
                $data['types_actes'] = $request->getParam('types_actes') ?? null;
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
            
            $this->response->header('/professional/profile');
            exit;
        }
        
        $profile = $this->professionalRepo->getProfile($userId, $userRole);
        
        View::render('professional_profile.php', [
            'profile' => $profile,
            'user_name' => $_SESSION['user_name'],
            'user_role' => $userRole,
            'user_email' => $_SESSION['user_email']
        ]);
    }
    
    /**
     * API: Mettre à jour le statut d'une demande
     */
    public function updateStatus()
    {
        $request = new Request();
        
        if ($request->getRequestType() !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Méthode non autorisée']);
            exit;
        }
        
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        
        $demandId = $request->getParam('demand_id') ?? '';
        $status = $request->getParam('status') ?? '';
        $meetLink = $request->getParam('meet_link') ?? '';
        $notes = $request->getParam('notes') ?? '';
        
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
        
        $request = new Request();
        $demandId = $request->getQuery('id') ?? '';
        
        $demand = $this->professionalRepo->getDemandDetails($demandId, $userId, $userRole);
        
        header('Content-Type: application/json');
        if ($demand) {
            echo json_encode(['success' => true, 'data' => $demand]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Demande non trouvée']);
        }
        exit;
    }
    
    /**
     * API: Obtenir les statistiques pour les graphiques
     */
    public function getStatistics()
    {
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        
        $request = new Request();
        $period = $request->getQuery('period') ?? 'month';
        
        // Implémentez cette méthode dans ProfessionalRepository
        $stats = $this->professionalRepo->getStatistics($userId, $userRole, $period);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $stats]);
        exit;
    }
}