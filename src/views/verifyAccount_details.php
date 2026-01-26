<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails Professionnel - Admin ISTICHARA</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <div class="dashboard-layout">
        <!-- Sidebar (Consistent with admin.html) -->
        <aside class="sidebar">
            <div class="brand" style="margin-bottom: 2rem;">
                <i class="fas fa-balance-scale"></i>
                <span style="color:white; margin-left:10px;">ISTICHARA</span>
            </div>

            <nav class="sidebar-menu">
                <a href="../dashboard" class="sidebar-link">
                    <i class="fas fa-chart-pie"></i>
                    Tableau de Bord
                </a>
                <a href="../avocats" class="sidebar-link">
                    <i class="fas fa-users-cog"></i>
                    Gestion Avocats
                </a>
                <a href="../Huissiers" class="sidebar-link">
                    <i class="fas fa-gavel"></i>
                    Gestion Huissiers
                </a>
                <a href="../visiteur" class="sidebar-link" style="margin-top: auto;">
                    <i class="fas fa-sign-out-alt"></i>
                    Retour au site
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">

            <header class="flex justify-between items-center" style="margin-bottom: 2rem;">
                <div class="flex items-center gap-2">
                    <a href="admin.html" style="color: var(--text-muted);"><i class="fas fa-arrow-left"></i> Retour</a>
                    <h2 style="font-size: 1.75rem; margin-left: 1rem;">Détails du Professionnel</h2>
                </div>

                <div class="flex gap-4 items-center">
                    <div
                        style="background: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 1px solid var(--border);">
                        <i class="fas fa-bell" style="color: var(--text-muted);"></i>
                    </div>
                </div>
            </header>

            <!-- Status Banner -->
            <div class="card" style="background: #fffbeb; border-left: 4px solid #f59e0b; margin-bottom: 2rem;">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <i class="fas fa-clock" style="font-size: 1.5rem; color: #f59e0b;"></i>
                        <div>
                            <h3 style="font-size: 1.1rem; color: #92400e;">En attente de validation</h3>
                            <p style="color: #b45309; margin: 0;">Ce compte est en attente de vérification des
                                documents.</p>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <span class="badge" style="background: #fff; color: #f59e0b; border: 1px solid #fcd34d;">Soumis
                            le 21/01/2026</span>
                    </div>
                </div>
            </div>

            <div class="grid" style="grid-template-columns: 350px 1fr; gap: 2rem; align-items: start;">

                <!-- Left Column: Profile Info -->
                <div class="flex" style="flex-direction: column; gap: 1.5rem;">

                    <div class="card profile-card" style="text-align: center;">
                        <div
                            style="width: 120px; height: 120px; background: #e2e8f0; border-radius: 50%; margin: 0 auto 1.5rem; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user" style="font-size: 3rem; color: #94a3b8;"></i>
                            <!-- <img src="..." alt="Profile" style="width: 100%; height: 100%; object-fit: cover;"> -->
                        </div>
                        <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Me.<?=$professionnlle[0]->getName() ?></h2>
                          <?php if($professionnlle[0]->getRole() === "avocat"){ 
                                
                         echo '     <span class="badge badge-blue" style="font-size: 1rem; padding: 0.5rem 1rem;">Avocat</span>';
                                 }?>
                         <?php if($professionnlle[0]->getRole() === "huissier"){ 
                                
                         echo '     <span class="badge badge-gold" style="font-size: 1rem; padding: 0.5rem 1rem;">Huissier</span>';
                                 }?>

                        <div
                            style="margin-top: 1.5rem; border-top: 1px solid var(--border); padding-top: 1rem; text-align: left;">
                            <div style="margin-bottom: 0.75rem;">
                                <i class="fas fa-map-marker-alt" style="width: 20px; color: var(--text-muted);"></i>
                                <span style="font-weight: 500;"><?=$professionnlle[0]->getVille_name() ?></span>
                            </div>
                            <div style="margin-bottom: 0.75rem;">
                                <i class="fas fa-envelope" style="width: 20px; color: var(--text-muted);"></i>
                                <span><?=$professionnlle[0]->getEmail() ?></span>
                            </div>
                           
                        </div>
                    </div>

                    <div class="card">
                        <h3
                            style="margin-bottom: 1rem; border-bottom: 1px solid var(--border); padding-bottom: 0.5rem;">
                            Info Professionnelles</h3>

                        <div style="margin-bottom: 1rem;">
                            <label
                                style="color: var(--text-muted); font-size: 0.85rem; display: block; margin-bottom: 0.25rem;">
                               <?php if($professionnlle[0]->getRole() === "avocat"){ 
                                    echo "Specialite";
                                 };
                                 if($professionnlle[0]->getRole() === "huissier"){ 
                                    echo "Types_actes";
                                 };
                                 ?>
                            </label>
                            <div class="flex gap-2 flex-wrap">

                                <?php if($professionnlle[0]->getRole() === "avocat"){ 

                                   
                               echo' <span class="badge" style="background: #f1f5f9; color: #475569;">'.$professionnlle[0]->getSpecialite() .'</span>';
                                 }; ?>
                                  <?php if($professionnlle[0]->getRole() === "huissier"){ 
                                   
                               echo' <span class="badge" style="background: #f1f5f9; color: #475569;">'.$professionnlle[0]->getTypes_actes().'</span>';
                                 }; ?>
                            </div>
                        </div>

                        <div style="margin-bottom: 1rem;">
                            <label
                                style="color: var(--text-muted); font-size: 0.85rem; display: block; margin-bottom: 0.25rem;">Expérience</label>
                            <span style="font-weight: 600;"><?=$professionnlle[0]->getYears_of_experience() ?> ans</span>
                        </div>

                        <div style="margin-bottom: 1rem;">
                             
                         <?php if($professionnlle[0]->getRole() === "avocat"){ 
                                
                           echo '  <label
                                 style="color: var(--text-muted); font-size: 0.85rem; display: block; margin-bottom: 0.25rem;">Consultation
                                 en ligne</label>';
                            if($professionnlle[0]->getConsoltation_en_ligne()){
                            echo ' <span style="color: var(--success); font-weight: 600;"><i class="fas fa-check-circle"></i>
                                 Activé</span> ';}
                                 
                            if(!$professionnlle[0]->getConsoltation_en_ligne()){
                            echo ' <span style="color: var(--accent); font-weight: 600;"><i class="fas fa-check-circle"></i>
                                Non activé</span> ';}
                                 } ?>
                        </div>


                    </div>

                </div>

                <!-- Right Column: Documents & Validation -->
                <div class="flex" style="flex-direction: column; gap: 1.5rem;">

                    <div class="card">
                        <h3 style="margin-bottom: 1.5rem;">Documents Justificatifs</h3>

                        <!-- Document 1 -->
                        <div
                            style="border: 1px solid var(--border); border-radius: 8px; padding: 1rem; margin-bottom: 1rem;">
                            <div class="flex justify-between items-center" style="margin-bottom: 1rem;">
                                <div class="flex items-center gap-3">
                                    <div
                                        style="width: 40px; height: 40px; background: #fee2e2; color: #ef4444; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin: 0;">Carte Professionnelle</h4>
                                        <small style="color: var(--text-muted);">PDF - 2.4 MB</small>
                                    </div>
                                </div>
                                <a href="/assets/documents/<?=$professionnlle[0]->getDocument()['document'] ?>"  class="btn btn-outline" style="font-size: 0.9rem;">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                            </div>
                            <div
                                style="background: #f8fafc; height: 150px; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
                                <i class="fas fa-file-pdf" style="font-size: 3rem; margin-right: 1rem;"></i> Aperçu du
                                document
                            </div>
                        </div>

                        <!-- Document 2 -->
                        <div
                            style="border: 1px solid var(--border); border-radius: 8px; padding: 1rem; margin-bottom: 1rem;">
                            <div class="flex justify-between items-center" style="margin-bottom: 1rem;">
                                <div class="flex items-center gap-3">
                                    <div
                                        style="width: 40px; height: 40px; background: #fff7ed; color: #f97316; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div>
                                        <h4 style="margin: 0;">Diplôme / Certification</h4>
                                        <small style="color: var(--text-muted);">JPG - 1.1 MB</small>
                                    </div>
                                </div>
                                <a href="/assets/documents/<?=$professionnlle[0]->getDocument()['certificat'] ?>" class="btn btn-outline" style="font-size: 0.9rem;">

                                    <i class="fas fa-eye"></i> Voir
                                </a>
                            </div>
                            <div
                                style="background: #f8fafc; height: 150px; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
                                <i class="fas fa-file-pdf" style="font-size: 3rem; margin-right: 1rem;"></i> Aperçu du
                                document
                            </div>
                        </div>

                    </div>

                    <!-- Validation Actions -->
                    <div class="card">
                        <h3 style="margin-bottom: 1rem;">Validation du Compte</h3>
                        <p style="color: var(--text-muted); margin-bottom: 1.5rem;">
                            Veuillez vérifier attentivement tous les documents avant de valider le compte. Une fois
                            validé, le professionnel apparaîtra dans les résultats de recherche.
                        </p>

                        <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <a href="../rejectAccount/<?=$professionnlle[0]->getId()?>" class="btn btn-outline"
                                style="color: var(--danger); border-color: var(--danger); justify-content: center;">
                                <i class="fas fa-times" style="margin-right: 0.5rem;"></i> Refuser le dossier
                            </a>
                            <a href="../validateAccount/<?=$professionnlle[0]->getId()?>" class="btn btn-primary"
                                style="background: var(--success); border-color: var(--success); justify-content: center;">
                                <i class="fas fa-check" style="margin-right: 0.5rem;"></i> Valider le compte
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </main>
    </div>
    <script src="/../../src/js/script.js"></script>
</body>

</html>