<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Professionnel - Istichara</title>
    <link rel="stylesheet" href="/public/css/professional_dashboard.css">
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
                
                <a href="/professional/calendar" class="nav-item">
                    <span class="icon">📅</span>
                    <span>Calendrier</span>
                </a>
                
                <a href="/professional/clients" class="nav-item">
                    <span class="icon">👥</span>
                    <span>Mes Clients</span>
                </a>
                
                <a href="/professional/documents" class="nav-item">
                    <span class="icon">📄</span>
                    <span>Documents</span>
                </a>
                
                <a href="/professional/profile" class="nav-item">
                    <span class="icon">⚙️</span>
                    <span>Paramètres</span>
                </a>
                
                <a href="/auth/logout" class="nav-item logout">
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
                
                <div class="header-actions">
                    <div class="notifications">
                        <span class="icon">🔔</span>
                    </div>
                    
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
                </div>
            </header>

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon blue">📊</div>
                    <div class="stat-content">
                        <h3><?= $stats['total_demands'] ?? 0 ?></h3>
                        <p>Total Demandes</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon orange">⏳</div>
                    <div class="stat-content">
                        <h3><?= $stats['pending'] ?? 0 ?></h3>
                        <p>En Attente</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon green">✅</div>
                    <div class="stat-content">
                        <h3><?= $stats['confirmed'] ?? 0 ?></h3>
                        <p>Confirmées</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon yellow">🏁</div>
                    <div class="stat-content">
                        <h3><?= $stats['completed'] ?? 0 ?></h3>
                        <p>Terminées</p>
                    </div>
                </div>
            </div>

            <!-- Main Grid -->
            <div class="content-grid">
                <!-- Recent Demands -->
                <div class="content-card large">
                    <div class="card-header">
                        <h2>Demandes Récentes</h2>
                        <a href="/professional/demands" class="btn-link">Voir tout →</a>
                    </div>

                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Référence</th>
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
                                                <div class="action-buttons">
                                                    <button class="btn-icon" onclick="viewDemand(<?= $demand['id'] ?>)" title="Voir détails">
                                                        👁️
                                                    </button>
                                                    <button class="btn-icon" onclick="updateStatus(<?= $demand['id'] ?>)" title="Mettre à jour">
                                                        ✏️
                                                    </button>
                                                </div>
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

                <!-- Right Sidebar -->
                <div class="sidebar-content">
                    <!-- Profile Card -->
                    <div class="content-card">
                        <div class="card-header">
                            <h3>Mon Profil</h3>
                        </div>
                        <div class="profile-info">
                            <?php if (!empty($profile)): ?>
                                <div class="profile-detail">
                                    <span class="label">Ville:</span>
                                    <span class="value"><?= htmlspecialchars($profile['ville_name'] ?? 'Non spécifiée') ?></span>
                                </div>
                                <div class="profile-detail">
                                    <span class="label">Expérience:</span>
                                    <span class="value"><?= htmlspecialchars($profile['years_of_experience'] ?? '0') ?> ans</span>
                                </div>
                                <?php if ($_SESSION['user_role'] === 'avocat'): ?>
                                    <div class="profile-detail">
                                        <span class="label">Spécialité:</span>
                                        <span class="value"><?= htmlspecialchars($profile['specialite'] ?? 'Non spécifiée') ?></span>
                                    </div>
                                <?php else: ?>
                                    <div class="profile-detail">
                                        <span class="label">Types d'actes:</span>
                                        <span class="value"><?= htmlspecialchars($profile['types_actes'] ?? 'Non spécifiés') ?></span>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <p class="no-data">Profil non trouvé</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="content-card">
                        <div class="card-header">
                            <h3>Actions Rapides</h3>
                        </div>
                        <div class="quick-actions">
                            <button class="action-btn primary" onclick="window.location.href='/professional/demands?filter=pending'">
                                <span class="icon">📋</span>
                                <span>Voir les demandes en attente</span>
                            </button>
                            <button class="action-btn secondary" onclick="window.location.href='/professional/profile'">
                                <span class="icon">✏️</span>
                                <span>Modifier mon profil</span>
                            </button>
                        </div>
                    </div>

                    <!-- Upcoming Meetings -->
                    <?php if (!empty($upcoming_meetings)): ?>
                        <div class="content-card">
                            <div class="card-header">
                                <h3>Rendez-vous à venir</h3>
                            </div>
                            <div class="meetings-list">
                                <?php foreach ($upcoming_meetings as $meeting): ?>
                                    <div class="meeting-item">
                                        <div class="meeting-time"><?= htmlspecialchars($meeting['meeting_time']) ?></div>
                                        <div class="meeting-client"><?= htmlspecialchars($meeting['client_name']) ?></div>
                                        <?php if (!empty($meeting['meet_link'])): ?>
                                            <a href="<?= htmlspecialchars($meeting['meet_link']) ?>" target="_blank" class="meet-link">
                                                🔗 Rejoindre
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
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
        <div class="modal-content small">
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
                            <option value="">Sélectionner un statut</option>
                            <option value="pending">En attente</option>
                            <option value="confirmed">Confirmée</option>
                            <option value="completed">Terminée</option>
                            <option value="cancelled">Annulée</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Lien de réunion (optionnel)</label>
                        <input type="url" name="meet_link" placeholder="https://meet.google.com/xxx-yyyy-zzz">
                    </div>
                    <div class="form-group">
                        <label>Notes (optionnel)</label>
                        <textarea name="notes" rows="3" placeholder="Ajoutez des notes..."></textarea>
                    </div>
                    <div class="modal-actions">
                        <button type="button" class="btn btn-secondary" onclick="closeModal('statusModal')">Annuler</button>
                        <button type="submit" class="btn btn-primary">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="/public/js/professional_dashboard.js"></script>
</body>
</html>