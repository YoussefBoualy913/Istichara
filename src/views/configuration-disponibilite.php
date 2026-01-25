<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration Disponibilité - ISTICHARA</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #cbd5e1;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: var(--success);
        }

        input:checked+.slider:before {
            transform: translateX(24px);
        }

        .day-config {
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            margin-bottom: 1rem;
            background: #f8fafc;
            transition: all 0.3s ease;
        }

        .day-config.active {
            background: white;
            border-color: var(--primary);
            box-shadow: var(--shadow-sm);
        }

        .day-header {
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 600;
        }

        .slots-container {
            padding: 0 1rem 1rem 1rem;
            display: none;
            border-top: 1px solid var(--border);
            margin-top: 0.5rem;
            padding-top: 1rem;
        }

        input:checked~.slots-container,
        .day-config.active .slots-container {
            display: block;
        }

        .time-slot {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 0.5rem;
            padding: 0.5rem;
            background: var(--bg-body);
            border-radius: var(--radius-sm);
        }

        .remove-slot {
            color: var(--danger);
            cursor: pointer;
            transition: color 0.2s;
        }

        .remove-slot:hover {
            color: #b91c1c;
        }

        .add-slot-btn {
            color: var(--accent);
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .add-slot-btn:hover {
            color: var(--accent-hover);
        }
    </style>
</head>

<body>

    <!-- Header -->
    <nav class="header">
        <div class="container flex justify-between items-center">
            <a href="index.html" class="brand">
                <i class="fas fa-balance-scale"></i>
                <span>ISTICHARA</span>
            </a>
            <div class="flex gap-6 items-center">
                <a href="index.html" class="nav-link">Tableau de bord</a>
                <a href="#" class="nav-link">Rendez-vous</a>
                <a href="#" class="nav-link active">Paramètres</a>
                <div class="flex items-center gap-2">
                    <img src="https://ui-avatars.com/api/?name=Me+Bennani&background=0f172a&color=fff"
                        style="width: 32px; height: 32px; border-radius: 50%;" alt="Profile">
                    <span style="font-size: 0.9rem; font-weight: 500;">Me. Bennani</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container" style="padding: 3rem 1.5rem;">

        <div class="flex justify-between items-center" style="margin-bottom: 2rem;">
            <div>
                <h1>Disponibilités Hebdomadaires</h1>
                <p class="text-muted" style="margin-top: 0.5rem;">Configurez vos jours de travail et vos créneaux
                    horaires types.</p>
            </div>
           
        </div>

        <div class="grid" style="grid-template-columns: 300px 1fr; gap: 2rem; align-items: start;">

            <!-- Sidebar / Settings -->
            <div class="card">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem;">Paramètres Généraux</h3>

                <div class="input-group" style="margin-bottom: 1.5rem;">
                    <label class="label">Durée des rendez-vous des créneaux</label>
                    <select class="select">
                        <option value="15">15 minutes</option>
                        <option value="30" selected>30 minutes</option>
                        <option value="45">45 minutes</option>
                        <option value="60">1 heure</option>
                    </select>
                </div>

                <div class="input-group" style="margin-bottom: 1.5rem;">
                    <label class="label">Fuseau Horaire</label>
                    <input type="text" class="input" value="Casablanca (GMT+1)" disabled>
                </div>

                <div class="input-group">
                    <label class="label" style="margin-bottom: 0.5rem;">Période de réservation</label>
                    <div style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0.5rem;">
                        Permettre la prise de RDV jusqu'à :
                    </div>
                    <select class="select">
                        <option value="2">2 semaines à l'avance</option>
                        <option value="4" selected>1 mois à l'avance</option>
                        <option value="12">3 mois à l'avance</option>
                    </select>
                </div>
            </div>

            <!-- Schedule Editor -->
            <div class="card">
                <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem;">Semaine Type</h3>
                <form action="../storeDisponibilite" method="POST">
                <!-- Lundi -->
                <div class="day-config active">
                    <div class="day-header">
                        <div class="flex items-center gap-4">
                            <label class="switch">
                                <input type="checkbox" checked
                                    onchange="this.closest('.day-config').classList.toggle('active')">
                                <span class="slider"></span>
                            </label>
                            <span>Lundi</span>
                        </div>
                        <span style="font-size: 0.85rem; color: var(--text-muted);">09:00 - 18:00</span>
                    </div>
                    <div class="slots-container">
                        <div class="time-slot">
                            <input type="time" name="horaires[Lundi][0][debut]" class="input" value="09:00" style="width: auto;">
                            <span>à</span>
                            <input type="time" name="horaires[Lundi][0][fin]" class="input" value="12:00" style="width: auto;">
                            <i class="fas fa-trash-alt remove-slot"></i>
                        </div>
                        <div class="time-slot">
                            <input type="time" name="horaires[Lundi][1][debut]" class="input" value="14:00" style="width: auto;">
                            <span>à</span>
                            <input type="time" name="horaires[Lundi][1][fin]" class="input" value="18:00" style="width: auto;">
                            <i class="fas fa-trash-alt remove-slot"></i>
                        </div>
                        <div class="add-slot-btn">
                            <i class="fas fa-plus"></i> Ajouter un créneau
                        </div>
                        <p style="display:none;">Lundi</p>
                    </div>
                </div>

                <!-- Mardi -->
                <div class="day-config active">
                    <div class="day-header">
                        <div class="flex items-center gap-4">
                            <label class="switch">
                                <input type="checkbox" checked
                                    onchange="this.closest('.day-config').classList.toggle('active')">
                                <span class="slider"></span>
                            </label>
                            <span>Mardi</span>
                        </div>
                        <span style="font-size: 0.85rem; color: var(--text-muted);">09:00 - 18:00</span>
                    </div>
                    <div class="slots-container">
                        <div class="time-slot">
                            <input type="time" name="horaires[Mardi][0][debut]" class="input" value="09:00" style="width: auto;">
                            <span>à</span>
                            <input type="time" name="horaires[Mardi][0][fin]" class="input" value="12:00" style="width: auto;">
                            <i class="fas fa-trash-alt remove-slot"></i>
                        </div>
                        <div class="time-slot">
                            <input type="time" name="horaires[Mardi][1][debut]" class="input" value="14:00" style="width: auto;">
                            <span>à</span>
                            <input type="time" name="horaires[Mardi][1][fin]" class="input" value="18:00" style="width: auto;">
                            <i class="fas fa-trash-alt remove-slot"></i>
                        </div>
                        <div class="add-slot-btn">
                            <i class="fas fa-plus"></i> Ajouter un créneau
                        </div>
                        <p style="display:none;">Mardi</p>
                    </div>
                </div>

                <!-- Mercredi -->
                <div class="day-config active">
                    <div class="day-header">
                        <div class="flex items-center gap-4">
                            <label class="switch">
                                <input type="checkbox" checked
                                    onchange="this.closest('.day-config').classList.toggle('active')">
                                <span class="slider"></span>
                            </label>
                            <span>Mercredi</span>
                        </div>
                        <span style="font-size: 0.85rem; color: var(--text-muted);">09:00 - 12:00</span>
                    </div>
                    <div class="slots-container">
                        <div class="time-slot">
                            <input type="time" name="horaires[Mercredi][0][debut]" class="input" value="09:00" style="width: auto;">
                            <span>à</span>
                            <input type="time" name="horaires[Mercredi][0][fin]" class="input" value="12:00" style="width: auto;">
                            <i class="fas fa-trash-alt remove-slot"></i>
                        </div>
                        <div class="add-slot-btn">
                            <i class="fas fa-plus"></i> Ajouter un créneau
                        </div>
                        <p style="display:none;">Mercredi</p>
                    </div>
                </div>

                <!-- Jeudi -->
                <div class="day-config active">
                    <div class="day-header">
                        <div class="flex items-center gap-4">
                            <label class="switch">
                                <input type="checkbox" checked
                                    onchange="this.closest('.day-config').classList.toggle('active')">
                                <span class="slider"></span>
                            </label>
                            <span>Jeudi</span>
                        </div>
                        <span style="font-size: 0.85rem; color: var(--text-muted);">09:00 - 18:00</span>
                    </div>
                    <div class="slots-container">
                        <div class="time-slot">
                            <input type="time" name="horaires[Jeudi][0][debut]" class="input" value="09:00" style="width: auto;">
                            <span>à</span>
                            <input type="time" name="horaires[Jeudi][0][fin]" class="input" value="12:00" style="width: auto;">
                            <i class="fas fa-trash-alt remove-slot"></i>
                        </div>
                        <div class="time-slot">
                            <input type="time" name="horaires[Jeudi][1][debut]" class="input" value="14:00" style="width: auto;">
                            <span>à</span>
                            <input type="time" name="horaires[Jeudi][1][fin]" class="input" value="18:00" style="width: auto;">
                            <i class="fas fa-trash-alt remove-slot"></i>
                        </div>
                        <div class="add-slot-btn">
                            <i class="fas fa-plus"></i> Ajouter un créneau
                        </div>
                        <p style="display:none;">Jeudi</p>
                    </div>
                </div>

                <!-- Vendredi -->
                <div class="day-config active">
                    <div class="day-header">
                        <div class="flex items-center gap-4">
                            <label class="switch">
                                <input type="checkbox" checked
                                    onchange="this.closest('.day-config').classList.toggle('active')">
                                <span class="slider"></span>
                            </label>
                            <span>Vendredi</span>
                        </div>
                        <span style="font-size: 0.85rem; color: var(--text-muted);">09:00 - 17:00</span>
                    </div>
                    <div class="slots-container">
                        <div class="time-slot">
                            <input type="time" name="horaires[Vendredi][0][debut]" class="input" value="09:00" style="width: auto;">
                            <span>à</span>
                            <input type="time" name="horaires[Vendredi][0][fin]" class="input" value="12:00" style="width: auto;">
                            <i class="fas fa-trash-alt remove-slot"></i>
                        </div>
                        <div class="time-slot">
                            <input type="time" name="horaires[Vendredi][1][debut]" class="input" value="14:00" style="width: auto;">
                            <span>à</span>
                            <input type="time" name="horaires[Vendredi][1][fin]" class="input" value="17:00" style="width: auto;">
                            <i class="fas fa-trash-alt remove-slot"></i>
                        </div>
                        <div class="add-slot-btn">
                            <i class="fas fa-plus"></i> Ajouter un créneau
                        </div>
                        <p style="display:none;">Vendredi</p>
                    </div>
                </div>

                <!-- Samedi -->
                <div class="day-config">
                    <div class="day-header">
                        <div class="flex items-center gap-4">
                            <label class="switch">
                                <input type="checkbox"
                                    onchange="this.closest('.day-config').classList.toggle('active')">
                                <span class="slider"></span>
                            </label>
                            <span>Samedi</span>
                        </div>
                        <span style="font-size: 0.85rem; color: var(--text-muted);">Non travaillé</span>
                    </div>
                    <div class="slots-container">
                        <div class="add-slot-btn">
                            <i class="fas fa-plus"></i> Ajouter un créneau
                        </div>
                        <p style="display:none;">Samedi</p>
                    </div>
                </div>

                <!-- Dimanche -->
                <div class="day-config">
                    <div class="day-header">
                        <div class="flex items-center gap-4">
                            <label class="switch">
                                <input type="checkbox"
                                    onchange="this.closest('.day-config').classList.toggle('active')">
                                <span class="slider"></span>
                            </label>
                            <span>Dimanche</span>
                        </div>
                        <span style="font-size: 0.85rem; color: var(--text-muted);">Non travaillé</span>
                    </div>
                    <div class="slots-container">
                        <div class="add-slot-btn">
                            <i class="fas fa-plus"></i> Ajouter un créneau
                        </div>
                        <p style="display:none;">Dimanche</p>
                    </div>
                </div>
                 <button type="submit" class="btn btn-primary" onclick="alert('Configuration sauvegardée !')">
                    <i class="fas fa-save" style="margin-right: 0.5rem;"></i> Enregistrer
            </button>
             </form>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer style="background: var(--primary); color: white; padding: 3rem 1.5rem; margin-top: 4rem;">
        <div class="container grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem;">
            <div>
                <div class="brand" style="margin-bottom: 1rem; color: white;">
                    <i class="fas fa-balance-scale"></i>
                    <span>ISTICHARA</span>
                </div>
                <p style="color: #94a3b8; font-size: 0.9rem;">
                    Votre partenaire de confiance pour tous vos besoins juridiques au Maroc.
                </p>
            </div>
            <div>
                <h4 style="color: white; margin-bottom: 1rem;">Liens Rapides</h4>
                <ul style="display: flex; flex-direction: column; gap: 0.5rem; color: #cbd5e1;">
                    <li><a href="index.html">Tableau de bord</a></li>
                    <li><a href="#">Rendez-vous</a></li>
                    <li><a href="#">Paramètres</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
            </div>
            <div>
                <h4 style="color: white; margin-bottom: 1rem;">Contact</h4>
                <ul style="display: flex; flex-direction: column; gap: 0.5rem; color: #cbd5e1;">
                    <li><i class="fas fa-envelope margin-right-2"></i> support@istichara.ma</li>
                    <li><i class="fas fa-headset margin-right-2"></i> Centre d'aide Pro</li>
                </ul>
            </div>
        </div>
        <div class="text-center"
            style="margin-top: 3rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.1); color: #64748b; font-size: 0.875rem;">
            &copy; 2024 ISTICHARA. Tous droits réservés.
        </div>
    </footer>

    <script>
        // Simple script to handle adding slots (visual only demo)
       
        document.querySelectorAll('.add-slot-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const container = this.parentElement;
                const time_slot = container.querySelectorAll('.time-slot');
                let conteur = 0;
             
               
              
            
                time_slot.forEach(elemnt =>{
                    conteur++;
                })
               
                
                const newSlot = document.createElement('div');
                newSlot.className = 'time-slot';
                newSlot.innerHTML = `
                    <input type="time" name="horaires[${this.nextElementSibling.textContent}][${conteur}][debut]" class="input" value="09:00" style="width: auto;">
                    <span>à</span>
                    <input type="time" name="horaires[${this.nextElementSibling.textContent}][${conteur}][fin]" class="input" value="10:00" style="width: auto;">
                    <i class="fas fa-trash-alt remove-slot"></i>
                `;

                // Add remove functionality to new slot
                newSlot.querySelector('.remove-slot').addEventListener('click', function () {
                    newSlot.remove();
                });

                container.insertBefore(newSlot, this);
            });
        });

        // Add remove functionality to existing slots
        document.querySelectorAll('.remove-slot').forEach(btn => {
            btn.addEventListener('click', function () {
                this.parentElement.remove();
            });
        });
    </script>
</body>

</html>