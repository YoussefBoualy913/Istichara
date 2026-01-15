
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - ISTICHARA</title>
    <link rel="stylesheet" href="../css/style.css">
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
                <a href="#" class="sidebar-link">
                    <i class="fas fa-users-cog"></i>
                    Gestion Avocats
                </a>
                <a href="#" class="sidebar-link">
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
                        <div style="font-size: 2rem; font-weight: 700;">124</div>
                        <div style="color: var(--text-muted);">Avocats Inscrits</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: #fefce8; color: var(--accent);">
                        <i class="fas fa-file-signature"></i>
                    </div>
                    <div>
                        <div style="font-size: 2rem; font-weight: 700;">86</div>
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
                        <h3>Liste des Professionnels</h3>
                        <button onclick="openModal()" class="btn btn-primary">
                            <i class="fas fa-plus" style="margin-right: 0.5rem;"></i> Ajouter
                        </button>
                    </div>

                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom & Prénom</th>
                                    <th>Type</th>
                                    <th>Ville</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-weight: 500;">Me. Karim Bennani</td>
                                    <td><span class="badge badge-blue">Avocat</span></td>
                                    <td>Casablanca</td>
                                    <td>
                                        <button class="btn btn-outline"
                                            style="padding: 0.25rem 0.5rem; font-size: 0.8rem;"><i
                                                class="fas fa-edit"></i></button>
                                        <button class="btn btn-outline"
                                            style="padding: 0.25rem 0.5rem; font-size: 0.8rem; color: var(--danger); border-color: var(--danger);"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 500;">Mr. Omar Tazi</td>
                                    <td><span class="badge badge-gold">Huissier</span></td>
                                    <td>Marrakech</td>
                                    <td>
                                        <button class="btn btn-outline"
                                            style="padding: 0.25rem 0.5rem; font-size: 0.8rem;"><i
                                                class="fas fa-edit"></i></button>
                                        <button class="btn btn-outline"
                                            style="padding: 0.25rem 0.5rem; font-size: 0.8rem; color: var(--danger); border-color: var(--danger);"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-weight: 500;">Me. Salma Idrissi</td>
                                    <td><span class="badge badge-blue">Avocat</span></td>
                                    <td>Rabat</td>
                                    <td>
                                        <button class="btn btn-outline"
                                            style="padding: 0.25rem 0.5rem; font-size: 0.8rem;"><i
                                                class="fas fa-edit"></i></button>
                                        <button class="btn btn-outline"
                                            style="padding: 0.25rem 0.5rem; font-size: 0.8rem; color: var(--danger); border-color: var(--danger);"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
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
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Casablanca</td>
                                    <td style="font-weight: bold;">45</td>
                                </tr>
                                <tr>
                                    <td>Rabat</td>
                                    <td style="font-weight: bold;">32</td>
                                </tr>
                                <tr>
                                    <td>Marrakech</td>
                                    <td style="font-weight: bold;">28</td>
                                </tr>
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
                                <div style="font-weight: 600;">Me. Alami</div>
                                <div style="font-size: 0.8rem; color: var(--text-muted);">35 ans d'expérience</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4"
                            style="margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border);">
                            <div style="font-weight: 700; color: var(--accent); font-size: 1.25rem;">2</div>
                            <div>
                                <div style="font-weight: 600;">Me. Tazi</div>
                                <div style="font-size: 0.8rem; color: var(--text-muted);">28 ans d'expérience</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div style="font-weight: 700; color: var(--accent); font-size: 1.25rem;">3</div>
                            <div>
                                <div style="font-weight: 600;">Me. Bennis</div>
                                <div style="font-size: 0.8rem; color: var(--text-muted);">25 ans d'expérience</div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </main>
    </div>

    <!-- Modal Form -->
    <div id="modal" class="modal-overlay">
        <div class="modal">
            <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
                <h3>Ajouter un Professionnel</h3>
                <button onclick="closeModal()"
                    style="background:none; border:none; cursor:pointer; font-size: 1.25rem;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form>
                <!-- Toggle Type -->
                <div class="flex justify-center" style="margin-bottom: 1.5rem;">
                    <div class="toggle-container">
                        <div id="btn-avocat" class="toggle-option active" onclick="toggleForm('avocat')">Avocat</div>
                        <div id="btn-huissier" class="toggle-option" onclick="toggleForm('huissier')">Huissier</div>
                    </div>
                </div>

                <!-- Common Fields -->
                <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div class="input-group">
                        <label class="label">Nom</label>
                        <input type="text" class="input" placeholder="Nom">
                    </div>
                    <div class="input-group">
                        <label class="label">Prénom</label>
                        <input type="text" class="input" placeholder="Prénom">
                    </div>
                </div>

                <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div class="input-group">
                        <label class="label">Email</label>
                        <input type="email" class="input" placeholder="email@exemple.com">
                    </div>
                    <div class="input-group">
                        <label class="label">Téléphone</label>
                        <input type="tel" class="input" placeholder="06...">
                    </div>
                </div>

                <div class="input-group" style="margin-bottom: 1rem;">
                    <label class="label">Ville</label>
                    <select class="select">
                        <option>Casablanca</option>
                        <option>Rabat</option>
                        <!-- etc -->
                    </select>
                </div>

                <!-- AVOCAT SPECIFIC FIELDS -->
                <div id="fields-avocat">
                    <div class="input-group" style="margin-bottom: 1rem;">
                        <label class="label">Spécialités</label>
                        <input type="text" class="input" placeholder="Ex: Pénal, Civil, Affaires...">
                        <small style="color: var(--text-light);">Séparer par des virgules</small>
                    </div>

                    <div class="flex items-center gap-2" style="margin-bottom: 1rem;">
                        <input type="checkbox" id="consult-online">
                        <label for="consult-online" class="label" style="cursor:pointer;">Propose la consultation en
                            ligne</label>
                    </div>
                </div>

                <!-- HUISSIER SPECIFIC FIELDS -->
                <div id="fields-huissier" style="display: none;">
                    <div class="input-group" style="margin-bottom: 1rem;">
                        <label class="label">Types d'actes autorisés</label>
                        <select class="select" multiple style="height: 100px;">
                            <option>Signification</option>
                            <option>Exécution</option>
                            <option>Constats</option>
                        </select>
                        <small style="color: var(--text-light);">Maintenir Ctrl pour sélectionner plusieurs</small>
                    </div>
                </div>

                <div class="flex gap-4" style="margin-top: 2rem;">
                    <button type="button" class="btn btn-outline" style="flex:1;"
                        onclick="closeModal()">Annuler</button>
                    <button type="submit" class="btn btn-primary" style="flex:1;">Enregistrer</button>
                </div>

            </form>
        </div>
    </div>

    <script>
       
    </script>
</body>

</html>
