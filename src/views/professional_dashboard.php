<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Professionnel - ISTICHARA</title>
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
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .stat-number {
            font-size: 28px;
            font-weight: 700;
            color: #1a2332;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        /* Content Cards */
        .content-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            transition: all 0.3s ease;
        }

        .content-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
            display: flex;
            align-items: center;
            gap: 6px;
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

        .status-badge.refused {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Actions buttons */
        .actions {
            display: flex;
            gap: 8px;
        }

        .btn-icon {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            padding: 8px 12px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .btn-icon:hover {
            background: #e2e8f0;
            transform: translateY(-2px);
        }

        /* Upcoming meetings */
        .meetings-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .meeting-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        .meeting-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .meeting-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .meeting-time {
            color: #3b82f6;
            font-weight: 600;
            font-size: 14px;
        }

        .meeting-client {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .meeting-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-outline {
            background: transparent;
            border: 2px solid #e2e8f0;
            color: #64748b;
        }

        .btn-outline:hover {
            background: #f1f5f9;
        }

        /* No data */
        .no-data {
            text-align: center;
            color: #94a3b8;
            padding: 40px 20px;
            font-style: italic;
        }

        .no-data .material-icons {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .no-data h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: #64748b;
        }

        .no-data p {
            font-size: 14px;
        }

        /* Profile section */
        .profile-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .info-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 15px;
            color: #1e293b;
            font-weight: 500;
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
            
            .stats-summary {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .meetings-grid {
                grid-template-columns: 1fr;
            }
            
            .profile-section {
                grid-template-columns: 1fr;
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
                <a href="/professional/dashboard" class="sidebar-link active">
                    <span class="material-icons">dashboard</span>
                    <span>Tableau de Bord</span>
                </a>
                
                <a href="/professional/demands" class="sidebar-link">
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
                <h1>Tableau de Bord</h1>
                
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
            <!-- Popup Modal pour les détails de la demande -->
<div id="demandDetailModal" class="modal" style="display: none;">
    <div class="modal-content" style="max-width: 600px; margin: 0% auto; background: white; border-radius: 12px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);">
        <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center; padding: 24px; border-bottom: 2px solid #f1f5f9;">
            <h2 style="color: #1a2332; font-size: 20px; margin: 0;">Détails de la Demande</h2>
            <span class="modal-close" style="font-size: 28px; color: #64748b; cursor: pointer; transition: color 0.2s;">&times;</span>
        </div>
        
        <div class="modal-body" style="padding: 24px;">
            <!-- Les détails seront chargés ici dynamiquement -->
            <div id="demandDetailsContent">
                <!-- Contenu chargé par JavaScript -->
            </div>
        </div>
        
        <div class="modal-footer" style="padding: 16px 24px; border-top: 2px solid #f1f5f9; display: flex; gap: 12px; justify-content: flex-end;">
            <button class="btn btn-secondary" onclick="closeDemandDetailModal()" style="padding: 10px 20px; background: #e2e8f0; border: none; border-radius: 8px; color: #374151; cursor: pointer; font-weight: 500;">
                Fermer
            </button>
            <button id="meetBtn" class="btn btn-primary" style="display: none; padding: 10px 20px; background: #3b82f6; border: none; border-radius: 8px; color: white; cursor: pointer; font-weight: 500;">
                <span class="material-icons" style="vertical-align: middle; font-size: 16px; margin-right: 6px;">videocam</span>
                Rejoindre la réunion
            </button>
            <button id="acceptBtn" class="btn btn-success" style="display: none; padding: 10px 20px; background: #10b981; border: none; border-radius: 8px; color: white; cursor: pointer; font-weight: 500;">
                <span class="material-icons" style="vertical-align: middle; font-size: 16px; margin-right: 6px;">check_circle</span>
                Accepter
            </button>
            <button id="refuseBtn" class="btn btn-danger" style="display: none; padding: 10px 20px; background: #ef4444; border: none; border-radius: 8px; color: white; cursor: pointer; font-weight: 500;">
                <span class="material-icons" style="vertical-align: middle; font-size: 16px; margin-right: 6px;">cancel</span>
                Refuser
            </button>
        </div>
    </div>
</div>

<style>
    /* Styles pour le modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .modal-content {
        animation: slideIn 0.3s ease;
    }
    
    @keyframes slideIn {
        from { transform: translateY(-50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    .modal-close:hover {
        color: #1f2937;
    }
    
    .btn {
        transition: all 0.2s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    /* Styles pour les détails */
    .demand-details {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    .detail-section {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    
    .detail-row {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
    
    .detail-item {
        flex: 1;
        min-width: 200px;
    }
    
    .detail-label {
        font-size: 12px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
        display: block;
    }
    
    .detail-value {
        font-size: 15px;
        color: #1e293b;
        font-weight: 500;
        padding: 10px 12px;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        word-break: break-word;
    }
    
    .status-badge-modal {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
        text-align: center;
        min-width: 80px;
    }
    
    .status-badge-modal.pending { background: #fef3c7; color: #92400e; }
    .status-badge-modal.confirmed { background: #dbeafe; color: #1e40af; }
    .status-badge-modal.completed { background: #d1fae5; color: #065f46; }
    .status-badge-modal.refused { background: #fee2e2; color: #991b1b; }
    .status-badge-modal.cancelled { background: #fee2e2; color: #991b1b; }
    
    .meet-link-container {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 8px;
    }
    
    .meet-link-modal {
        color: #3b82f6;
        text-decoration: none;
        font-size: 14px;
        word-break: break-all;
        flex: 1;
    }
    
    .meet-link-modal:hover {
        text-decoration: underline;
    }
    
    .copy-btn {
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 6px 10px;
        cursor: pointer;
        font-size: 12px;
        color: #64748b;
        transition: all 0.2s;
    }
    
    .copy-btn:hover {
        background: #e2e8f0;
        color: #374151;
    }
    
    .loading-spinner {
        text-align: center;
        padding: 40px;
        color: #64748b;
    }
    
    .spinner {
        border: 3px solid #f3f3f3;
        border-top: 3px solid #3b82f6;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 0 auto 16px;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<script>
    // Fonction pour afficher les détails d'une demande
    function viewDemandDetails(demandId) {
        // Afficher le modal
        const modal = document.getElementById('demandDetailModal');
        modal.style.display = 'block';
        
        // Afficher le spinner de chargement
        document.getElementById('demandDetailsContent').innerHTML = `
            <div class="loading-spinner">
                <div class="spinner"></div>
                <p>Chargement des détails...</p>
            </div>
        `;
        
        // Masquer tous les boutons d'action temporairement
        document.getElementById('meetBtn').style.display = 'none';
        document.getElementById('acceptBtn').style.display = 'none';
        document.getElementById('refuseBtn').style.display = 'none';
        
        // Récupérer les détails via AJAX
        fetch(`/professional/demand-details?id=${demandId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur réseau');
                }
                return response.json();
            })
            .then(data => {
                console.log("Détails reçus:", data);
                
                if (data.success && data.data) {
                    displayDemandDetails(data.data);
                } else {
                    showError('Impossible de charger les détails');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                showError('Erreur de chargement: ' + error.message);
            });
    }
    
    // Fonction pour afficher les détails dans le modal
    function displayDemandDetails(demand) {
        const contentDiv = document.getElementById('demandDetailsContent');
        
        // Déterminer le statut
        const status = demand.validation_status || 'pending';
        const statusClass = getStatusClass(status);
        const statusText = getStatusText(status);
        
        // Créer le HTML pour les détails
        contentDiv.innerHTML = `
            <div class="demand-details">
                <div class="detail-section">
                    <div class="detail-row">
                        <div class="detail-item">
                            <span class="detail-label">ID Demande</span>
                            <div class="detail-value">#${demand.id}</div>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Statut</span>
                            <div class="detail-value">
                                <span class="status-badge-modal ${statusClass}">${statusText}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="detail-row">
                        <div class="detail-item">
                            <span class="detail-label">Date</span>
                            <div class="detail-value">${demand.formatted_date || demand.date || 'Non spécifiée'}</div>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Type de Professionnel</span>
                            <div class="detail-value">
                                ${demand.avocat_id ? 'Avocat' : demand.huissier_id ? 'Huissier' : 'Non assigné'}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="detail-section">
                    <h3 style="color: #1a2332; font-size: 16px; margin-bottom: 12px;">Informations Client</h3>
                    <div class="detail-row">
                        <div class="detail-item">
                            <span class="detail-label">Nom Complet</span>
                            <div class="detail-value">${demand.client_name || 'Non spécifié'}</div>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Email</span>
                            <div class="detail-value">${demand.client_email || 'Non spécifié'}</div>
                        </div>
                    </div>
                    
                    <div class="detail-row">
                        <div class="detail-item">
                            <span class="detail-label">Téléphone</span>
                            <div class="detail-value">${demand.client_phone || 'Non spécifié'}</div>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">ID Client</span>
                            <div class="detail-value">${demand.user_id || 'Non spécifié'}</div>
                        </div>
                    </div>
                </div>
                
                ${demand.meet_link ? `
                <div class="detail-section">
                    <h3 style="color: #1a2332; font-size: 16px; margin-bottom: 12px;">Informations Réunion</h3>
                    <div class="detail-item">
                        <span class="detail-label">Lien de Réunion</span>
                        <div class="meet-link-container">
                            <a href="${demand.meet_link}" target="_blank" class="meet-link-modal">
                                <span class="material-icons" style="vertical-align: middle; font-size: 16px;">video_call</span>
                                ${demand.meet_link}
                            </a>
                            <button class="copy-btn" onclick="copyToClipboard('${demand.meet_link}')">
                                <span class="material-icons" style="font-size: 16px;">content_copy</span>
                            </button>
                        </div>
                    </div>
                </div>
                ` : ''}
                
                ${demand.notes ? `
                <div class="detail-section">
                    <h3 style="color: #1a2332; font-size: 16px; margin-bottom: 12px;">Notes</h3>
                    <div class="detail-item">
                        <div class="detail-value" style="white-space: pre-wrap;">${demand.notes}</div>
                    </div>
                </div>
                ` : ''}
            </div>
        `;
        
        // Afficher les boutons d'action appropriés
        const meetBtn = document.getElementById('meetBtn');
        const acceptBtn = document.getElementById('acceptBtn');
        const refuseBtn = document.getElementById('refuseBtn');
        
        // Si la demande a un lien de réunion et n'est pas refusée/annulée
        if (demand.meet_link && !['refused', 'cancelled'].includes(status)) {
            meetBtn.style.display = 'inline-flex';
            meetBtn.alignItems = 'center';
            meetBtn.onclick = () => {
                window.open(demand.meet_link, '_blank');
                closeDemandDetailModal();
            };
        }
        
        // Si la demande est en attente, montrer les boutons accepter/refuser
        if (status === 'pending') {
            acceptBtn.style.display = 'inline-flex';
            acceptBtn.alignItems = 'center';
            acceptBtn.onclick = () => {
                const meetLink = prompt('Veuillez entrer le lien Google Meet pour cette consultation:');
                if (meetLink && meetLink.includes('http')) {
                    updateDemandStatus(demand.id, 'confirmed', meetLink);
                    closeDemandDetailModal();
                } else if (meetLink) {
                    alert('Veuillez entrer un lien valide (commençant par http:// ou https://)');
                }
            };
            
            refuseBtn.style.display = 'inline-flex';
            refuseBtn.alignItems = 'center';
            refuseBtn.onclick = () => {
                if (confirm('Êtes-vous sûr de vouloir refuser cette demande ?')) {
                    updateDemandStatus(demand.id, 'refused', '');
                    closeDemandDetailModal();
                }
            };
        }
    }
    
    // Fonction pour afficher une erreur
    function showError(message) {
        document.getElementById('demandDetailsContent').innerHTML = `
            <div style="text-align: center; padding: 40px 20px; color: #ef4444;">
                <span class="material-icons" style="font-size: 48px; margin-bottom: 16px;">error</span>
                <h3 style="color: #991b1b; margin-bottom: 8px;">Erreur</h3>
                <p>${message}</p>
            </div>
        `;
    }
    
    // Fonction pour copier le lien dans le presse-papier
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            // Afficher un message temporaire
            const btn = event.target.closest('button');
            const originalHTML = btn.innerHTML;
            btn.innerHTML = '<span class="material-icons" style="font-size: 16px;">check</span>';
            btn.style.color = '#10b981';
            
            setTimeout(() => {
                btn.innerHTML = originalHTML;
                btn.style.color = '';
            }, 2000);
        }).catch(err => {
            console.error('Erreur de copie:', err);
            alert('Impossible de copier le lien');
        });
    }
    
    // Fonction pour fermer le modal
    function closeDemandDetailModal() {
        document.getElementById('demandDetailModal').style.display = 'none';
    }
    
    // Fonction utilitaire pour obtenir la classe CSS du statut
    function getStatusClass(status) {
        const statusMap = {
            'pending': 'pending',
            'approved': 'confirmed',
            'confirmed': 'confirmed',
            'completed': 'completed',
            'refused': 'refused',
            'cancelled': 'cancelled'
        };
        return statusMap[status] || 'pending';
    }
    
    // Fonction utilitaire pour obtenir le texte du statut
    function getStatusText(status) {
        const textMap = {
            'pending': 'En attente',
            'approved': 'Acceptée',
            'confirmed': 'Confirmée',
            'completed': 'Terminée',
            'refused': 'Refusée',
            'cancelled': 'Annulée'
        };
        return textMap[status] || status;
    }
    
    // Gestionnaires d'événements pour le modal
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('demandDetailModal');
        const closeBtn = document.querySelector('.modal-close');
        
        // Fermer le modal en cliquant sur X
        closeBtn.addEventListener('click', closeDemandDetailModal);
        
        // Fermer le modal en cliquant en dehors
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeDemandDetailModal();
            }
        });
        
        // Fermer avec la touche Échap
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && modal.style.display === 'block') {
                closeDemandDetailModal();
            }
        });
    });
    
    // Fonction updateDemandStatus (à garder si pas déjà définie)
    function updateDemandStatus(demandId, status, meetLink) {
        console.log("Mise à jour statut:", { demandId, status, meetLink });
        
        const formData = new FormData();
        formData.append('demand_id', demandId);
        formData.append('status', status);
        if (meetLink) {
            formData.append('meet_link', meetLink);
        }
        
        fetch('/professional/update-status', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                // Recharger la page pour voir les changements
                setTimeout(() => location.reload(), 1000);
            } else {
                alert('Erreur: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur de communication: ' + error.message);
        });
    }
</script>

            <!-- Résumé des statistiques -->
            <div class="stats-summary">
                <div class="stat-item">
                    <div class="stat-number"><?= $stats['total_demands'] ?? 0 ?></div>
                    <div class="stat-label">Total Demandes</div>
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

            <!-- Demandes Récentes -->
            <div class="content-card">
                <div class="card-header">
                    <h2>Demandes Récentes</h2>
                    <a href="/professional/demands" class="btn-link">
                        Voir tout
                        <span class="material-icons" style="font-size: 16px;">arrow_forward</span>
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($recent_demands)): ?>
                                <?php foreach ($recent_demands as $demand): ?>
                                    <?php
                                    $status = $demand['validation_status'] ?? 'pending';
                                    
                                    // Déterminer la classe CSS pour le statut
                                    $statusClass = match($status) {
                                        'pending' => 'pending',
                                        'approved' => 'confirmed',
                                        'confirmed' => 'confirmed',
                                        'completed' => 'completed',
                                        'refused' => 'cancelled',
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
                                    
                                    <tr>
                                        <td>
                                            <div class="client-info">
                                                <div class="client-name"><?= htmlspecialchars($demand['client_name'] ?? 'N/A') ?></div>
                                                <div class="client-email"><?= htmlspecialchars($demand['client_email'] ?? '') ?></div>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($demand['formatted_date'] ?? $demand['created_at'] ?? '') ?></td>
                                        <td>
                                            <span class="status-badge <?= $statusClass ?>">
                                                <?= $statusText ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <?php if ($status === 'pending'): ?>
                                                    <button class="btn-icon" 
                                                            onclick="quickAccept(<?= $demand['id'] ?>)"
                                                            title="Accepter rapidement">
                                                        <span class="material-icons" style="font-size: 16px; color: #10b981;">check_circle</span>
                                                        <span>Accepter</span>
                                                    </button>
                                                    <button class="btn-icon" 
                                                            onclick="quickRefuse(<?= $demand['id'] ?>)"
                                                            title="Refuser">
                                                        <span class="material-icons" style="font-size: 16px; color: #ef4444;">cancel</span>
                                                        <span>Refuser</span>
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn-icon" 
                                                            onclick="viewDemandDetails(<?= $demand['id'] ?>)"
                                                            title="Voir les détails">
                                                        <span class="material-icons" style="font-size: 16px; color: #3b82f6;">visibility</span>
                                                        <span>Détails</span>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">
                                        <div class="no-data">
                                            <span class="material-icons">inbox</span>
                                            <h3>Aucune demande récente</h3>
                                            <p>Vous n'avez aucune demande pour le moment</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Prochain Rendez-vous & Profil -->
            <div class="profile-section">
                <!-- Prochains Rendez-vous -->
                <div class="content-card">
                    <div class="card-header">
                        <h2>Prochains Rendez-vous</h2>
                        <a href="/professional/calendar" class="btn-link">
                            Voir calendrier
                            <span class="material-icons" style="font-size: 16px;">arrow_forward</span>
                        </a>
                    </div>

                    <?php if (!empty($upcoming_meetings)): ?>
                        <div class="meetings-grid">
                            <?php foreach ($upcoming_meetings as $meeting): ?>
                                <div class="meeting-card">
                                    <div class="meeting-header">
                                        <div class="meeting-client"><?= htmlspecialchars($meeting['client_name'] ?? 'Client') ?></div>
                                        <div class="meeting-time"><?= htmlspecialchars($meeting['meeting_time'] ?? 'Date non définie') ?></div>
                                    </div>
                                    
                                    <?php if (!empty($meeting['meet_link'])): ?>
                                        <div style="margin-bottom: 15px;">
                                            <a href="<?= htmlspecialchars($meeting['meet_link']) ?>" 
                                               target="_blank" 
                                               style="color: #3b82f6; text-decoration: none; font-size: 14px; word-break: break-all;">
                                                <span class="material-icons" style="vertical-align: middle; font-size: 16px;">video_call</span>
                                                Lien de réunion
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="meeting-actions">
                                        <a href="<?= htmlspecialchars($meeting['meet_link']) ?>" 
                                           target="_blank"
                                           class="btn btn-primary">
                                            <span class="material-icons" style="font-size: 16px;">videocam</span>
                                            Rejoindre
                                        </a>
                                        <button class="btn btn-outline" onclick="viewDemandDetails(<?= $meeting['id'] ?>)">
                                            <span class="material-icons" style="font-size: 16px;">info</span>
                                            Détails
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="no-data">
                            <span class="material-icons">event_available</span>
                            <h3>Aucun rendez-vous à venir</h3>
                            <p>Aucun rendez-vous programmé pour le moment</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Profil -->
                <div class="content-card">
                    <div class="card-header">
                        <h2>Votre Profil</h2>
                        <a href="/professional/profile" class="btn-link">
                            Modifier
                            <span class="material-icons" style="font-size: 16px;">edit</span>
                        </a>
                    </div>

                    <?php if (!empty($profile)): ?>
                        <div class="profile-info">
                            <div class="info-item">
                                <span class="info-label">Nom Complet</span>
                                <span class="info-value"><?= htmlspecialchars($profile['name'] ?? 'Non défini') ?></span>
                            </div>
                            
                            <div class="info-item">
                                <span class="info-label">Email</span>
                                <span class="info-value"><?= htmlspecialchars($profile['email'] ?? 'Non défini') ?></span>
                            </div>
                            
                            <div class="info-item">
                                <span class="info-label">Spécialité / Type d'actes</span>
                                <span class="info-value">
                                    <?= htmlspecialchars($profile['specialite'] ?? $profile['types_actes'] ?? 'Non spécifié') ?>
                                </span>
                            </div>
                            
                            <div class="info-item">
                                <span class="info-label">Ville</span>
                                <span class="info-value"><?= htmlspecialchars($profile['ville_name'] ?? 'Non spécifiée') ?></span>
                            </div>
                            
                            <div class="info-item">
                                <span class="info-label">Expérience</span>
                                <span class="info-value">
                                    <?= ($profile['years_of_experience'] ?? 0) ?> 
                                    <?= ($profile['years_of_experience'] == 1) ? 'année' : 'années' ?>
                                </span>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="no-data">
                            <span class="material-icons">person</span>
                            <h3>Profil non trouvé</h3>
                            <p>Complétez votre profil pour apparaître dans les recherches</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Fonctions pour les actions rapides
        function quickAccept(demandId) {
            const meetLink = prompt('Veuillez entrer le lien Google Meet pour cette consultation:');
            
            if (!meetLink) {
                alert('Veuillez entrer un lien de réunion');
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
        
        function quickRefuse(demandId) {
            if (confirm('Êtes-vous sûr de vouloir refuser cette demande ?')) {
                updateDemandStatus(demandId, 'refused', '');
            }
        }
        
function viewDemandDetails(demandId) {
    // Utiliser le modal au lieu d'ouvrir un nouvel onglet
    const modal = document.getElementById('demandDetailModal');
    modal.style.display = 'block';
    
    // Afficher le spinner de chargement
    document.getElementById('demandDetailsContent').innerHTML = `
        <div class="loading-spinner">
            <div class="spinner"></div>
            <p>Chargement des détails...</p>
        </div>
    `;
    
    // Masquer tous les boutons d'action temporairement
    document.getElementById('meetBtn').style.display = 'none';
    document.getElementById('acceptBtn').style.display = 'none';
    document.getElementById('refuseBtn').style.display = 'none';
    
    // Récupérer les détails via AJAX
    fetch(`/professional/demand-details?id=${demandId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur réseau');
            }
            return response.json();
        })
        .then(data => {
            console.log("Détails reçus:", data);
            
            if (data.success && data.data) {
                displayDemandDetails(data.data);
            } else {
                showError('Impossible de charger les détails');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showError('Erreur de chargement: ' + error.message);
        });
}
        
        // Mettre à jour le statut via AJAX (même fonction que dans professional_demands.php)
        function updateDemandStatus(demandId, status, meetLink) {
            console.log("=== SENDING REQUEST ===");
            console.log("Demand ID:", demandId);
            console.log("Status:", status);
            console.log("Meet Link:", meetLink);
            
            const formData = new FormData();
            formData.append('demand_id', demandId);
            formData.append('status', status);
            formData.append('meet_link', meetLink);
            
            fetch('/professional/update-status', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log("Response status:", response.status);
                
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
        
        // Ajouter la validation en temps réel pour les liens
        document.addEventListener('DOMContentLoaded', function() {
            console.log("Page professional_dashboard.php loaded");
            
            // Ajouter des écouteurs d'événements pour les liens dynamiques
            const links = document.querySelectorAll('a[href*="meet.google.com"], a[href*="zoom.us"], a[href*="teams.microsoft.com"]');
            links.forEach(link => {
                link.setAttribute('target', '_blank');
                link.setAttribute('rel', 'noopener noreferrer');
            });
        });
    </script>
</body>
</html>