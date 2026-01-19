<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Avocats - ISTICHARA</title>
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
                <a href="avocats" class="sidebar-link active">
                    <i class="fas fa-users-cog"></i>
                    Gestion Avocats
                </a>
                <a href="Huissiers" class="sidebar-link">
                    <i class="fas fa-gavel"></i>
                    Gestion Huissiers
                </a>
                <a href="visiteur" class="sidebar-link" style="margin-top: auto;">
                    <i class="fas fa-sign-out-alt"></i>
                    Retour au site
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">

            <header class="flex justify-between items-center" style="margin-bottom: 2rem;">
                <h2 style="font-size: 1.75rem;">Gestion des Avocats</h2>
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

            <!-- Professionals List -->
            <div class="card">
                <div class="flex justify-between items-center" style="margin-bottom: 1.5rem;">
                    <h3>Liste des Avocats</h3>
                    <a href="./avocat/create?ref='av'" class="btn btn-primary">
                        <i class="fas fa-plus" style="margin-right: 0.5rem;"></i> Ajouter un Avocat
                    </a>
                </div>

                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom & Prénom</th>
                                <th>Ville</th>
                                <th>Spécialités</th>
                                <th>Experience</th>
                                <th>C. en ligne</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php foreach($result as $item){  ?> 
                            <tr>
                                <td style="font-weight: 500;"><?= $item['nom'] ?></td>
                                <td><?= $item['villename'] ?></td>
                                <td><?= $item['specialite'] ?></td>
                                <td><?= $item['years_of_experience'] ?></td>
                                <td><?= $item['consoltation_en_ligne'] ?></td>
                                <td>
                                    <a href="./avocat/edit? avocat_id=<?=$item['id'] ?>"  class="btn btn-outline"
                                        style="padding: 0.25rem 0.5rem; font-size: 0.8rem;"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="./avocat/destroy? avocat_id=<?=$item['id'] ?>" class="btn btn-outline"
                                        style="padding: 0.25rem 0.5rem; font-size: 0.8rem; color: var(--danger); border-color: var(--danger);"><i
                                            class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                             <?php } ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

</body>

</html>