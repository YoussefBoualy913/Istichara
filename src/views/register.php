<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Istichara - Authentification</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: linear-gradient(135deg, #1a2332 0%, #2d3e50 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            width: 100%;
            max-width: 900px;
            min-height: 600px;
            display: flex;
        }

        .auth-sidebar {
            background: linear-gradient(135deg, #1a2332 0%, #2d3e50 100%);
            color: white;
            padding: 60px 40px;
            width: 40%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 30px;
        }

        .auth-sidebar h2 {
            font-size: 28px;
            margin-bottom: 15px;
        }

        .auth-sidebar p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.6;
        }

        .auth-content {
            padding: 60px 50px;
            width: 60%;
            overflow-y: auto;
        }

        .auth-header {
            margin-bottom: 40px;
        }

        .auth-header h1 {
            color: #1a2332;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .auth-header p {
            color: #6b7280;
            font-size: 14px;
        }

        .user-type-selection {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }

        .user-type-card {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 25px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .user-type-card:hover {
            border-color: #1a2332;
            transform: translateY(-2px);
        }

        .user-type-card.active {
            border-color: #1a2332;
            background: #f8fafc;
        }

        .user-type-card .icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .user-type-card h3 {
            color: #1a2332;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .user-type-card p {
            color: #6b7280;
            font-size: 12px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #374151;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #1a2332;
        }

        .file-upload {
            border: 2px dashed #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload:hover {
            border-color: #1a2332;
            background: #f8fafc;
        }

        .file-upload input {
            display: none;
        }

        .file-upload .upload-icon {
            font-size: 32px;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .file-name {
            margin-top: 10px;
            font-size: 12px;
            color: #10b981;
        }

        .progress-container {
            margin-bottom: 30px;
        }

        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .progress-step {
            flex: 1;
            text-align: center;
            position: relative;
        }

        .progress-step-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #e5e7eb;
            color: #6b7280;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 8px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .progress-step.active .progress-step-circle {
            background: #1a2332;
            color: white;
        }

        .progress-step.completed .progress-step-circle {
            background: #10b981;
            color: white;
        }

        .progress-step-label {
            font-size: 12px;
            color: #6b7280;
        }

        .progress-bar {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%;
            background: #1a2332;
            transition: width 0.3s ease;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            padding: 14px 24px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #1a2332;
            color: white;
        }

        .btn-primary:hover {
            background: #2d3e50;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: #e5e7eb;
            color: #374151;
        }

        .btn-secondary:hover {
            background: #d1d5db;
        }

        .auth-footer {
            margin-top: 25px;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
        }

        .auth-footer a {
            color: #1a2332;
            text-decoration: none;
            font-weight: 600;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        .hidden {
            display: none;
        }

        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
            }

            .auth-sidebar,
            .auth-content {
                width: 100%;
            }

            .auth-sidebar {
                padding: 40px 30px;
            }

            .auth-content {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-sidebar">
            <div class="logo">ISTICHARA</div>
            <h2>Bienvenue sur notre plateforme</h2>
            <p>Connectez-vous pour accéder à vos services juridiques ou inscrivez-vous pour rejoindre notre communauté de professionnels.</p>
        </div>

        <div class="auth-content">
            <!-- Login Form -->
            <div id="loginForm">
                <div class="auth-header">
                    <h1>Connexion</h1>
                    <p>Entrez vos identifiants pour accéder à votre compte</p>
                </div>

                <form method="POST" action="/auth/login">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" required placeholder="votre@email.com">
                    </div>

                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" name="password" required placeholder="••••••••">
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">Se connecter</button>
                </form>

                <div class="auth-footer">
                    Pas encore de compte ? <a href="#" onclick="showRegister()">S'inscrire</a>
                </div>
            </div>

            <!-- Register Type Selection -->
            <div id="registerTypeSelection" class="hidden">
                <div class="auth-header">
                    <h1>Créer un compte</h1>
                    <p>Choisissez votre type de compte</p>
                </div>

                <div class="user-type-selection">
                    <div class="user-type-card" onclick="selectUserType('client')">
                        <div class="icon">👤</div>
                        <h3>Client</h3>
                        <p>Je recherche des services juridiques</p>
                    </div>

                    <div class="user-type-card" onclick="selectUserType('professionnel')">
                        <div class="icon">⚖️</div>
                        <h3>Professionnel</h3>
                        <p>Je suis avocat ou huissier</p>
                    </div>
                </div>

                <div class="auth-footer">
                    Déjà inscrit ? <a href="#" onclick="showLogin()">Se connecter</a>
                </div>
            </div>

            <!-- Client Register Form -->
            <div id="clientRegisterForm" class="hidden">
                <div class="auth-header">
                    <h1>Inscription Client</h1>
                    <p>Créez votre compte client</p>
                </div>

                <form action="auth/client/register" method="POST" onsubmit="handleClientRegister(event)">
                    <div class="form-group">
                        <label>Nom complet</label>
                        <input type="text" name="name" required placeholder="Votre nom">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" required placeholder="votre@email.com">
                    </div>

                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" name="password" required placeholder="••••••••">
                    </div>

                    <input type="hidden" name="role" value="client">

                    <button type="submit" class="btn btn-primary" style="width: 100%;">S'inscrire</button>
                </form>

                <div class="auth-footer">
                    <a href="#" onclick="showRegister()">← Retour</a>
                </div>
            </div>

            <!-- Professional Register Form - Step 1 -->
            <div id="professionalRegisterStep1" class="hidden">
                <div class="auth-header">
                    <h1>Inscription Professionnel</h1>
                    <p>Étape 1 sur 3 - Informations de base</p>
                </div>

                <div class="progress-container">
                    <div class="progress-steps">
                        <div class="progress-step active">
                            <div class="progress-step-circle">1</div>
                            <div class="progress-step-label">Infos</div>
                        </div>
                        <div class="progress-step">
                            <div class="progress-step-circle">2</div>
                            <div class="progress-step-label">Détails</div>
                        </div>
                        <div class="progress-step">
                            <div class="progress-step-circle">3</div>
                            <div class="progress-step-label">Documents</div>
                        </div>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-bar-fill" style="width: 33%"></div>
                    </div>
                </div>

                <form id="step1Form">
                    <div class="form-group">
                        <label>Nom complet</label>
                        <input type="text" id="proName" required placeholder="Votre nom">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="proEmail" required placeholder="votre@email.com">
                    </div>

                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" id="proPassword" required placeholder="••••••••">
                    </div>

                    <div class="form-group">
                        <label>Type de professionnel</label>
                        <select id="proType" required>
                            <option value="">Sélectionnez votre profession</option>
                            <option value="avocat">Avocat</option>
                            <option value="huissier">Huissier</option>
                        </select>
                    </div>

                    <div class="button-group">
                        <button type="button" class="btn btn-secondary" onclick="showRegister()">Retour</button>
                        <button type="button" class="btn btn-primary" onclick="goToStep2()">Suivant</button>
                    </div>
                </form>
            </div>

            <!-- Professional Register Form - Step 2 -->
            <div id="professionalRegisterStep2" class="hidden">
                <div class="auth-header">
                    <h1>Inscription Professionnel</h1>
                    <p>Étape 2 sur 3 - Détails professionnels</p>
                </div>

                <div class="progress-container">
                    <div class="progress-steps">
                        <div class="progress-step completed">
                            <div class="progress-step-circle">✓</div>
                            <div class="progress-step-label">Infos</div>
                        </div>
                        <div class="progress-step active">
                            <div class="progress-step-circle">2</div>
                            <div class="progress-step-label">Détails</div>
                        </div>
                        <div class="progress-step">
                            <div class="progress-step-circle">3</div>
                            <div class="progress-step-label">Documents</div>
                        </div>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-bar-fill" style="width: 66%"></div>
                    </div>
                </div>

                <form id="step2Form">
                    <div class="form-group">
                        <label>Ville</label>
                        <select id="ville" required>
                            <option value="">Sélectionnez votre ville</option>
                            <option value="Casablanca">Casablanca</option>
                            <option value="Rabat">Rabat</option>
                            <option value="Fès">Fès</option>
                            <option value="Marrakech">Marrakech</option>
                            <option value="Agadir">Agadir</option>
                            <option value="Tanger">Tanger</option>
                            <option value="Meknès">Meknès</option>
                            <option value="Oujda">Oujda</option>
                            <option value="Kenitra">Kenitra</option>
                            <option value="Tétouan">Tétouan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Années d'expérience</label>
                        <input type="number" id="experience" required min="0" placeholder="Ex: 5">
                    </div>

                    <div class="form-group" id="specialiteGroup" style="display: none;">
                        <label>Spécialité</label>
                        <select id="specialite">
                            <option value="">Sélectionnez votre spécialité</option>
                            <option value="Droit penal">Droit pénal</option>
                            <option value="civil">Civil</option>
                            <option value="famille">Famille</option>
                            <option value="affaires">Affaires</option>
                        </select>
                    </div>

                    <div class="form-group" id="typeActesGroup" style="display: none;">
                        <label>Type d'actes</label>
                        <select id="typeActes">
                            <option value="">Sélectionnez le type d'actes</option>
                            <option value="Signification">Signification</option>
                            <option value="execution">Exécution</option>
                            <option value="constats">Constats</option>
                        </select>
                    </div>

                    <div class="button-group">
                        <button type="button" class="btn btn-secondary" onclick="goToStep1()">Retour</button>
                        <button type="button" class="btn btn-primary" onclick="goToStep3()">Suivant</button>
                    </div>
                </form>
            </div>

            <!-- Professional Register Form - Step 3 -->
            <div id="professionalRegisterStep3" class="hidden">
                <div class="auth-header">
                    <h1>Inscription Professionnel</h1>
                    <p>Étape 3 sur 3 - Documents</p>
                </div>

                <div class="progress-container">
                    <div class="progress-steps">
                        <div class="progress-step completed">
                            <div class="progress-step-circle">✓</div>
                            <div class="progress-step-label">Infos</div>
                        </div>
                        <div class="progress-step completed">
                            <div class="progress-step-circle">✓</div>
                            <div class="progress-step-label">Détails</div>
                        </div>
                        <div class="progress-step active">
                            <div class="progress-step-circle">3</div>
                            <div class="progress-step-label">Documents</div>
                        </div>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-bar-fill" style="width: 100%"></div>
                    </div>
                </div>

                <form id="step3Form" method="POST" enctype="multipart/form-data" onsubmit="handleProfessionalRegister(event)">
                    <div class="form-group">
                        <label>Certificat professionnel</label>
                        <div class="file-upload" onclick="document.getElementById('certif').click()">
                            <input type="file" id="certif" name="certificat" accept=".pdf,.jpg,.jpeg,.png" required onchange="updateFileName('certif', 'certifName')">
                            <div class="upload-icon">📄</div>
                            <p>Cliquez pour télécharger votre certificat</p>
                            <div class="file-name" id="certifName"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Document de vérification</label>
                        <div class="file-upload" onclick="document.getElementById('review').click()">
                            <input type="file" id="review" name="document" accept=".pdf,.jpg,.jpeg,.png" required onchange="updateFileName('review', 'reviewName')">
                            <div class="upload-icon">📋</div>
                            <p>Cliquez pour télécharger votre document</p>
                            <div class="file-name" id="reviewName"></div>
                        </div>
                    </div>

                    <!-- Champs cachés pour toutes les données -->
                    <input type="hidden" id="finalName" name="name">
                    <input type="hidden" id="finalEmail" name="email">
                    <input type="hidden" id="finalPassword" name="password">
                    <input type="hidden" id="finalType" name="type">
                    <input type="hidden" id="finalVille" name="ville">
                    <input type="hidden" id="finalExperience" name="experience">
                    <input type="hidden" id="finalSpecialite" name="specialite">
                    <input type="hidden" id="finalTypeActes" name="typeActes">

                    <div class="button-group">
                        <button type="button" class="btn btn-secondary" onclick="goToStep2()">Retour</button>
                        <button type="submit" class="btn btn-primary">Confirmer l'inscription</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let professionalData = {};

        function showLogin() {
            hideAllForms();
            document.getElementById('loginForm').classList.remove('hidden');
        }

        function showRegister() {
            hideAllForms();
            document.getElementById('registerTypeSelection').classList.remove('hidden');
        }

        function hideAllForms() {
            document.getElementById('loginForm').classList.add('hidden');
            document.getElementById('registerTypeSelection').classList.add('hidden');
            document.getElementById('clientRegisterForm').classList.add('hidden');
            document.getElementById('professionalRegisterStep1').classList.add('hidden');
            document.getElementById('professionalRegisterStep2').classList.add('hidden');
            document.getElementById('professionalRegisterStep3').classList.add('hidden');
        }

        function selectUserType(type) {
            hideAllForms();
            if (type === 'client') {
                document.getElementById('clientRegisterForm').classList.remove('hidden');
            } else {
                document.getElementById('professionalRegisterStep1').classList.remove('hidden');
            }
        }

        function goToStep1() {
            hideAllForms();
            document.getElementById('professionalRegisterStep1').classList.remove('hidden');
        }

        function goToStep2() {
            const name = document.getElementById('proName').value;
            const email = document.getElementById('proEmail').value;
            const password = document.getElementById('proPassword').value;
            const type = document.getElementById('proType').value;

            if (!name || !email || !password || !type) {
                alert('Veuillez remplir tous les champs');
                return;
            }

            professionalData = { name, email, password, type, role: 'professionnel' };

            const form = document.getElementById('step3Form');
            if (type === 'avocat') {
                form.action = 'auth/avocat/register';
            } else if (type === 'huissier') {
                form.action = 'auth/huissier/register';
            }

            if (type === 'avocat') {
                document.getElementById('specialiteGroup').style.display = 'block';
                document.getElementById('typeActesGroup').style.display = 'none';
                document.getElementById('specialite').required = true;
                document.getElementById('typeActes').required = false;
            } else {
                document.getElementById('specialiteGroup').style.display = 'none';
                document.getElementById('typeActesGroup').style.display = 'block';
                document.getElementById('specialite').required = false;
                document.getElementById('typeActes').required = true;
            }

            hideAllForms();
            document.getElementById('professionalRegisterStep2').classList.remove('hidden');
        }

        function goToStep3() {
            const ville = document.getElementById('ville').value;
            const experience = document.getElementById('experience').value;

            if (!ville || !experience) {
                alert('Veuillez remplir tous les champs');
                return;
            }

            professionalData.ville = ville;
            professionalData.experience = experience;

            if (professionalData.type === 'avocat') {
                const specialite = document.getElementById('specialite').value;
                if (!specialite) {
                    alert('Veuillez sélectionner votre spécialité');
                    return;
                }
                professionalData.specialite = specialite;
            } else {
                const typeActes = document.getElementById('typeActes').value;
                if (!typeActes) {
                    alert('Veuillez sélectionner le type d\'actes');
                    return;
                }
                professionalData.typeActes = typeActes;
            }

            document.getElementById('finalName').value = professionalData.name;
            document.getElementById('finalEmail').value = professionalData.email;
            document.getElementById('finalPassword').value = professionalData.password;
            document.getElementById('finalType').value = professionalData.type;
            document.getElementById('finalVille').value = professionalData.ville;
            document.getElementById('finalExperience').value = professionalData.experience;
            
            if (professionalData.type === 'avocat') {
                document.getElementById('finalSpecialite').value = professionalData.specialite;
                document.getElementById('finalTypeActes').value = '';
            } else {
                document.getElementById('finalSpecialite').value = '';
                document.getElementById('finalTypeActes').value = professionalData.typeActes;
            }

            hideAllForms();
            document.getElementById('professionalRegisterStep3').classList.remove('hidden');
        }

        function updateFileName(inputId, displayId) {
            const input = document.getElementById(inputId);
            const display = document.getElementById(displayId);
            if (input.files.length > 0) {
                display.textContent = '✓ ' + input.files[0].name;
            }
        }
        function handleClientRegister(e) {
            // Le formulaire sera soumis normalement à client/create
            console.log('Soumission du formulaire client...');
        }

        function handleProfessionalRegister(e) {
            // Vérifier les fichiers avant soumission
            const certif = document.getElementById('certif').files[0];
            const review = document.getElementById('review').files[0];

            if (!certif || !review) {
                alert('Veuillez télécharger tous les documents');
                e.preventDefault();
                return;
            }

            console.log('Soumission du formulaire professionnel vers:', e.target.action);
        }
    </script>
</body>
</html>