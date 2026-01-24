<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISTICHARA - Expertise Juridique au Maroc</title>

    <!-- KEEP YOUR CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<?php require_once __DIR__ . "/../components/header.php" ?>
<section class="hero">
    <div class="container">
        <h1>L'expertise juridique<br>à portée de main.</h1>
        <p>Trouvez l'avocat ou l'huissier idéal partout au Maroc.</p>

        <!-- SEARCH / FILTERS -->
        <div class="search-container">
            <div class="input-group">
                <label class="label">Nom</label>
                <input id="searchName" class="input" placeholder="Ex: David Huissier">
            </div>

            <div class="input-group">
                <label class="label">Profession</label>
                <select id="searchRole" class="select">
                    <option value="">Tous</option>
                    <option value="avocat">Avocat</option>
                    <option value="huissier">Huissier</option>
                </select>
            </div>

            <div class="input-group">
                <label class="label">Ville</label>
                <select id="searchVille" class="select">
                    <option value="">Toutes</option>
                    <option value="Casablanca">Casablanca</option>
                    <option value="Rabat">Rabat</option>
                    <option value="Marrakech">Marrakech</option>
                </select>
            </div>

            <div class="input-group">
                <label class="label">Expérience min</label>
                <select id="searchExperience" class="select">
                    <option value="">Toutes</option>
                    <option value="5">5 ans</option>
                    <option value="10">10 ans</option>
                    <option value="20">20 ans</option>
                </select>
            </div>

            <button id="searchBtn" class="btn btn-primary">Rechercher</button>
        </div>
    </div>
</section>

<main class="container" style="padding:4rem 0">

    <div class="flex justify-between items-center" style="margin-bottom:2rem;">
        <div>
            <h2>Nos Experts</h2>
            <p style="color:var(--text-muted);">Professionnels juridiques disponibles</p>
        </div>
    </div>

    <!-- RESULTS -->
    <div id="resultsGrid" class="grid"
         style="grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:2rem;">
    </div>

    <!-- PAGINATION -->
    <div id="pagination" class="flex justify-center items-center gap-2" style="margin-top:3rem;"></div>

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
const API_URL = "<?= $_ENV['BASE_URL'] ?>/api/v4/professionals";
const PER_PAGE = 6;
let currentPage = 1;
let allProfessionals = [];

async function loadProfessionals() {
    const res = await fetch(API_URL);
    const json = await res.json();
    allProfessionals = json.data || [];
    applyFilters();
}

function applyFilters() {
    let filtered = [...allProfessionals];

    const name = searchName.value.toLowerCase();
    const role = searchRole.value;
    const ville = searchVille.value;
    const experience = searchExperience.value;

    if (name) {
        filtered = filtered.filter(p =>
            p.name.toLowerCase().includes(name)
        );
    }

    if (role) {
        filtered = filtered.filter(p => p.role === role);
    }

    if (ville) {
        filtered = filtered.filter(p => p.ville_name === ville);
    }

    if (experience) {
        filtered = filtered.filter(p => p.years_of_experience >= experience);
    }

    renderPage(filtered);
}

function renderPage(data) {
    const start = (currentPage - 1) * PER_PAGE;
    const paginated = data.slice(start, start + PER_PAGE);

    renderResults(paginated);
    renderPagination(data.length);
}

function renderResults(list) {
    const grid = document.getElementById("resultsGrid");
    grid.innerHTML = "";

    if (!list.length) {
        grid.innerHTML = "<p>Aucun expert trouvé.</p>";
        return;
    }

    list.forEach(p => {
        const badgeClass = p.role === "avocat" ? "badge-blue" : "badge-gold";
        const icon = p.role === "avocat" ? "fa-user-tie" : "fa-file-signature";
        const link = p.role === "avocat" ? "/avocat/profile/" : "/huissier/profile/";

        grid.innerHTML += `
        <article class="card">
            <div class="flex gap-4 items-center" style="margin-bottom:1rem;">
                <div style="width:60px;height:60px;border-radius:50%;
                background:#e2e8f0;display:flex;align-items:center;justify-content:center;">
                    <i class="fas ${icon}"></i>
                </div>
                <div>
                    <h3>${p.name}</h3>
                    <span class="badge ${badgeClass}">${p.role}</span>
                </div>
            </div>

            <div style="color:var(--text-muted);font-size:.9rem;">
                <p><i class="fas fa-map-marker-alt"></i> ${p.ville_name}</p>
                <p><i class="fas fa-briefcase"></i> ${p.years_of_experience} ans d'expérience</p>
                ${p.specialite ? `<p><i class="fas fa-gavel"></i> ${p.specialite}</p>` : ""}
                ${p.types_actes ? `<p><i class="fas fa-tasks"></i> ${p.types_actes}</p>` : ""}
            </div>

            <div style="border-top:1px solid var(--border);margin-top:1rem;padding-top:1rem;text-align:right;">
                <a href=${link + p.id} class="btn btn-outline">Voir profil</a>
            </div>
        </article>`;
    });
}

function renderPagination(total) {
    const pages = Math.ceil(total / PER_PAGE);
    const pag = document.getElementById("pagination");
    pag.innerHTML = "";

    if (pages <= 1) return;

    for (let i = 1; i <= pages; i++) {
        pag.innerHTML += `
        <button class="btn ${i === currentPage ? 'btn-primary' : 'btn-outline'}"
                onclick="goPage(${i})">${i}</button>`;
    }
}

function goPage(page) {
    currentPage = page;
    applyFilters();
}

searchBtn.onclick = () => {
    currentPage = 1;
    applyFilters();
};

loadProfessionals();
</script>

</body>
</html>
