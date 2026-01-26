<?php

namespace App\Controller;

use App\Repository\ProfessionalRepository;
use App\Repository\UserRepository;
use App\Helper\Response;
use App\Helper\View;
use App\Helper\Session;
use App\Helper\Request;
use App\Core\Middleware\ProfessionalMiddleware;

class ControllerProfessional
{
    private ProfessionalRepository $professionalRepo;
    private Session $session;
    private UserRepository $userRepo;
    private Response $response;
    private ProfessionalMiddleware $middleware;
    
    public function __construct()
    {
        $this->session = new Session();
        $this->response = new Response();
        $this->professionalRepo = new ProfessionalRepository();
        $this->userRepo = new UserRepository();
        $this->middleware = new ProfessionalMiddleware();
        
        $this->middleware->handle();
        

        $user = $this->session->getUser();
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role']; 
        $_SESSION['user_name'] = $user['name'] ?? '';
        $_SESSION['user_email'] = $user['email'] ?? '';
    }
    
    /**
     * Dashboard principal
     */
    public function index()
    {
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role']; // "AVOCAT" ou "HUISSIER"
        
        // Convertir le rôle en minuscules pour la base de données
        $dbRole = strtolower($userRole);
        
        // Récupérer les données
        $stats = $this->professionalRepo->getDashboardStats($userId, $dbRole);
        $recent_demands = $this->professionalRepo->getRecentDemands($userId, $dbRole, 5);
        $profile = $this->professionalRepo->getProfile($userId, $dbRole);
        $upcoming_meetings = $this->professionalRepo->getUpcomingMeetings($userId, $dbRole);
        
        // Formater les statistiques pour l'affichage
        $formattedStats = [
            'total_demands' => $stats['total_demands'] ?? 0,
            'pending' => $stats['pending'] ?? 0,
            'accepted' => $stats['confirmed'] ?? 0,
            'refused' => $stats['cancelled'] ?? 0,
            'completed' => $stats['completed'] ?? 0
        ];
        
        View::render('professional_dashboard.php', [
            'stats' => $formattedStats,
            'recent_demands' => $recent_demands,
            'profile' => $profile,
            'upcoming_meetings' => $upcoming_meetings ?? [],
            'user_name' => $_SESSION['user_name'],
            'user_role' => $userRole, // Garder en MAJUSCULES pour l'affichage
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
        $dbRole = strtolower($userRole);
        
        $request = new Request();
        $filter = $request->getQuery('filter') ?? 'all';
        
        $demands = $this->professionalRepo->getAllDemands($userId, $dbRole, $filter);
        $stats = $this->professionalRepo->getDashboardStats($userId, $dbRole);
        
        // Formater les statistiques
        $formattedStats = [
            'total_demands' => $stats['total_demands'] ?? 0,
            'pending' => $stats['pending'] ?? 0,
            'accepted' => $stats['confirmed'] ?? 0,
            'refused' => $stats['cancelled'] ?? 0,
            'completed' => $stats['completed'] ?? 0
        ];
        
        View::render('professional_demands.php', [
            'demands' => $demands,
            'filter' => $filter,
            'stats' => $formattedStats,
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
        $dbRole = strtolower($userRole);
        
        $clients = $this->professionalRepo->getClients($userId, $dbRole);
        
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
        $dbRole = strtolower($userRole);
        
        $documents = $this->professionalRepo->getDocuments($userId, $dbRole);
        
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
        $dbRole = strtolower($userRole);
        
        $request = new Request();
        
        if ($request->getRequestType() === 'POST') {
            // Mettre à jour le profil
            $data = [
                'name' => $request->getParam('name') ?? '',
                'email' => $request->getParam('email') ?? '',
                'ville_id' => $request->getParam('ville_id') ?? null,
                'years_of_experience' => $request->getParam('years_of_experience') ?? null
            ];
            
            if ($dbRole === 'avocat') {
                $data['specialite'] = $request->getParam('specialite') ?? null;
                $data['consultation_en_ligne'] = $request->getParam('consultation_en_ligne') === 'on';
            } else {
                $data['types_actes'] = $request->getParam('types_actes') ?? null;
            }
            
            $result = $this->professionalRepo->updateProfile($userId, $dbRole, $data);
            
            if ($result) {
                $_SESSION['success_message'] = 'Profil mis à jour avec succès';
                $_SESSION['user_name'] = $data['name'];
                $_SESSION['user_email'] = $data['email'];
            } else {
                $_SESSION['error_message'] = 'Erreur lors de la mise à jour';
            }
            
            $this->response->header('/professional/profile');
            exit;
        }
        
        $profile = $this->professionalRepo->getProfile($userId, $dbRole);
        
        View::render('professional_profile.php', [
            'profile' => $profile,
            'user_name' => $_SESSION['user_name'],
            'user_role' => $userRole,
            'user_email' => $_SESSION['user_email']
        ]);
    }
    
    public function updateStatus()
{
    // FORCER l'affichage des erreurs
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    // Démarrer la session
    session_start();
    
    // DÉSACTIVER toute sortie avant le JSON
    ob_clean();
    
    header('Content-Type: application/json');
    
    // Vérifier la méthode
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode([
            'success' => false,
            'message' => 'Méthode non autorisée'
        ]);
        exit;
    }
    
    // Vérifier la session
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])) {
        http_response_code(401);
        echo json_encode([
            'success' => false,
            'message' => 'Non authentifié'
        ]);
        exit;
    }
    
    $userId = $_SESSION['user_id'];
    $userRole = $_SESSION['user_role'];
    
    // Récupérer les données POST
    $demandId = (int) ($_POST['demand_id'] ?? 0);
    $status = $_POST['status'] ?? '';
    $meetLink = $_POST['meet_link'] ?? '';
    $notes = $_POST['notes'] ?? '';
    
    // Validation
    if (!$demandId || !in_array($status, ['confirmed', 'refused'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Données invalides'
        ]);
        exit;
    }
    
    // Convertir le rôle en minuscules
    $dbRole = strtolower($userRole);
    
    // Appeler le repository pour mettre à jour
    $result = $this->professionalRepo->updateDemandStatus($demandId, $status, $meetLink, $notes, $userId, $dbRole);
    
    if ($result['success']) {
        echo json_encode([
            'success' => true,
            'message' => $status === 'confirmed' ? 'Demande acceptée avec succès' : 'Demande refusée avec succès'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => $result['message'] ?? 'Erreur lors de la mise à jour'
        ]);
    }
    exit;
}

    
    /**
     * API: Obtenir les détails d'une demande
     */
    public function getDemandDetails()
    {
        $userId = $_SESSION['user_id'];
        $userRole = $_SESSION['user_role'];
        $dbRole = strtolower($userRole);
        
        $request = new Request();
        $demandId = $request->getQuery('id') ?? '';
        
        $demand = $this->professionalRepo->getDemandDetails($demandId, $userId, $dbRole);
        
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
        $dbRole = strtolower($userRole);
        
        $request = new Request();
        $period = $request->getQuery('period') ?? 'month';
        
        $stats = $this->professionalRepo->getStatistics($userId, $dbRole, $period);
        
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'data' => $stats]);
        exit;
    }
}