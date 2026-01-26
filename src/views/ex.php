<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Demandes Clients | ISTICHARA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        .demande-card {
            padding: 1rem 1.25rem;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: white;
            transition: all .2s ease;
        }

        .demande-card:hover {
            box-shadow: 0 6px 18px rgba(0,0,0,.06);
            transform: translateY(-2px);
        }

        .demande-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: .5rem;
        }

        .demande-client {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .demande-meta {
            display: flex;
            gap: 1.2rem;
            font-size: .85rem;
            color: var(--text-muted);
            margin-top: .25rem;
            flex-wrap: wrap;
        }

        .demande-message {
            margin-top: .6rem;
            font-size: .9rem;
            color: var(--text-muted);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .meeting-input {
            margin-top: .6rem;
        }

        .meeting-input input {
            width: 100%;
            padding: .45rem .6rem;
            font-size: .85rem;
            border-radius: 6px;
            border: 1px solid var(--border);
        }

        .demande-actions {
            display: flex;
            justify-content: flex-end;
            gap: .5rem;
            margin-top: .8rem;
        }

        .demande-actions button {
            padding: .45rem .7rem;
            font-size: .85rem;
        }

        .badge-pending {
            background: #fffbeb;
            color: #d97706;
            border: 1px solid #fde68a;
            font-size: .75rem;
            padding: .2rem .55rem;
            border-radius: 999px;
        }
    </style>
</head>

<body>

<div class="dashboard-layout">

    <aside class="sidebar">
        <div class="brand" style="margin-bottom:2rem;">
            <i class="fas fa-balance-scale"></i>
            <span style="color:white;margin-left:10px;">ISTICHARA</span>
        </div>

        <nav class="sidebar-menu">
            <a href="dashboard" class="sidebar-link">
                <i class="fas fa-chart-line"></i>
                Tableau de bord
            </a>
            <a href="demandes" class="sidebar-link active">
                <i class="fas fa-inbox"></i>
                Demandes clients
            </a>
            <a href="profile" class="sidebar-link">
                <i class="fas fa-user-tie"></i>
                Mon profil
            </a>
            <a href="/" class="sidebar-link" style="margin-top:auto;">
                <i class="fas fa-sign-out-alt"></i>
                Déconnexion
            </a>
        </nav>
    </aside>

    <main class="main-content">

        <header class="flex justify-between items-center" style="margin-bottom:2rem;">
            <h2 style="font-size:1.75rem;">Demandes de Consultation</h2>
        </header>

        <div id="demandesList" class="flex" style="flex-direction:column;gap:1rem;"></div>
        <div id="pagination" class="flex justify-center gap-2" style="margin-top:2.5rem;"></div>

    </main>
</div>

<script>
const PER_PAGE = 4;
let currentPage = 1;

const demandes = Array.from({ length: 23 }, (_, i) => ({
    id: i + 1,
    client: "Client " + (i + 1),
    email: "client" + (i + 1) + "@mail.com",
    phone: "06 00 00 00 " + i,
    message: "Besoin d’un avis juridique concernant mon dossier.",
    status: "pending",
    date: "22/01/2026",
    consultation_type: i % 2 === 0 ? "online" : "offline",
    meeting_link: ""
}));

function renderDemandes() {
    const list = document.getElementById("demandesList");
    list.innerHTML = "";

    const start = (currentPage - 1) * PER_PAGE;
    const pageItems = demandes.slice(start, start + PER_PAGE);

    pageItems.forEach(d => {

        const consultationIcon =
            d.consultation_type === "online"
                ? `<i class="fas fa-video"></i> En ligne`
                : `<i class="fas fa-location-dot"></i> Présentiel`;

        const meetingInput =
            d.consultation_type === "online"
                ? `
                <div class="meeting-input">
                    <input type="text"
                           placeholder="Lien de réunion (Zoom / Meet)"
                           value="${d.meeting_link}"
                           oninput="updateMeetingLink(${d.id}, this.value)">
                </div>`
                : "";

        list.innerHTML += `
        <div class="demande-card">
            <div class="demande-header">
                <div>
                    <div class="demande-client">
                        ${d.client}
                        <span class="badge-pending">En attente</span>
                    </div>
                    <div class="demande-meta">
                        <span><i class="fas fa-envelope"></i> ${d.email}</span>
                        <span><i class="fas fa-phone"></i> ${d.phone}</span>
                        <span>${consultationIcon}</span>
                    </div>
                </div>
                <small>${d.date}</small>
            </div>

            <div class="demande-message">
                ${d.message}
            </div>

            ${meetingInput}

            <div class="demande-actions">
                <button class="btn btn-outline"
                        style="color:var(--danger);border-color:var(--danger);"
                        onclick="refuseDemande(${d.id})">
                    <i class="fas fa-times"></i>
                </button>

                <button class="btn btn-primary"
                        style="background:var(--success);border-color:var(--success);"
                        onclick="acceptDemande(${d.id})">
                    <i class="fas fa-check"></i>
                </button>
            </div>
        </div>`;
    });

    renderPagination();
}

function renderPagination() {
    const pag = document.getElementById("pagination");
    pag.innerHTML = "";

    const pages = Math.ceil(demandes.length / PER_PAGE);
    if (pages <= 1) return;

    for (let i = 1; i <= pages; i++) {
        pag.innerHTML += `
        <button class="btn ${i === currentPage ? 'btn-primary' : 'btn-outline'}"
                onclick="goPage(${i})">
            ${i}
        </button>`;
    }
}

function goPage(page) {
    currentPage = page;
    renderDemandes();
}

function updateMeetingLink(id, value) {
    const d = demandes.find(d => d.id === id);
    if (d) d.meeting_link = value;
}

function acceptDemande(id) {
    const d = demandes.find(d => d.id === id);
    if (d && d.consultation_type === "online" && !d.meeting_link) {
        alert("Veuillez ajouter le lien de réunion.");
        return;
    }
    d.status = "accepted";
    renderDemandes();
}

function refuseDemande(id) {
    const index = demandes.findIndex(d => d.id === id);
    if (index !== -1) demandes.splice(index, 1);
    renderDemandes();
}

renderDemandes();
</script>

</body>
</html>
