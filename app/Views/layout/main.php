<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Gestion de Stock' ?> - StockManager Pro</title>
    <link href="/assets/css/app.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #ecf0f1;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .main-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: linear-gradient(135deg, var(--primary-color), #34495e);
            color: white;
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar .logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }

        .sidebar .logo h3 {
            font-size: 20px;
            margin: 0;
            font-weight: 700;
        }

        .sidebar .logo p {
            font-size: 11px;
            color: #bdc3c7;
            margin-top: 5px;
        }

        .sidebar .menu {
            list-style: none;
        }

        .sidebar .menu li {
            margin: 0;
        }

        .sidebar .menu a {
            display: block;
            padding: 12px 20px;
            color: #ecf0f1;
            text-decoration: none;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
        }

        .sidebar .menu a:hover,
        .sidebar .menu a.active {
            background-color: rgba(255,255,255,0.1);
            border-left-color: var(--secondary-color);
            padding-left: 25px;
        }

        .sidebar .menu i {
            margin-right: 10px;
            width: 20px;
        }

        .content {
            margin-left: 250px;
            flex: 1;
            padding: 20px;
        }

        .navbar-top {
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            border-radius: 8px;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-top .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar-top .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 20px;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), #34495e);
            color: white;
            border: none;
            border-radius: 8px 8px 0 0;
            padding: 15px 20px;
        }

        .card-body {
            padding: 20px;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .btn-success {
            background-color: var(--success-color);
            border-color: var(--success-color);
        }

        .btn-danger {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }

        .btn-warning {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
        }

        .table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead th {
            background-color: #f8f9fa;
            border: none;
            color: var(--primary-color);
            font-weight: 600;
            padding: 15px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-color: #e0e0e0;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .alert {
            border: none;
            border-radius: 8px;
            border-left: 4px solid;
        }

        .alert-success {
            border-left-color: var(--success-color);
            background-color: #d5f4e6;
            color: #1e5c38;
        }

        .alert-danger {
            border-left-color: var(--danger-color);
            background-color: #fde7e5;
            color: #8a2c2a;
        }

        .alert-warning {
            border-left-color: var(--warning-color);
            background-color: #fff7e6;
            color: #8a5e00;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-status-active {
            background-color: #d5f4e6;
            color: #1e5c38;
        }

        .badge-status-inactive {
            background-color: #f0f0f0;
            color: #666;
        }

        .stat-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            margin-bottom: 20px;
            border-top: 4px solid var(--secondary-color);
        }

        .stat-box h6 {
            color: #7f8c8d;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .stat-box h3 {
            color: var(--primary-color);
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control,
        .form-select {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px 15px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .btn {
            border-radius: 6px;
            padding: 8px 16px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 200px;
            }
        }

        @media (max-width: 576px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                margin-bottom: 20px;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <div class="sidebar">
            <div class="logo">
                <h3><i class="bi bi-box-seam"></i> StockManager</h3>
                <p>Gestion Professionnelle</p>
            </div>
            <ul class="menu">
                <li><a href="/dashboard" class="<?= strpos(current_url(), '/dashboard') !== false ? 'active' : '' ?>"><i class="bi bi-speedometer2"></i> Tableau de Bord</a></li>
                <li><a href="/product" class="<?= strpos(current_url(), '/product') !== false ? 'active' : '' ?>"><i class="bi bi-box"></i> Produits</a></li>
                <li><a href="/stock" class="<?= strpos(current_url(), '/stock') !== false ? 'active' : '' ?>"><i class="bi bi-boxes"></i> Stocks</a></li>
                <li><a href="/category" class="<?= strpos(current_url(), '/category') !== false ? 'active' : '' ?>"><i class="bi bi-folder"></i> Catégories</a></li>
                <li><a href="/report" class="<?= strpos(current_url(), '/report') !== false ? 'active' : '' ?>"><i class="bi bi-graph-up"></i> Rapports</a></li>
                <li><a href="/auth/logout"><i class="bi bi-box-arrow-right"></i> Déconnexion</a></li>
            </ul>
        </div>

        <div class="content">
            <div class="navbar-top">
                <h4 style="margin: 0; color: var(--primary-color); font-weight: 700;"><?= $title ?? 'Tableau de Bord' ?></h4>
                <div class="user-info">
                    <span><?= session()->get('full_name') ?? 'Utilisateur' ?></span>
                    <div class="user-avatar"><?= substr(session()->get('full_name') ?? 'U', 0, 1) ?></div>
                </div>
            </div>

            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <script src="/assets/js/app.js"></script>
</body>
</html>
