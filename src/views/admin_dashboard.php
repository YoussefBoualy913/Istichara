<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - ISTICHARA</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <div class="dashboard-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="brand" style="margin-bottom: 2rem;">
                <i class="fas fa-balance-scale"></i>
                <span style="color:white; margin-left:10px;">ISTICHARA</span>
            </div>

            <nav class="sidebar-menu">
                <a href="#" class="sidebar-link active">
                    <i class="fas fa-chart-pie"></i>
                    Tableau de Bord
                </a>
                <a href="avocats.html" class="sidebar-link">
                    <i class="fas fa-users-cog"></i>
                    Gestion Avocats
                </a>
                <a href="huissiers.html" class="sidebar-link">
                    <i class="fas fa-gavel"></i>
                    Gestion Huissiers
                </a>
                <a href="index.html" class="sidebar-link" style="margin-top: auto;">
                    <i class="fas fa-sign-out-alt"></i>
                    Retour au site
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">

            <header class="flex justify-between items-center" style="margin-bottom: 2rem;">
                <h2 style="font-size: 1.75rem;">Tableau de Bord</h2>
                <div class="flex gap-4 items-center">
                    <div
                        style="background: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 1px solid var(--border);">
                        <i class="fas fa-bell" style="color: var(--text-muted);"></i>
                    </div>
                    <div class="flex items-center gap-2">
                        <div
                            style="width: 40px; height: 40px; background: var(--primary); border-radius: 50%; color: white; display: flex; align-items: center; justify-content: center;">
                            AD
                        </div>
                        <span style="font-weight: 500;">Admin User</span>
                    </div>
                </div>
            </header>

            <!-- Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon" style="background: #eff6ff; color: var(--primary);">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div>
                        <div style="font-size: 2rem; font-weight: 700;"><?=$totalavocat ?></div>
                        <div style="color: var(--text-muted);">Avocats Inscrits</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: #fefce8; color: var(--accent);">
                        <i class="fas fa-file-signature"></i>
                    </div>
                    <div>
                        <div style="font-size: 2rem; font-weight: 700;"><?=$totalhuissier?></div>
                        <div style="color: var(--text-muted);">Huissiers Inscrits</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: #ecfdf5; color: var(--success);">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <div style="font-size: 2rem; font-weight: 700;">450</div>
                        <div style="color: var(--text-muted);">Dossiers Traités</div>
                    </div>
                </div>
            </div>

            <!-- Content Grid: Professional List & Distribution -->
            <div class="grid" style="grid-template-columns: 2fr 1fr; gap: 2rem;">

                <!-- Professionals List -->
                <div class="card">
                    <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
                        <h3>Liste des Professionnels Panding</h3>
                    </div>

                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom & Prénom</th>
                                    <th>status</th>
                                   
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php foreach($InactifProfessionnlle as $item){ ?>
                                <tr>
                                    <td style="font-weight: 500;"><?=$item['name'] ?></td>
                                    <td><span class="badge badge-gold">panding</span></td>
                                   
                                    <td>
                                      

                                        <a href="" class="btn btn-outline btn-info" title="Détails">
                                           <i class="fas fa-file-alt"></i>
                                         </a>
                                         <a href="" class="btn btn-outline" title="Valider"><i class="fas fa-check"></i></a>
       
                                </tr>
                                <?php }; ?>
                                
                                 
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Distribution Stats -->
                <div class="flex" style="flex-direction: column; gap: 1.5rem;">

                    <div class="card">
                        <h3 style="margin-bottom: 1rem;">Répartition par Ville</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Ville</th>
                                    <th>avocat</th>
                                    <th>huissire</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <?php foreach($totalPparville as $item){ ?>
                                <tr>
                                    <td><?= $item['name'] ?></td>
                                    <td style="font-weight: bold;"><?= $item['totalavocat'] ?></td>
                                    <td style="font-weight: bold;"><?= $item['totalhuissier'] ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="card">
                        <h3 style="margin-bottom: 1rem;">Top Avocats (Exp.)</h3>
                        <!-- Top 3 Avocats par expérience -->
                         <div class="flex items-center gap-4"
                            style="margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border);">
                            <div style="font-weight: 700; color: var(--accent); font-size: 1.25rem;">1</div>
                            <div>
                                <div style="font-weight: 600;"><?= $topAvocat['0']['name'] ?></div>
                                <div style="font-size: 0.8rem; color: var(--text-muted);"><?= $topAvocat['0']['years_of_experience'] ?> ans d'expérience</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4"
                            style="margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border);">
                            <div style="font-weight: 700; color: var(--accent); font-size: 1.25rem;">2</div>
                            <div>
                                <div style="font-weight: 600;"><?= $topAvocat['1']['name'] ?></div>
                                <div style="font-size: 0.8rem; color: var(--text-muted);"><?= $topAvocat['1']['years_of_experience'] ?> ans d'expérience</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div style="font-weight: 700; color: var(--accent); font-size: 1.25rem;">3</div>
                            <div>
                                <div style="font-weight: 600;"><?= $topAvocat['2']['name'] ?></div>
                                <div style="font-size: 0.8rem; color: var(--text-muted);"><?= $topAvocat['2']['years_of_experience'] ?> ans d'expérience</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </main>
    </div>

            </form>
        </div>
    </div>

    
</body>

</html>