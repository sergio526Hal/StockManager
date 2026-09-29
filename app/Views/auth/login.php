<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - StockManager Pro</title>
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

        .login-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 400px;
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

        .btn-login {
            background: linear-gradient(135deg, #3498db, #2980b9);
            border: none;
            color: white;
            padding: 10px;
            border-radius: 6px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
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

        .register-link {
            text-align: center;
            margin-top: 20px;
            color: #7f8c8d;
        }

        .register-link a {
            color: #3498db;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <i class="bi bi-box-seam" style="font-size: 40px; color: #3498db;"></i>
            <h1>StockManager</h1>
            <p>Gestion Professionnelle de Stock</p>
        </div>

        <?php if (session()->has('error')): ?>
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-circle"></i> <?= session()->get('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->has('success')): ?>
            <div class="alert alert-success" style="border-left-color: #27ae60; background-color: #d5f4e6; color: #1e5c38;">
                <i class="bi bi-check-circle"></i> <?= session()->get('success') ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/auth/authenticate">
            <div class="form-group">
                <label for="username">Nom d'utilisateur ou Email</label>
                <input type="text" id="username" name="username" class="form-control" required placeholder="Entrez votre identifiant">
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="Entrez votre mot de passe">
            </div>

            <button type="submit" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right"></i> Se Connecter
            </button>
        </form>

        <div class="register-link">
            Pas encore de compte? <a href="/auth/register">S'inscrire ici</a>
        </div>
    </div>

    <script src="/assets/js/app.js"></script>
</body>
</html>
