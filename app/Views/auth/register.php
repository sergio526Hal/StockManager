<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - StockManager Pro</title>
    <link href="/assets/css/app.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .register-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 450px;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-section h1 {
            color: #2c3e50;
            font-size: 32px;
            font-weight: 700;
            margin: 0;
        }

        .logo-section p {
            color: #7f8c8d;
            font-size: 14px;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px 15px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .btn-register {
            background: linear-gradient(135deg, #3498db, #2980b9);
            border: none;
            color: white;
            padding: 10px;
            border-radius: 6px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #2980b9, #1f618d);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
            color: white;
        }

        .alert {
            border: none;
            border-left: 4px solid;
            border-radius: 6px;
        }

        .alert-danger {
            border-left-color: #e74c3c;
            background-color: #fde7e5;
            color: #8a2c2a;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #7f8c8d;
        }

        .login-link a {
            color: #3498db;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .password-strength {
            font-size: 12px;
            margin-top: 5px;
        }

        .strength-weak { color: #e74c3c; }
        .strength-fair { color: #f39c12; }
        .strength-good { color: #3498db; }
        .strength-strong { color: #27ae60; }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="logo-section">
            <i class="bi bi-box-seam" style="font-size: 40px; color: #3498db;"></i>
            <h1>StockManager</h1>
            <p>Créer un compte</p>
        </div>

        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle"></i> <?= session()->get('error') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/auth/register">
            <div class="form-group">
                <label for="full_name">Nom Complet</label>
                <input type="text" id="full_name" name="full_name" class="form-control" required placeholder="Entrez votre nom complet">
            </div>

            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" class="form-control" required placeholder="Entrez votre nom d'utilisateur">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required placeholder="Entrez votre email">
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="Minimum 6 caractères">
                <div id="passwordStrength" class="password-strength"></div>
            </div>

            <div class="form-group">
                <label for="password_confirm">Confirmer le mot de passe</label>
                <input type="password" id="password_confirm" name="password_confirm" class="form-control" required placeholder="Répétez le mot de passe">
            </div>

            <button type="submit" class="btn btn-register">
                <i class="bi bi-person-plus"></i> S'Inscrire
            </button>
        </form>

        <div class="login-link">
            Déjà inscrit? <a href="/auth/login">Se connecter ici</a>
        </div>
    </div>

    <script src="/assets/js/app.js"></script>
    <script>
        const passwordInput = document.getElementById('password');
        const strengthDiv = document.getElementById('passwordStrength');

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            let strengthText = '';
            let strengthClass = '';

            if (password.length >= 6) strength++;
            if (password.length >= 10) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            if (strength <= 1) {
                strengthText = 'Faible';
                strengthClass = 'strength-weak';
            } else if (strength <= 2) {
                strengthText = 'Moyen';
                strengthClass = 'strength-fair';
            } else if (strength <= 3) {
                strengthText = 'Bon';
                strengthClass = 'strength-good';
            } else {
                strengthText = 'Très Bon';
                strengthClass = 'strength-strong';
            }

            strengthDiv.textContent = `Force: ${strengthText}`;
            strengthDiv.className = `password-strength ${strengthClass}`;
        });
    </script>
</body>
</html>
