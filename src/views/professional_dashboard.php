<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Professionnel - Istichara</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: #f3f4f6;
    color: #1f2937;
}

.dashboard-container {
    display: flex;
    min-height: 100vh;
}

/* Sidebar */
.sidebar {
    width: 260px;
    background: linear-gradient(180deg, #1a2332 0%, #0f172a 100%);
    color: #f1f5f9;
    position: fixed;
    height: 100vh;
    overflow-y: auto;
}

.logo {
    padding: 24px 20px;
    font-size: 24px;
    font-weight: 800;
    text-align: center;
    color: white;
    border-bottom: 1px solid #334155;
}

.nav-menu {
    padding: 20px 16px;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
    border-radius: 10px;
    text-decoration: none;
    color: #cbd5e1;
    font-size: 15px;
    margin-bottom: 8px;
    transition: all 0.2s ease;
}

.nav-item:hover {
    background: rgba(255, 255, 255, 0.08);
    color: #ffffff;
}

.nav-item.active {
    background: rgba(59, 130, 246, 0.2);
    color: #ffffff;
    border-left: 4px solid #3b82f6;
}

.nav-item .icon {
    font-size: 20px;
}

.nav-item.logout {
    margin-top: 20px;
    background: rgba(239, 68, 68, 0.1);
    color: #fca5a5;
}

.nav-item.logout:hover {
    background: rgba(239, 68, 68, 0.2);
}

/* Main Content */
.main-content {
    flex: 1;
    margin-left: 260px;
    padding: 30px;
}

/* Header */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid #e2e8f0;
}

.header h1 {
    font-size: 28px;
    color: #1a2332;
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 8px 16px;
    border-radius: 12px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
}

.avatar {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: linear-gradient(135deg, #1a2332, #2d3e50);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 16px;
}

.user-info {
    display: flex;
    flex-direction: column;
}

.user-name {
    font-weight: 600;
    color: #1e293b;
    font-size: 15px;
}

.user-role {
    font-size: 13px;
    color: #64748b;
}

/* Statistics Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: #ffffff;
    padding: 24px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.stat-icon {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.stat-content h3 {
    font-size: 32px;
    color: #1a2332;
    margin-bottom: 4px;
}

.stat-content p {
    color: #64748b;
    font-size: 14px;
}

/* Content Card */
.content-card {
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    padding: 24px;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 2px solid #f1f5f9;
}

.card-header h2 {
    font-size: 20px;
    color: #1a2332;
    font-weight: 700;
}

.btn-link {
    color: #3b82f6;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: color 0.2s;
}

.btn-link:hover {
    color: #1d4ed8;
}

/* Table */
.table-responsive {
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table thead {
    background: #f8fafc;
}

.data-table th {
    padding: 14px 12px;
    text-align: left;
    font-weight: 600;
    color: #64748b;
    font-size: 13px;
    text-transform: uppercase;
    border-bottom: 2px solid #e2e8f0;
}

.data-table td {
    padding: 16px 12px;
    border-bottom: 1px solid #f1f5f9;
}

.data-table tbody tr:hover {
    background: #f8fafc;
}

.client-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.client-name {
    font-weight: 600;
    color: #1e293b;
    font-size: 14px;
}

.client-email {
    font-size: 12px;
    color: #64748b;
}

/* Status Badges */
.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
    text-align: center;
}

.status-badge.pending {
    background: #fef3c7;
    color: #92400e;
}

.status-badge.confirmed {
    background: #dbeafe;
    color: #1e40af;
}

.status-badge.completed {
    background: #d1fae5;
    color: #065f46;
}

.status-badge.cancelled {
    background: #fee2e2;
    color: #991b1b;
}

/* Buttons */
.btn-icon {
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    padding: 8px;
    transition: all 0.2s;
    margin-right: 4px;
}

.btn-icon:hover {
    background: #e2e8f0;
    transform: translateY(-2px);
}

.no-data {
    text-align: center;
    color: #94a3b8;
    padding: 40px;
    font-style: italic;
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background: white;
    margin: 5% auto;
    padding: 0;
    border-radius: 12px;
    width: 90%;
    max-width: 600px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px;
    border-bottom: 2px solid #f1f5f9;
}

.modal-header h2 {
    color: #1a2332;
    font-size: 20px;
}

.close {
    font-size: 28px;
    color: #64748b;
    cursor: pointer;
}

.close:hover {
    color: #1f2937;
}

.modal-body {
    padding: 24px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #374151;
    font-weight: 600;
    font-size: 14px;
}

.form-group select,
.form-group input,
.form-group textarea {
    width: 100%;
    padding: 12px;
    border: 2px solid #e2e8f0;
    border-radius: 8px;
    font-size: 14px;
    font-family: inherit;
}

.form-group select:focus,
.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #3b82f6;
}

.form-group textarea {
    resize: vertical;
}

.modal-actions {
    display: flex;
    gap: 12px;
    margin-top: 24px;
}

.btn {
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    flex: 1;
}

.btn-primary {
    background: #1a2332;
    color: white;
}

.btn-primary:hover {
    background: #2d3e50;
}

.btn-secondary {
    background: #e2e8f0;
    color: #374151;
}

.btn-secondary:hover {
    background: #cbd5e1;
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        width: 70px;
    }
    
    .nav-item span:not(.icon) {
        display: none;
    }
    
    .main-content {
        margin-left: 70px;
        padding: 20px;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
}
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">ISTICHARA</div>
            
            <nav class="nav-menu">
                <a href="/professional/dashboard" class="nav-item active">
                    <span class="icon">📊</span>
                    <span>Tableau de Bord</span>
                </a>
                
                <a href="/professional/demands" class="nav-item">
                    <span class="icon">📁</span>
                    <span>Mes Demandes</span>
                </a>
                
                <a href="/professional/profile" class="nav-item">
                    <span class="icon">⚙️</span>
                    <span>Paramètres</span>
                </a>
                
                <a href="/logout" class="nav-item logout">
                    <span class="icon">🚪</span>
                    <span>Déconnexion</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <h1>Tableau de Bord</h1>
                
                <div class="user-profile">
                    <div class="avatar">
                        <?= strtoupper(substr($_SESSION['user_name'] ?? 'U', 0, 2)) ?>
                    </div>
                    <div class="user-info">
                        <span class="user-name"><?= $_SESSION['user_name'] ?? 'Utilisateur' ?></span>
                        <span class="user-role">
                            <?= ($_SESSION['user_role'] === 'avocat') ? 'Avocat' : 'Huissier' ?>
                        </span>
                    </div>
                </div>
            </header>

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">📊</div>
                    <div class="stat-content">
                        <h3><?= $stats['total_demands'] ?? 0 ?></h3>
                        <p>Total Demandes</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">⏳</div>
                    <div class="stat-content">
                        <h3><?= $stats['pending'] ?? 0 ?></h3>
                        <p>En Attente</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">✅</div>
                    <div class="stat-content">
                        <h3><?= $stats['confirmed'] ?? 0 ?></h3>
                        <p>Confirmées</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">🏁</div>
                    <div class="stat-content">
                        <h3><?= $stats['completed'] ?? 0 ?></h3>
                        <p>Terminées</p>
                    </div>
                </div>
            </div>

            <!-- Recent Demands Table -->
            <div class="content-card">
                <div class="card-header">
                    <h2>Demandes Récentes</h2>
                    <a href="/professional/demands" class="btn-link">Voir tout</a>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recent_demands)): ?>
                                <?php foreach ($recent_demands as $demand): ?>
                                    <tr>
                                        <td><strong>#<?= htmlspecialchars($demand['id']) ?></strong></td>
                                        <td>
                                            <div class="client-info">
                                                <span class="client-name"><?= htmlspecialchars($demand['client_name'] ?? 'N/A') ?></span>
                                                <span class="client-email"><?= htmlspecialchars($demand['client_email'] ?? '') ?></span>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($demand['formatted_date'] ?? $demand['date']) ?></td>
                                        <td>
                                            <span class="status-badge <?= $demand['validation_status'] ?>">
                                                <?php
                                                $statusLabels = [
                                                    'pending' => 'En attente',
                                                    'confirmed' => 'Confirmée',
                                                    'completed' => 'Terminée',
                                                    'cancelled' => 'Annulée'
                                                ];
                                                echo $statusLabels[$demand['validation_status']] ?? $demand['validation_status'];
                                                ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn-icon" onclick="viewDemand(<?= $demand['id'] ?>)" title="Voir">
                                                👁️
                                            </button>
                                            <button class="btn-icon" onclick="updateStatus(<?= $demand['id'] ?>)" title="Mettre à jour">
                                                ✏️
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="no-data">Aucune demande trouvée</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal for Demand Details -->
    <div id="demandModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Détails de la Demande</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body" id="modalBody">
                <!-- Content loaded via JavaScript -->
            </div>
        </div>
    </div>

    <!-- Modal for Status Update -->
    <div id="statusModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Mettre à jour le statut</h2>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <form id="statusForm">
                    <input type="hidden" id="demandId" name="demand_id">
                    
                    <div class="form-group">
                        <label>Nouveau statut</label>
                        <select name="status" required>
                            <option value="">Sélectionner...</option>
                            <option value="pending">En attente</option>
                            <option value="confirmed">Confirmée</option>
                            <option value="completed">Terminée</option>
                            <option value="cancelled">Annulée</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Lien de réunion (optionnel)</label>
                        <input type="url" name="meet_link" placeholder="https://meet.google.com/...">
                    </div>
                    
                    <div class="form-group">
                        <label>Notes (optionnel)</label>
                        <textarea name="notes" rows="3" placeholder="Ajouter des notes..."></textarea>
                    </div>
                    
                    <div class="modal-actions">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('statusModal')">Annuler</button>
                        <button type="submit" class="btn btn-primary">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="/../../public/js/professional_dashboard.js"></script>
</body>
</html>