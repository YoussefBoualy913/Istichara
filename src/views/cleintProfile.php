<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - ISTICHARA</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php require_once __DIR__ . "/../components/header.php"; ?>


<main class="container" style="padding:3rem 0;">
    <div class="profile-layout">
        
        <!-- Profile Info Card -->
        <div class="profile-card card">
            <div class="profile-avatar-large">
                <i class="fas fa-user"></i>
            </div>
            <h2 class="profile-title"><?= $client->getName() ?></h2>
            <p class="profile-email"><?= $client->getEmail() ?></p>
            <span class="badge badge-blue" style="margin-top: 1rem;">Client</span>
            
            <div class="profile-stats">
                <div class="stat-item">
                    <div class="stat-number"><?= $total ?></div>
                    <div class="stat-label">Demandes totales</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?= $approved ?></div>
                    <div class="stat-label">Approuvées</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number"><?= $denied ?></div>
                    <div class="stat-label">Complétées</div>
                </div>
            </div>

            <button class="btn btn-outline" style="margin-top: 1.5rem; width: 100%;">
                <i class="fas fa-edit"></i>
                Modifier le profil
            </button>
        </div>

        <!-- Demands Section -->
        <div class="demands-section">
            <div class="section-header">
                <h2>Mes Demandes de Consultation</h2>
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Nouvelle demande
                </button>
            </div>

            <div class="demands-list">
                <?php foreach($demands as $d){ ?>

                <div class="demand-card card">
                    <div class="demand-header">
                        <div class="demand-info">
                            <h3 class="demand-title">Consultation <?= $d->getAvocat_id() !== null ? "Avocat" : "Huisser" ?></h3>
                            <p class="demand-date">
                                <i class="fas fa-calendar-alt"></i>
                                22 janvier 2026
                                <?= $d->getDate() ?>
                            </p>
                        </div>
                        <span class="badge <?= $d->getValidation_status() === "approved" ? "badge-green" : ($d->getValidation_status() === "pending" ? "badge-blue" : "badge-red") ?> status-badge">
                            <i class="fas fa-check-circle"></i>
                            <?= $d->getValidation_status() ?>
                        </span>
                    </div>
                    <div class="demand-details">
                        <div class="detail-row">
                            <i class="fas fa-user-tie"></i>
                            <span><?= $d->getAvocat_id() ? "Avocate #{$d->getAvocat_id()}" :  "Huissier #{$d->getHuissier_id()}" ?></span>
                        </div>
                        <div class="detail-row">
                            <?php if($d->getValidation_status() === "approved"){ ?>
                            <i class="fas fa-video"></i>
                            <a href="<?= $d->getMeet_link() ?>" target="_blank" class="meeting-link">
                                Rejoindre la réunion
                            </a>
                            <?php } else {?>
                            <i class="fas fa-info-circle"></i>
                            <span style="color: var(--text-muted);">Demande non acceptée par le professionnel</span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
<!-- 
                <div class="demand-card card">
                    <div class="demand-header">
                        <div class="demand-info">
                            <h3 class="demand-title">Consultation Huissier</h3>
                            <p class="demand-date">
                                <i class="fas fa-calendar-alt"></i>
                                21 janvier 2026
                            </p>
                        </div>
                        <span class="badge badge-green status-badge">
                            <i class="fas fa-check-circle"></i>
                            Approuvée
                        </span>
                    </div>
                    <div class="demand-details">
                        <div class="detail-row">
                            <i class="fas fa-file-signature"></i>
                            <span>Huissier #59</span>
                        </div>
                        <div class="detail-row">
                            <i class="fas fa-video"></i>
                            <a href="https://meet.example.com/1" target="_blank" class="meeting-link">
                                Rejoindre la réunion
                            </a>
                        </div>
                    </div>
                </div>

                <div class="demand-card card">
                    <div class="demand-header">
                        <div class="demand-info">
                            <h3 class="demand-title">Consultation Avocat</h3>
                            <p class="demand-date">
                                <i class="fas fa-calendar-alt"></i>
                                20 janvier 2026
                            </p>
                        </div>
                        <span class="badge badge-red status-badge">
                            <i class="fas fa-times-circle"></i>
                            Refusée
                        </span>
                    </div>
                    <div class="demand-details">
                        <div class="detail-row">
                            <i class="fas fa-user-tie"></i>
                            <span>Avocat #12</span>
                        </div>
                        <div class="detail-row">
                            <i class="fas fa-info-circle"></i>
                            <span style="color: var(--text-muted);">Demande non acceptée par le professionnel</span>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</main>

<footer style="background:var(--primary);color:white;padding:3rem 0;">
    <div class="container text-center">
        <h2 class="brand" style="justify-content:center;color:white;">ISTICHARA<span>.</span></h2>
        <p style="color:#94a3b8;margin-top:1rem;">
            La plateforme de référence pour les services juridiques au Maroc.
        </p>
        <p style="margin-top:2rem;font-size:.875rem;color:#64748b;">
            &copy; 2024 ISTICHARA. Tous droits réservés.
        </p>
    </div>
</footer>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap');

:root {
    --primary: #0f172a;
    --primary-light: #1e293b;
    --accent: #d4af37;
    --accent-hover: #b5952f;
    --bg-body: #f8fafc;
    --bg-card: #ffffff;
    --text-main: #1e293b;
    --text-muted: #64748b;
    --text-light: #94a3b8;
    --danger: #ef4444;
    --success: #10b981;
    --wait: #d4af37;
    --border: #e2e8f0;
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    --shadow-premium: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    --radius-sm: 0.375rem;
    --radius-md: 0.5rem;
    --radius-lg: 0.75rem;
    --radius-xl: 1rem;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', sans-serif;
    background-color: var(--bg-body);
    color: var(--text-main);
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
}

h1, h2, h3, h4, h5, h6 {
    font-family: 'Playfair Display', serif;
    color: var(--primary);
    line-height: 1.2;
}

a {
    text-decoration: none;
    color: inherit;
    transition: all 0.2s;
}

.container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

.flex {
    display: flex;
}

.items-center {
    align-items: center;
}

.justify-between {
    justify-content: space-between;
}

.gap-6 {
    gap: 1.5rem;
}

.text-center {
    text-align: center;
}

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem 1.5rem;
    border-radius: var(--radius-md);
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
    outline: none;
    font-size: 0.95rem;
    gap: 0.5rem;
}

.btn-primary {
    background-color: var(--primary);
    color: white;
}

.btn-primary:hover {
    background-color: var(--primary-light);
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

.btn-outline {
    background-color: transparent;
    border: 1px solid var(--border);
    color: var(--text-main);
}

.btn-outline:hover {
    border-color: var(--primary);
    color: var(--primary);
}

.header {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    z-index: 50;
    padding: 1rem 0;
}

.brand {
    font-family: 'Playfair Display', serif;
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--primary);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.brand span {
    color: var(--accent);
}

.nav-link {
    font-weight: 500;
    color: var(--text-main);
}

.nav-link:hover {
    color: var(--accent);
}

.nav-link.active {
    color: var(--accent);
}

.card {
    background: var(--bg-card);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border);
    padding: 1.5rem;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: var(--shadow-md);
}

.badge {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.badge-blue {
    background-color: #eff6ff;
    color: #1e40af;
}

.badge-green {
    background-color: #ecfdf5;
    color: #047857;
}

.badge-red {
    background-color: #fef2f2;
    color: #dc2626;
}

.profile-layout {
    display: grid;
    grid-template-columns: 350px 1fr;
    gap: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.profile-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 2rem;
    height: fit-content;
    position: sticky;
    top: 6rem;
}

.profile-avatar-large {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary), var(--primary-light));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
    margin-bottom: 1.5rem;
}

.profile-title {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
    color: var(--primary);
}

.profile-email {
    color: var(--text-muted);
    font-size: 0.95rem;
}

.profile-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    width: 100%;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border);
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--accent);
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.8rem;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.demands-section {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.section-header h2 {
    font-size: 1.75rem;
    color: var(--primary);
}

.demands-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.demand-card {
    padding: 1.5rem;
    transition: all 0.3s ease;
}

.demand-card:hover {
    transform: translateY(-2px);
}

.demand-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid var(--border);
}

.demand-title {
    font-size: 1.15rem;
    margin-bottom: 0.5rem;
    color: var(--text-main);
}

.demand-date {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-muted);
    font-size: 0.9rem;
}

.demand-date i {
    font-size: 0.85rem;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    font-size: 0.85rem;
}

.demand-details {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.detail-row {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: var(--text-main);
    font-size: 0.95rem;
}

.detail-row i {
    width: 20px;
    color: var(--accent);
    text-align: center;
}

.meeting-link {
    color: var(--accent);
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
}

.meeting-link:hover {
    color: var(--accent-hover);
    text-decoration: underline;
}

@media (max-width: 968px) {
    .profile-layout {
        grid-template-columns: 1fr;
    }

    .profile-card {
        position: relative;
        top: 0;
    }

    .section-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }

    .section-header .btn {
        width: 100%;
    }
}
</style>

</body>
</html>