<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demandes - ISTICHARA</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">

    <style>
        .demands-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 1.5rem;
        }
        .demand-card { display: flex; flex-direction: column; gap: 1rem; }
        .demand-header { display: flex; justify-content: space-between; align-items: center; }
        .input-label { font-size: .85rem; color: #64748b; }
        .input-field {
            width: 100%; padding: .6rem;
            border: 1px solid #e2e8f0; border-radius: 6px;
        }
        .actions { display: flex; gap: .5rem; }
        .btn {
            display: flex; align-items: center; gap: .4rem;
            padding: .5rem .9rem; border-radius: 6px;
            border: none; cursor: pointer;
        }
        .btn-success { background: #059669; color: #fff; }
        .btn-danger { background: #dc2626; color: #fff; }
        .disabled { opacity: .6; pointer-events: none; }
    </style>
</head>
<body>

<div class="dashboard-layout">

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="brand">
            <span class="material-icons">balance</span>
            <span>ISTICHARA</span>
        </div>

        <nav class="sidebar-menu">
            <a href="/dashboard" class="sidebar-link">
                <span class="material-icons">dashboard</span>
                <span>Dashboard</span>
            </a>
            <a href="/demands" class="sidebar-link active">
                <span class="material-icons">inbox</span>
                <span>Demandes</span>
            </a>
        </nav>
    </aside>

    <!-- Main -->
    <main class="main-content">
        <h2 style="margin-bottom:2rem;">Demandes de Consultation</h2>

        <div class="demands-grid">

            <?php foreach ($demands as $demand): ?>
                <?php
                    $status = $demand['validation_status'];
                    $locked = $status !== 'pending';
                ?>

                <div class="card demand-card">

                    <div class="demand-header">
                        <h3><?= htmlspecialchars($demand['client_name']) ?></h3>
                        <span class="status-badge <?= $status ?>">
                            <?= ucfirst($status) ?>
                        </span>
                    </div>

                    <!-- ACCEPT FORM -->
                    <form method="POST" action="/demands/accept">
                        <input type="hidden" name="demand_id" value="<?= $demand['id'] ?>">

                        <label class="input-label">Lien Google Meet</label>
                        <input
                            type="url"
                            name="meet_link"
                            class="input-field"
                            placeholder="https://meet.google.com/xxx-xxxx-xxx"
                            value="<?= htmlspecialchars($demand['meet_link'] ?? '') ?>"
                            <?= $locked ? 'disabled' : '' ?>
                        >

                        <div class="actions">
                            <button
                                type="submit"
                                class="btn btn-success <?= $locked ? 'disabled' : '' ?>"
                            >
                                <span class="material-icons">check_circle</span>
                                Accepter
                            </button>
                        </div>
                    </form>

                    <!-- REFUSE FORM -->
                    <form method="POST" action="/demands/refuse">
                        <input type="hidden" name="demand_id" value="<?= $demand['id'] ?>">

                        <div class="actions">
                            <button
                                type="submit"
                                class="btn btn-danger <?= $locked ? 'disabled' : '' ?>"
                            >
                                <span class="material-icons">cancel</span>
                                Refuser
                            </button>
                        </div>
                    </form>

                </div>

            <?php endforeach; ?>

        </div>
    </main>
</div>

</body>
</html>
