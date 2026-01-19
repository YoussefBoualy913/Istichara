<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Avocat - ISTICHARA</title>
    <link rel="stylesheet" href="/../../src/css/style.css">
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
                <a href="dashboard" class="sidebar-link">
                    <i class="fas fa-chart-pie"></i>
                    Tableau de Bord
                </a>
                <a href="../avocats" class="sidebar-link ">
                    <i class="fas fa-users-cog"></i>
                    Gestion Avocats
                </a>
                <a href="../Huissiers" class="sidebar-link active">
                    <i class="fas fa-gavel"></i>
                    Gestion Huissiers
                </a>
                <a href="./visiteur" class="sidebar-link" style="margin-top: auto;">
                    <i class="fas fa-sign-out-alt"></i>
                    Retour au site
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">

            <header class="flex justify-between items-center" style="margin-bottom: 2rem;">
                <h2 style="font-size: 1.75rem;">Modifier un Huissiers</h2>
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

            <!-- Form Card -->
            <div class="card" style="max-width: 800px; margin: 0 auto;">
                <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
                    <h3>Nouveau Profil Huissiers</h3>
                </div>

                <form method="POST" action="../Huissiers/update? Huissiers_id=<?=$result['id']?>">
                    <!-- Common Fields -->
                    <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div class="input-group">
                            <label class="label">Nom complet</label>
                            <input type="text" value="<?=$result['nom'] ?>" name="nom" class="input" placeholder="Ex:youssef">
                            <input type="hidden" value="<?=$result['ville_id'] ?>" name="ville_id" class="input" placeholder="Ex:youssef">
                        </div>
                        <div class="input-group">
                            <label class="label">Email</label>
                            <input type="email" value="<?=$result['email'] ?>"  name="email" class="input" placeholder="Ex:email@exemple.com">
                        </div>
                    </div>

                    <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        
                    <div class="input-group" style="margin-bottom: 1rem;">
                        <label class="label">Ville</label>
                        <input type="text" value="<?=$result['villename'] ?>"  class="input" name="ville" placeholder="Ex:Zagora">
                    </div>
                    </div>

                   

                    <!-- AVOCAT SPECIFIC FIELDS -->
                   
                        
                         <div class="input-group" style="margin-bottom: 1rem;">
                            <label class="label">years of experience </label>
                            <input type="number" value="<?=$result['years_of_experience'] ?>"  name="years_of_experience" class="input" min="0" placeholder="Ex:4 ">
                            
                        </div>

                       

                    <div class="grid Avocat" style="grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                        <div class="input-group Huissiers" style="margin-bottom: 1rem">
                            <label class="label">types actes</label>
                             <select class="select" name="types_actes" value="<?=$result['types_actes'] ?>">
                                  <option>constats</option>
                                  <option>exécution</option>
                                  <option>Signification</option>
                             </select>
                    </div>
                    </div>
               

                    <div class="flex gap-4" style="margin-top: 2rem;">
                        <a href="../dashborad" class="btn btn-outline" style="flex:1; text-align:center;">Annuler</a>
                        <button type="submit" class="btn btn-primary" style="flex:1;">Enregistrer</button>
                    </div>

                </form>
            </div>

        </main>
    </div>

</body>

</html>