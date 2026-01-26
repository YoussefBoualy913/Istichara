<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Demandes - ISTICHARA</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
            min-height: 100vh;
        }

        .dashboard-layout {
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
            padding: 20px 0;
        }

        .brand {
            padding: 24px 20px;
            font-size: 24px;
            font-weight: 800;
            text-align: center;
            color: white;
            border-bottom: 1px solid #334155;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .sidebar-menu {
            padding: 20px 16px;
        }

        .sidebar-link {
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

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
        }

        .sidebar-link.active {
            background: rgba(59, 130, 246, 0.2);
            color: #ffffff;
            border-left: 4px solid #3b82f6;
        }

        .sidebar-link.logout {
            margin-top: 20px;
            background: rgba(239, 68, 68, 0.1);
            color: #fca5a5;
        }

        .sidebar-link.logout:hover {
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

        /* Filtres */
        .filters {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 8px 16px;
            border: 2px solid #e2e8f0;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
            color: #374151;
            font-size: 14px;
        }

        .filter-btn:hover {
            background: #f1f5f9;
            text-decoration: none;
        }

        .filter-btn.active {
            background: #1a2332;
            color: white;
            border-color: #1a2332;
        }

        /* Stats Summary */
        .stats-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-item {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
        }

        .stat-number {
            font-size: 24px;
            font-weight: 700;
            color: #1a2332;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 13px;
            color: #64748b;
        }

        /* Grid des demandes */
        .demands-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }

        .demand-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            transition: all 0.3s ease;
        }

        .demand-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .demand-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 10px;
        }

        .client-info {
            flex: 1;
        }

        .client-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 16px;
            margin-bottom: 4px;
        }

        .client-email {
            font-size: 13px;
            color: #64748b;
        }

        .demand-date {
            color: #64748b;
            font-size: 13px;
            margin-top: 5px;
        }

        /* Status badges */
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            min-width: 80px;
            text-align: center;
        }

        .status-badge.pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-badge.approved {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-badge.confirmed {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-badge.completed {
            background: #d1fae5;
            color: #065f46;
        }

        .status-badge.refused {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-badge.cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Forms */
        .demand-form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .input-label {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 5px;
            display: block;
        }

        .input-field {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.2s;
        }

        .input-field:focus {
            outline: none;
            border-color: #3b82f6;
        }

        .input-field:disabled {
            background: #f9fafb;
            cursor: not-allowed;
        }

        /* Buttons */
        .actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            flex: 1;
        }

        .btn-success {
            background: #10b981;
            color: white;
        }

        .btn-success:hover {
            background: #059669;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .disabled {
            opacity: 0.5;
            pointer-events: none;
        }

        /* Lien de réunion */
        .meet-link {
            color: #3b82f6;
            text-decoration: none;
            font-size: 14px;
            word-break: break-all;
            margin-top: 5px;
            display: inline-block;
        }

        .meet-link:hover {
            text-decoration: underline;
        }

        /* Aucune demande */
        .no-demands {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }

        .no-demands .material-icons {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .no-demands h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: #64748b;
        }

        .no-demands p {
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            
            .brand span:not(.material-icons) {
                display: none;
            }
            
            .sidebar-link span:not(.material-icons) {
                display: none;
            }
            
            .main-content {
                margin-left: 70px;
                padding: 20px;
            }
            
            .demands-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-summary {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="brand">
                <span class="material-icons">balance</span>
                <span>ISTICHARA</span>
            </div>
            
            <nav class="sidebar-menu">
                <a href="/professional/dashboard" class="sidebar-link">
                    <span class="material-icons">dashboard</span>
                    <span>Tableau de Bord</span>
                </a>
                
                <a href="/professional/demands" class="sidebar-link active">
                    <span class="material-icons">inbox</span>
                    <span>Mes Demandes</span>
                </a>
                
                <a href="/auth/logout" class="sidebar-link logout">
                    <span class="material-icons">logout</span>
                    <span>Déconnexion</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <h1>Mes Demandes</h1>
                
                <div class="user-profile">
                    <div class="avatar">
                        <?= strtoupper(substr($user_name ?? 'U', 0, 2)) ?>
                    </div>
                    <div class="user-info">
                        <span class="user-name"><?= htmlspecialchars($user_name) ?></span>
                        <span class="user-role">
                            <?= $user_role === 'AVOCAT' ? 'Avocat' : 'Huissier' ?>
                        </span>
                    </div>
                </div>
            </header>

            <!-- Résumé des statistiques -->
            <div class="stats-summary">
                <div class="stat-item">
                    <div class="stat-number"><?= $stats['total_demands'] ?? 0 ?></div>
                    <div class="stat-label">Total</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?= $stats['pending'] ?? 0 ?></div>
                    <div class="stat-label">En attente</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?= $stats['accepted'] ?? 0 ?></div>
                    <div class="stat-label">Acceptées</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?= $stats['completed'] ?? 0 ?></div>
                    <div class="stat-label">Terminées</div>
                </div>
            </div>

            <!-- Filtres -->
            <div class="filters">
                <a href="/professional/demands" class="filter-btn <?= $filter === 'all' ? 'active' : '' ?>">
                    Toutes (<?= count($demands) ?>)
                </a>
                <a href="/professional/demands?filter=pending" class="filter-btn <?= $filter === 'pending' ? 'active' : '' ?>">
                    En attente
                </a>
                <a href="/professional/demands?filter=accepted" class="filter-btn <?= $filter === 'accepted' ? 'active' : '' ?>">
                    Acceptées
                </a>
                <a href="/professional/demands?filter=refused" class="filter-btn <?= $filter === 'refused' ? 'active' : '' ?>">
                    Refusées
                </a>
                <a href="/professional/demands?filter=completed" class="filter-btn <?= $filter === 'completed' ? 'active' : '' ?>">
                    Terminées
                </a>
            </div>

            <!-- Grid des demandes -->
            <div class="demands-grid">
                <?php if (!empty($demands)): ?>
                    <?php foreach ($demands as $demand): ?>
                        <?php
                        $status = $demand['validation_status'] ?? 'pending';
                        $locked = !in_array($status, ['pending']);
                        
                        // Déterminer la classe CSS pour le statut
                        $statusClass = match($status) {
                            'pending' => 'pending',
                            'approved' => 'approved',
                            'confirmed' => 'confirmed',
                            'completed' => 'completed',
                            'refused' => 'refused',
                            'cancelled' => 'cancelled',
                            default => 'pending'
                        };
                        
                        // Texte du statut
                        $statusText = match($status) {
                            'pending' => 'En attente',
                            'approved' => 'Acceptée',
                            'confirmed' => 'Confirmée',
                            'completed' => 'Terminée',
                            'refused' => 'Refusée',
                            'cancelled' => 'Annulée',
                            default => ucfirst($status)
                        };
                        ?>
                        
                        <div class="demand-card">
                            <div class="demand-header">
                                <div class="client-info">
                                    <div class="client-name"><?= htmlspecialchars($demand['client_name']) ?></div>
                                    <div class="client-email"><?= htmlspecialchars($demand['client_email']) ?></div>
                                    <div class="demand-date"><?= htmlspecialchars($demand['formatted_date'] ?? $demand['created_at'] ?? '') ?></div>
                                </div>
                                <span class="status-badge <?= $statusClass ?>">
                                    <?= $statusText ?>
                                </span>
                            </div>
                            
                            <?php if ($demand['meet_link']): ?>
                                <div>
                                    <label class="input-label">Lien Google Meet</label>
                                    <a href="<?= htmlspecialchars($demand['meet_link']) ?>" 
                                       target="_blank" 
                                       class="meet-link">
                                        <span class="material-icons" style="vertical-align: middle; font-size: 16px;">video_call</span>
                                        <?= htmlspecialchars($demand['meet_link']) ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!$locked): ?>
                                <!-- Formulaire pour accepter/refuser -->
                                <div class="demand-form">
                                    <div>
                                        <label class="input-label" for="meet_link_<?= $demand['id'] ?>">
                                            Lien Google Meet (si acceptation)
                                        </label>
                                        <input type="url" 
                                               id="meet_link_<?= $demand['id'] ?>" 
                                               class="input-field"
                                               placeholder="https://meet.google.com/xxx-xxxx-xxx"
                                               required>
                                    </div>
                                    
                                    <div class="actions">
                                        <button type="button" 
                                                class="btn btn-success" 
                                                onclick="acceptDemand(<?= $demand['id'] ?>, 'meet_link_<?= $demand['id'] ?>')">
                                            <span class="material-icons">check_circle</span>
                                            Accepter
                                        </button>
                                        <button type="button" 
                                                class="btn btn-danger" 
                                                onclick="refuseDemand(<?= $demand['id'] ?>)">
                                            <span class="material-icons">cancel</span>
                                            Refuser
                                        </button>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div style="text-align: center; padding: 10px; color: #64748b; font-size: 14px;">
                                    <span class="material-icons" style="vertical-align: middle;">verified</span>
                                    Demande déjà traitée
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-demands">
                        <span class="material-icons">inbox</span>
                        <h3>Aucune demande trouvée</h3>
                        <p><?= $filter !== 'all' ? 'Aucune demande avec ce filtre.' : 'Vous n\'avez aucune demande pour le moment.' ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        // Fonction pour accepter une demande

    function acceptDemand(demandId, inputId) {
        const meetLink = document.getElementById(inputId).value;
        
        if (!meetLink) {
            alert('Veuillez entrer un lien de réunion Google Meet');
            return;
        }
        
        if (!meetLink.includes('http')) {
            alert('Veuillez entrer un lien valide (commençant par http:// ou https://)');
            return;
        }
        
        if (confirm('Êtes-vous sûr de vouloir accepter cette demande ?')) {
            updateDemandStatus(demandId, 'confirmed', meetLink);
        }
    }
    
    // Fonction pour refuser une demande
    function refuseDemand(demandId) {
        if (confirm('Êtes-vous sûr de vouloir refuser cette demande ?')) {
            updateDemandStatus(demandId, 'refused', '');
        }
    }
    
// Mettre à jour le statut via AJAX
function updateDemandStatus(demandId, status, meetLink) {
    console.log("=== SENDING REQUEST ===");
    console.log("Demand ID:", demandId);
    console.log("Status:", status);
    console.log("Meet Link:", meetLink);
    
    const formData = new FormData();
    formData.append('demand_id', demandId);
    formData.append('status', status);
    formData.append('meet_link', meetLink);
    
    console.log("Sending to: /professional/update-status");
    
    fetch('/professional/update-status', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        console.log("Response status:", response.status);
        
        // Vérifier le type de contenu
        const contentType = response.headers.get("content-type");
        console.log("Content-Type:", contentType);
        
        if (contentType && contentType.includes("application/json")) {
            return response.json();
        } else {
            return response.text().then(text => {
                console.error("Non-JSON response:", text);
                throw new Error("Expected JSON but got: " + text.substring(0, 100));
            });
        }
    })
    .then(data => {
        console.log("Response data:", data);
        
        if (data.success) {
            alert(data.message);
            // Recharger la page après 1 seconde
            setTimeout(() => {
                location.reload();
            }, 1000);
        } else {
            alert('Erreur: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Fetch Error:', error);
        alert('Erreur de communication: ' + error.message);
    });
}

    // Fonction pour refuser une demande
    function refuseDemand(demandId) {
        if (confirm('Êtes-vous sûr de vouloir refuser cette demande ?')) {
            updateDemandStatus(demandId, 'refused', '');
        }
    }
    
    // Mettre à jour le statut via AJAX
    function updateDemandStatus(demandId, status, meetLink) {
        console.log("=== SENDING REQUEST ===");
        console.log("Demand ID:", demandId);
        console.log("Status:", status);
        console.log("Meet Link:", meetLink);
        
        const formData = new FormData();
        formData.append('demand_id', demandId);
        formData.append('status', status);
        formData.append('meet_link', meetLink);
        
        console.log("FormData contents:");
        for (let [key, value] of formData.entries()) {
            console.log(key + ": " + value);
        }
        
        fetch('/professional/update-status', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            console.log("Response status:", response.status);
            console.log("Response headers:", response.headers);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const contentType = response.headers.get("content-type");
            console.log("Content-Type:", contentType);
            
            if (contentType && contentType.includes("application/json")) {
                return response.json();
            } else {
                return response.text().then(text => {
                    console.log("Non-JSON response:", text);
                    throw new Error("Expected JSON, got: " + text.substring(0, 100));
                });
            }
        })
        .then(data => {
            console.log("JSON Data received:", data);
            if (data.success) {
                alert(data.message);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            } else {
                alert('Erreur: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Fetch Error:', error);
            alert('Une erreur est survenue lors de la communication avec le serveur: ' + error.message);
        });
    }
    
    // Ajouter la validation en temps réel pour les liens
    document.addEventListener('DOMContentLoaded', function() {
        console.log("Page professional_demands.php loaded");
        
        const urlInputs = document.querySelectorAll('input[type="url"]');
        urlInputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.value && !this.value.startsWith('http')) {
                    this.style.borderColor = '#ef4444';
                } else {
                    this.style.borderColor = '#e2e8f0';
                }
            });
        });
    });


        
        // Ajouter la validation en temps réel pour les liens
        document.addEventListener('DOMContentLoaded', function() {
            const urlInputs = document.querySelectorAll('input[type="url"]');
            urlInputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (this.value && !this.value.startsWith('http')) {
                        this.style.borderColor = '#ef4444';
                    } else {
                        this.style.borderColor = '#e2e8f0';
                    }
                });
            });
            
            // Debug: Vérifier que les boutons fonctionnent
            console.log("Page professional_demands.php chargée");
            console.log("Nombre de demandes:", <?= count($demands) ?>);
        });
    </script>
</body>
</html>