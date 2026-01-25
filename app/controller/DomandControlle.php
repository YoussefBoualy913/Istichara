<?php

namespace App\Controller;

use App\Repository\DemandRepository;

class DemandController
{
    private DemandRepository $repo;

    public function __construct()
    {
        $this->repo = new DemandRepository();
    }

    /**
     * DASHBOARD
     */
    public function dashboard(): void
    {
        $stats = $this->repo->getStatistics();
        $recentDemands = $this->repo->getDemands('all');

        require __DIR__ . '/../../views/dashboard.php';
    }

    /**
     * DEMANDS LIST
     */
    public function demands(): void
    {
        $filter = $_GET['filter'] ?? 'all';

        $stats   = $this->repo->getStatistics();
        $demands = $this->repo->getDemands($filter);

        require __DIR__ . '/../../views/demands.php';
    }

    /**
     * ACCEPT DEMAND
     */
    public function accept(): void
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }

        $id       = (int) ($_POST['demand_id'] ?? 0);
        $meetLink = $_POST['meet_link'] ?? null;

        if (!$this->repo->demandExistsAndPending($id)) {
            echo json_encode(['success' => false, 'message' => 'Demande invalide']);
            exit;
        }

        $this->repo->updateStatus($id, 'approved', $meetLink);

        echo json_encode([
            'success' => true,
            'message' => 'Demande acceptée'
        ]);
        exit;
    }

    /**
     * REFUSE DEMAND
     */
    public function refuse(): void
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request']);
            exit;
        }

        $id = (int) ($_POST['demand_id'] ?? 0);

        if (!$this->repo->demandExistsAndPending($id)) {
            echo json_encode(['success' => false, 'message' => 'Demande invalide']);
            exit;
        }

        $this->repo->updateStatus($id, 'refused');

        echo json_encode([
            'success' => true,
            'message' => 'Demande refusée'
        ]);
        exit;
    }
}
