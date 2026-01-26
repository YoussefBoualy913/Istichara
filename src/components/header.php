<header class="header">
    <div class="container">
        <div class="flex justify-between items-center">
            <a href="#" class="brand">
                <i class="fas fa-balance-scale"></i>
                ISTICHARA<span>.</span>
            </a>
            <nav class="flex gap-6 items-center">
                <a href="/" class="nav-link active">Accueil</a>
                <a href="/" class="nav-link">Experts</a>
                <a href="/" class="nav-link">À propos</a>
                <?php if(!$user){ ?>
                <a href="register" class="btn btn-primary">Connexion</a>
                <?php } ?>

                <?php if($user){ ?> 
                 <div class="user-dropdown">
                    <button class="btn btn-primary dropdown-toggle">
                        <i class="fas fa-user-circle" style="margin-right: 0.5rem;"></i>
                        Mon Compte
                        <i class="fas fa-chevron-down" style="margin-left: 0.5rem; font-size: 0.75rem;"></i>
                    </button>
                    <div class="dropdown-menu">
                        <?php if($user['role'] === "ADMIN"){ ?>
                        <a href="/dashboard" class="dropdown-item">
                            <i class="fas fa-user"></i>
                            Dashboard
                        </a>
                        <?php } else if(in_array(strtoupper($user['role']), ["AVOCAT", "HUISSIER"])){ ?>
                        <a href="/dashboard/professional" class="dropdown-item">
                            <i class="fas fa-user"></i>
                            Dashboard
                        </a>
                        <?php } else {?>
                        <a href="/client/profile" class="dropdown-item">
                            <i class="fas fa-user"></i>
                            Profil
                        </a>
                        <?php }?>
                        <a href="/auth/logout" class="dropdown-item logout">
                            <i class="fas fa-sign-out-alt"></i>
                            Déconnexion
                        </a>
                    </div>
                </div>
                <?php } ?> 
            </nav>
        </div>
    </div>
</header>

<style>
    

.user-dropdown {
    position: relative;
}

.dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.dropdown-menu {
    position: absolute;
    top: calc(100% + 0.5rem);
    right: 0;
    background: white;
    border: 1px solid var(--border);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-lg);
    min-width: 200px;
    padding: 0.5rem 0;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.2s ease;
    z-index: 100;
}

.user-dropdown:hover .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1.25rem;
    color: var(--text-main);
    font-weight: 500;
    transition: all 0.2s;
    text-decoration: none;
}

.dropdown-item:hover {
    background: var(--bg-body);
    color: var(--primary);
}

.dropdown-item.logout {
    border-top: 1px solid var(--border);
    margin-top: 0.5rem;
    padding-top: 1rem;
    color: var(--danger);
}

.dropdown-item.logout:hover {
    background: #fef2f2;
    color: var(--danger);
}

.dropdown-item i {
    width: 18px;
    text-align: center;
}
</style>