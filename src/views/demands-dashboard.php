<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ISTICHARA</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<?php
// ✅ SAFE defaults (PostgreSQL NULL protection)
$total     = (int) ($stats['total_demands'] ?? 0);
$pending   = (int) ($stats['pending'] ?? 0);
$accepted  = (int) ($stats['accepted'] ?? 0); // approved in DB
$refused   = (int) ($stats['refused'] ?? 0);
$completed = (int) ($stats['completed'] ?? 0);
?>

<div class="dashboard-layout">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="brand">
            <span class="material-icons">balance</span>
            <span>ISTICHARA</span>
        </div>

        <nav class="sidebar-menu">
            <a href="/dashboard" class="sidebar-link active">
                <span class="material-icons">dashboard</span>
                <span>Dashboard</span>
            </a>
            <a href="/demands" class="sidebar-link">
                <span class="material-icons">inbox</span>
                <span>Demandes</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <h2 style="margin-bottom: 2rem;">Tableau de Bord</h2>

        <!-- Statistics Cards -->
        <div class="stats-grid">

            <div class="card stat-card">
                <div class="stat-icon">
                    <span class="material-icons" style="color:#475569;">description</span>
                </div>
                <div>
                    <h3><?= $total ?></h3>
                    <p>Total Demandes</p>
                </div>
            </div>

            <div class="card stat-card">
                <div class="stat-icon">
                    <span class="material-icons" style="color:#d97706;">schedule</span>
                </div>
                <div>
                    <h3><?= $pending ?></h3>
                    <p>En attente</p>
                </div>
            </div>

            <div class="card stat-card">
                <div class="stat-icon">
                    <span class="material-icons" style="color:#059669;">check_circle</span>
                </div>
                <div>
                    <h3><?= $accepted ?></h3>
                    <p>Acceptées</p>
                </div>
            </div>

            <div class="card stat-card">
                <div class="stat-icon">
                    <span class="material-icons" style="color:#dc2626;">cancel</span>
                </div>
                <div>
                    <h3><?= $refused ?></h3>
                    <p>Refusées</p>
                </div>
            </div>

        </div>

        <!-- Recent Demands Table -->
        <div class="content-card">
            <h3 style="margin-bottom: 1rem;">Demandes Récentes</h3>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>

                <?php if (!empty($recentDemands)): ?>
                    <?php foreach ($recentDemands as $demand): ?>

                        <?php
                        // Badge class mapping
                        $statusClass = match ($demand['validation_status']) {
                            'pending'   => 'pending',
                            'approved'  => 'accepted',
                            'refused'   => 'refused',
                            'completed' => 'completed',
                            default     => 'pending'
                        };
                        ?>

                        <tr>
                            <td>#<?= (int) $demand['id'] ?></td>
                            <td><?= htmlspecialchars($demand['client_name']) ?></td>
                            <td><?= htmlspecialchars($demand['date']) ?></td>
                            <td>
                                <span class="status-badge <?= $statusClass ?>">
                                    <?= ucfirst($demand['validation_status']) ?>
                                </span>
                            </td>
                        </tr>

                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align:center;">
                            Aucune demande
                        </td>
                    </tr>
                <?php endif; ?>

                </tbody>
            </table>
        </div>
    </main>
</div>

</body>
</html>
