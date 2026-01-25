<?php
// src/Repository/DemandRepository.php

namespace App\Repository;

use App\Helper\Database;
use PDO;

class DemandRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnexion();
    }

    /**
     *  DASHBOARD STATS (GLOBAL – avocat + huissier)
     */
    public function getStatistics(): array
    {
        $sql = "
            SELECT
                COUNT(*) AS total_demands,
                COUNT(*) FILTER (WHERE validation_status = 'pending')   AS pending,
                COUNT(*) FILTER (WHERE validation_status = 'approved')  AS accepted,
                COUNT(*) FILTER (WHERE validation_status = 'refused')   AS refused,
                COUNT(*) FILTER (WHERE validation_status = 'completed') AS completed
            FROM demand
        ";

        return $this->pdo->query($sql)->fetch();
    }

    /**
     * GET DEMANDS (FILTERABLE)
     */
    public function getDemands(string $filter = 'all'): array
{
    $sql = "
        SELECT
            d.id,
            d.validation_status,
            d.date,
            d.meet_link,
            u.name AS client_name,
            u.email AS client_email,
            TO_CHAR(d.date, 'DD/MM/YYYY HH:MI') AS formatted_date
        FROM demand d
        JOIN users u ON u.id = d.user_id
    ";

    if ($filter !== 'all') {
        if ($filter === 'accepted') {
            $filter = 'approved';
        }
        $sql .= " WHERE d.validation_status = :status";
    }

    $sql .= " ORDER BY d.date DESC";

    $stmt = $this->pdo->prepare($sql);

    if ($filter !== 'all') {
        $stmt->bindValue(':status', $filter);
    }

    $stmt->execute();
    return $stmt->fetchAll();
}

    /**
     * CHECK OWNERSHIP (SAFETY)
     */
    public function demandExistsAndPending(int $demandId): bool
    {
        $stmt = $this->pdo->prepare("
            SELECT 1 FROM demand
            WHERE id = :id AND validation_status = 'pending'
        ");
        $stmt->execute(['id' => $demandId]);
        return (bool) $stmt->fetchColumn();
    }

    /**
     * UPDATE STATUS
     */
    public function updateStatus(int $demandId, string $status, ?string $meetLink = null): bool
    {
        $sql = "
            UPDATE demand
            SET validation_status = :status,
                meet_link = :meet_link
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'status'    => $status,
            'meet_link' => $meetLink,
            'id'        => $demandId
        ]);
    }
}
