<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISTICHARA - Expertise Juridique au Maroc</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="flex justify-between items-center">
                <a href="#" class="brand">
                    <i class="fas fa-balance-scale"></i>
                    ISTICHARA<span>.</span>
                </a>
                <nav class="flex gap-6 items-center">
                    <a href="#" class="nav-link active">Accueil</a>
                    <a href="#" class="nav-link">Experts</a>
                    <a href="#" class="nav-link">À propos</a>
                    <a href="dashboard" class="btn btn-primary" style="padding: 0.5rem 1rem;">Connexion</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="animate-fade-in">
                <h1>L'expertise juridique <br>à portée de main.</h1>
                <p>Trouvez l'avocat ou l'huissier de justice idéal pour vos besoins. Consultations en ligne, conseils et médiation partout au Maroc.</p>
                
                <!-- Search Filter -->
                <div class="search-container">
                    <div class="input-group">
                        <label class="label">Rechercher par nom</label>
                        <div class="flex items-center" style="position:relative">
                            <i class="fas fa-search" style="position:absolute; left: 12px; color: var(--text-light)"></i>
                            <input type="text" class="input" placeholder="Ex: Maître Alami..." style="padding-left: 2.5rem;">
                        </div>
                    </div>
                    <div class="input-group">
                        <label class="label">Profession</label>
                        <select class="select">
                            <option value="">Tous les experts</option>
                            <option value="avocat">Avocat</option>
                            <option value="huissier">Huissier de Justice</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label class="label">Ville</label>
                        <select class="select">
                            <option value="">Toutes les villes</option>
                            <option value="casablanca">Casablanca</option>
                            <option value="rabat">Rabat</option>
                            <option value="marrakech">Marrakech</option>
                            <option value="tanger">Tanger</option>
                        </select>
                    </div>
                    <button class="btn btn-primary">
                        Trouver un expert
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container" style="padding-top: 4rem; padding-bottom: 4rem;">
        
        <div class="flex justify-between items-center" style="margin-bottom: 2rem;">
            <div>
                <h2 style="font-size: 2rem;">Nos Experts Recommandés</h2>
                <p style="color: var(--text-muted);">Les profils les mieux notés de la plateforme</p>
            </div>
            
            <div class="flex gap-2">
                <select class="select" style="min-width: 200px;">
                    <option>Trier par expérience</option>
                    <option>Trier par tarif horaire</option>
                </select>
            </div>
        </div>

        <!-- Grid Results -->
        <div class="grid" style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
            
            <!-- Result Card 1 (Avocat) -->
            <article class="card">
                <div class="flex justify-between items-start" style="margin-bottom: 1rem;">
                    <div class="flex gap-4 items-center">
                        <div style="width: 60px; height: 60px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--primary);">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.25rem; margin-bottom: 0.25rem;">Me. Karim Bennani</h3>
                            <span class="badge badge-blue">Avocat</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <div style="font-weight: 700; color: var(--primary);">500 DH</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">/heure</div>
                    </div>
                </div>
                
                <div style="margin-bottom: 1rem;">
                    <div class="flex items-center gap-2" style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">
                        <i class="fas fa-map-marker-alt" style="width: 20px; text-align: center;"></i> Casablanca
                    </div>
                    <div class="flex items-center gap-2" style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">
                        <i class="fas fa-briefcase" style="width: 20px; text-align: center;"></i> 15 ans d'expérience
                    </div>
                    <div class="flex items-center gap-2" style="color: var(--text-muted); font-size: 0.9rem;">
                        <i class="fas fa-gavel" style="width: 20px; text-align: center;"></i> Droit des affaires, Civil
                    </div>
                </div>

                <div style="border-top: 1px solid var(--border); padding-top: 1rem; margin-top: 1rem; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.875rem; color: var(--success); font-weight: 500;">
                        <i class="fas fa-video"></i> Consult. en ligne
                    </span>
                    <button class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.875rem;">Voir profil</button>
                </div>
            </article>

            <!-- Result Card 2 (Avocat) -->
            <article class="card">
                <div class="flex justify-between items-start" style="margin-bottom: 1rem;">
                    <div class="flex gap-4 items-center">
                        <div style="width: 60px; height: 60px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--primary);">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.25rem; margin-bottom: 0.25rem;">Me. Salma Idrissi</h3>
                            <span class="badge badge-blue">Avocat</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <div style="font-weight: 700; color: var(--primary);">350 DH</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">/heure</div>
                    </div>
                </div>
                
                <div style="margin-bottom: 1rem;">
                    <div class="flex items-center gap-2" style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">
                        <i class="fas fa-map-marker-alt" style="width: 20px; text-align: center;"></i> Rabat
                    </div>
                    <div class="flex items-center gap-2" style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">
                        <i class="fas fa-briefcase" style="width: 20px; text-align: center;"></i> 8 ans d'expérience
                    </div>
                    <div class="flex items-center gap-2" style="color: var(--text-muted); font-size: 0.9rem;">
                        <i class="fas fa-gavel" style="width: 20px; text-align: center;"></i> Droit de la famille
                    </div>
                </div>

                <div style="border-top: 1px solid var(--border); padding-top: 1rem; margin-top: 1rem; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.875rem; color: var(--text-muted);">
                        <i class="fas fa-building"></i> Cabinet physique
                    </span>
                    <button class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.875rem;">Voir profil</button>
                </div>
            </article>

            <!-- Result Card 3 (Huissier) -->
            <article class="card">
                <div class="flex justify-between items-start" style="margin-bottom: 1rem;">
                    <div class="flex gap-4 items-center">
                        <div style="width: 60px; height: 60px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--accent);">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.25rem; margin-bottom: 0.25rem;">Mr. Omar Tazi</h3>
                            <span class="badge badge-gold">Huissier</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <!-- No hourly rate for bailiffs usually, but keeping structure consistent or custom -->
                        <div style="font-weight: 700; color: var(--primary);">Variable</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">/acte</div>
                    </div>
                </div>
                
                <div style="margin-bottom: 1rem;">
                    <div class="flex items-center gap-2" style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">
                        <i class="fas fa-map-marker-alt" style="width: 20px; text-align: center;"></i> Marrakech
                    </div>
                    <div class="flex items-center gap-2" style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">
                        <i class="fas fa-briefcase" style="width: 20px; text-align: center;"></i> 20 ans d'expérience
                    </div>
                    <div class="flex items-center gap-2" style="color: var(--text-muted); font-size: 0.9rem;">
                        <i class="fas fa-tasks" style="width: 20px; text-align: center;"></i> Signification, Exécution
                    </div>
                </div>

                <div style="border-top: 1px solid var(--border); padding-top: 1rem; margin-top: 1rem; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.875rem; color: var(--text-muted);">
                        <i class="fas fa-check-circle"></i> Disponible
                    </span>
                    <button class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.875rem;">Voir profil</button>
                </div>
            </article>
             <!-- Result Card 4 (Avocat) -->
             <article class="card">
                <div class="flex justify-between items-start" style="margin-bottom: 1rem;">
                    <div class="flex gap-4 items-center">
                        <div style="width: 60px; height: 60px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--primary);">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1.25rem; margin-bottom: 0.25rem;">Me. Layla Bennis</h3>
                            <span class="badge badge-blue">Avocat</span>
                        </div>
                    </div>
                    <div class="text-center">
                        <div style="font-weight: 700; color: var(--primary);">400 DH</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">/heure</div>
                    </div>
                </div>
                
                <div style="margin-bottom: 1rem;">
                    <div class="flex items-center gap-2" style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">
                        <i class="fas fa-map-marker-alt" style="width: 20px; text-align: center;"></i> Tanger
                    </div>
                    <div class="flex items-center gap-2" style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">
                        <i class="fas fa-briefcase" style="width: 20px; text-align: center;"></i> 12 ans d'expérience
                    </div>
                    <div class="flex items-center gap-2" style="color: var(--text-muted); font-size: 0.9rem;">
                        <i class="fas fa-gavel" style="width: 20px; text-align: center;"></i> Droit pénal
                    </div>
                </div>

                <div style="border-top: 1px solid var(--border); padding-top: 1rem; margin-top: 1rem; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.875rem; color: var(--success); font-weight: 500;">
                        <i class="fas fa-video"></i> Consult. en ligne
                    </span>
                    <button class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.875rem;">Voir profil</button>
                </div>
            </article>

        </div>

        <!-- Pagination -->
        <div class="flex justify-center items-center gap-2" style="margin-top: 3rem;">
            <button class="btn btn-outline" style="width: 40px; height: 40px; padding: 0;">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="btn btn-primary" style="width: 40px; height: 40px; padding: 0;">1</button>
            <button class="btn btn-outline" style="width: 40px; height: 40px; padding: 0;">2</button>
            <button class="btn btn-outline" style="width: 40px; height: 40px; padding: 0;">3</button>
            <button class="btn btn-outline" style="width: 40px; height: 40px; padding: 0;">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

    </main>

    <footer style="background: var(--primary); color: white; padding: 3rem 0; margin-top: 4rem;">
        <div class="container text-center">
            <h2 class="brand" style="justify-content: center; color: white; margin-bottom: 1rem;">
                ISTICHARA<span>.</span>
            </h2>
            <p style="color: #94a3b8; margin-bottom: 2rem;">La plateforme de référence pour les services juridiques au Maroc.</p>
            <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 2rem; color: #64748b; font-size: 0.875rem;">
                &copy; 2024 ISTICHARA. Tous droits réservés.
            </div>
        </div>
    </footer>

</body>
</html>
