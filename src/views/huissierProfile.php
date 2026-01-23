<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Huissier - ISTICHARA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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

        .justify-center {
            justify-content: center;
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

        .profile-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 3rem 1.5rem;
        }

        .profile-header {
            background: white;
            border-radius: var(--radius-lg);
            padding: 2.5rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
            margin-bottom: 2rem;
        }

        .profile-top {
            display: flex;
            gap: 2rem;
            align-items: flex-start;
            margin-bottom: 2rem;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: var(--radius-lg);
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            flex-shrink: 0;
        }

        .profile-info {
            flex: 1;
        }

        .profile-name {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }

        .profile-specialty {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            background: #fef3c7;
            color: #92400e;
            border-radius: var(--radius-md);
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 1.25rem;
        }

        .profile-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.25rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .meta-item i {
            width: 20px;
            color: var(--accent);
            font-size: 1rem;
        }

        .profile-section {
            background: white;
            border-radius: var(--radius-lg);
            padding: 2rem;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.25rem;
            margin-bottom: 1.25rem;
            color: var(--primary);
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--border);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .info-label {
            font-size: 0.875rem;
            color: var(--text-muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .info-value {
            font-size: 1rem;
            color: var(--text-main);
            font-weight: 600;
        }

        .actes-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .acte-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.625rem 1rem;
            background: #ecfdf5;
            color: #047857;
            border-radius: var(--radius-md);
            font-weight: 600;
            border: 1px solid #a7f3d0;
            font-size: 0.9rem;
        }

        .acte-badge.signification {
            background: #eff6ff;
            color: #1e40af;
            border-color: #bfdbfe;
        }

        .acte-badge.execution {
            background: #fef3c7;
            color: #92400e;
            border-color: #fde68a;
        }

        .acte-badge.constat {
            background: #f3e8ff;
            color: #6b21a8;
            border-color: #e9d5ff;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-large {
            padding: 1rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            flex: 1;
        }

        .btn-book {
            background: var(--accent);
            color: white;
        }

        .btn-book:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-contact {
            background: white;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-contact:hover {
            background: var(--primary);
            color: white;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-muted);
            font-weight: 500;
            margin-bottom: 1.5rem;
            transition: all 0.2s;
        }

        .back-link:hover {
            color: var(--primary);
            gap: 0.75rem;
        }

        @media (max-width: 768px) {
            .profile-top {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .profile-meta {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
            }

            .profile-name {
                font-size: 1.5rem;
            }

            .profile-avatar {
                width: 100px;
                height: 100px;
                font-size: 2.5rem;
            }

            .actes-badges {
                justify-content: center;
            }
        }
    </style>
</head>
<body>

<header class="header">
    <div class="container">
        <div class="flex justify-between items-center">
            <a href="/" class="brand">
                <i class="fas fa-balance-scale"></i>
                ISTICHARA<span>.</span>
            </a>
            <nav class="flex gap-6 items-center">
                <a href="/" class="nav-link">Accueil</a>
                <a href="/experts" class="nav-link active">Experts</a>
                <a href="/about" class="nav-link">À propos</a>
                <a href="/register" class="btn btn-primary">Connexion</a>
            </nav>
        </div>
    </div>
</header>

<main class="profile-container">
    <a href="/experts" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Retour à la liste
    </a>

    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-top">
            <div class="profile-avatar">
                <i class="fas fa-gavel"></i>
            </div>
            
            <div class="profile-info">
                <h1 class="profile-name">Ahmed Benani</h1>
                <div class="profile-specialty">
                    <i class="fas fa-stamp" style="margin-right: 0.5rem;"></i>
                    Huissier de Justice
                </div>
                
                <div class="profile-meta">
                    <div class="meta-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Rabat</span>
                    </div>
                    
                    <div class="meta-item">
                        <i class="fas fa-briefcase"></i>
                        <span>12 ans d'expérience</span>
                    </div>
                    
                    <div class="meta-item">
                        <i class="fas fa-envelope"></i>
                        <span>a.benani@huissier.ma</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Section -->
    <div class="profile-section">
        <h2 class="section-title">Informations Professionnelles</h2>
        
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Profession</span>
                <span class="info-value">Huissier de Justice</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Années d'expérience</span>
                <span class="info-value">12 ans</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Ville d'exercice</span>
                <span class="info-value">Rabat</span>
            </div>
            
            <div class="info-item">
                <span class="info-label">Email</span>
                <span class="info-value">a.benani@huissier.ma</span>
            </div>
        </div>
    </div>

    <!-- Types d'Actes Section -->
    <div class="profile-section">
        <h2 class="section-title">Types d'Actes</h2>
        <p style="color: var(--text-muted); margin-bottom: 1.5rem;">
            Services juridiques proposés par cet huissier de justice.
        </p>
        
        <div class="actes-badges">
            <div class="acte-badge signification">
                <i class="fas fa-file-invoice"></i>
                Signification
            </div>
            <div class="acte-badge execution">
                <i class="fas fa-hammer"></i>
                Exécution
            </div>
            <div class="acte-badge constat">
                <i class="fas fa-clipboard-check"></i>
                Constats
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="profile-section">
        <h2 class="section-title">Demander un Service</h2>
        <p style="color: var(--text-muted); margin-bottom: 1.5rem;">
            Contactez cet huissier de justice pour vos besoins en actes juridiques.
        </p>
        
        <div class="action-buttons">
            <button class="btn btn-large btn-book" onclick="demanderService()">
                <i class="fas fa-file-signature" style="margin-right: 0.75rem;"></i>
                Demander un acte
            </button>
            <button class="btn btn-large btn-contact" onclick="contactHuissier()">
                <i class="fas fa-envelope" style="margin-right: 0.75rem;"></i>
                Envoyer un message
            </button>
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

<script>
function demanderService() {
    alert('Redirection vers la page de demande d\'acte...');
}

function contactHuissier() {
    alert('Ouverture du formulaire de contact...');
}
</script>

</body>
</html>