<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'Laravel Blog - Un blog moderne créé avec Laravel 12 et PHP 8. Découvrez des articles sur la programmation, le développement web et plus encore.')">
    <meta name="author" content="Fileryn">
    <meta name="keywords" content="Laravel, Blog, PHP, Programmation, Développement Web">
    <meta property="og:title" content="@yield('title', 'Laravel Blog')">
    <meta property="og:description" content="@yield('description', 'Un blog moderne créé avec Laravel')">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary">
    <title>@yield('title', 'Laravel Blog')</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🚀</text></svg>" type="image/svg+xml">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        /* Navigation */
        .navbar {
            background: rgba(0, 0, 0, 0.2);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(10px);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .navbar-brand:hover {
            opacity: 0.9;
        }
        .navbar-menu {
            display: flex;
            gap: 5px;
            align-items: center;
        }
        .navbar-link {
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s;
            font-size: 0.95rem;
        }
        .navbar-link:hover {
            background: rgba(255, 255, 255, 0.15);
        }
        .navbar-link.active {
            background: rgba(255, 255, 255, 0.25);
            font-weight: 600;
        }
        .navbar-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .navbar-username {
            opacity: 0.9;
            font-size: 0.95rem;
        }
        /* Boutons */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            cursor: pointer;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }
        .btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .btn-sm {
            padding: 6px 14px;
            font-size: 0.85rem;
        }
        .btn-success {
            background: rgba(39, 174, 96, 0.8);
            border-color: rgba(39, 174, 96, 0.9);
        }
        .btn-success:hover {
            background: rgba(39, 174, 96, 1);
        }
        .btn-warning {
            background: rgba(241, 196, 15, 0.8);
            border-color: rgba(241, 196, 15, 0.9);
        }
        .btn-warning:hover {
            background: rgba(241, 196, 15, 1);
        }
        .btn-danger {
            background: rgba(231, 76, 60, 0.8);
            border-color: rgba(231, 76, 60, 0.9);
        }
        .btn-danger:hover {
            background: rgba(231, 76, 60, 1);
        }
        .btn-primary {
            background: rgba(52, 152, 219, 0.8);
            border-color: rgba(52, 152, 219, 0.9);
        }
        .btn-primary:hover {
            background: rgba(52, 152, 219, 1);
        }
        /* Container */
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        /* Cards */
        .card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        /* Alertes */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            animation: slideIn 0.3s ease;
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .alert-success {
            background: rgba(39, 174, 96, 0.3);
            border: 1px solid rgba(39, 174, 96, 0.5);
        }
        .alert-info {
            background: rgba(52, 152, 219, 0.3);
            border: 1px solid rgba(52, 152, 219, 0.5);
        }
        .alert-warning {
            background: rgba(241, 196, 15, 0.3);
            border: 1px solid rgba(241, 196, 15, 0.5);
        }
        /* Titres */
        .page-title {
            text-align: center;
            font-size: 2.2rem;
            margin-bottom: 30px;
        }
        /* Tables */
        .table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            overflow: hidden;
        }
        .table th, .table td {
            padding: 15px;
            text-align: left;
        }
        .table th {
            background: rgba(255, 255, 255, 0.15);
            font-weight: 600;
        }
        .table tr {
            transition: background 0.2s;
        }
        .table tr:hover {
            background: rgba(255, 255, 255, 0.08);
        }
        /* Formulaires */
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 1rem;
            font-family: inherit;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-control:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.6);
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }
        select.form-control {
            cursor: pointer;
        }
        select.form-control option {
            background: #667eea;
            color: white;
        }
        .form-error {
            color: #ff6b6b;
            font-size: 0.85rem;
            margin-top: 5px;
        }
        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 25px;
        }
        /* Badges */
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        /* Utilitaires */
        .text-center { text-align: center; }
        .text-muted { opacity: 0.7; }
        .mb-0 { margin-bottom: 0; }
        .mb-1 { margin-bottom: 10px; }
        .mb-2 { margin-bottom: 20px; }
        .mb-3 { margin-bottom: 30px; }
        .mt-2 { margin-top: 20px; }
        .mt-3 { margin-top: 30px; }
        .d-flex { display: flex; }
        .gap-1 { gap: 10px; }
        .gap-2 { gap: 15px; }
        .justify-center { justify-content: center; }
        .justify-between { justify-content: space-between; }
        .align-center { align-items: center; }
        .flex-wrap { flex-wrap: wrap; }
        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-top: 25px;
            flex-wrap: wrap;
        }
        .pagination-btn {
            padding: 10px 16px;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .pagination-btn:hover:not(.disabled):not(.active) {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }
        .pagination-btn.active {
            background: rgba(255, 255, 255, 0.35);
            font-weight: bold;
            border-color: rgba(255, 255, 255, 0.5);
        }
        .pagination-btn.disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }
        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            opacity: 0.7;
            font-size: 0.9rem;
            margin-top: 40px;
        }
        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
                padding: 15px;
            }
            .navbar-menu {
                flex-wrap: wrap;
                justify-content: center;
            }
            .table {
                font-size: 0.85rem;
            }
            .table th, .table td {
                padding: 10px;
            }
            .d-flex {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <a href="{{ url('/') }}" class="navbar-brand">🚀 Laravel Blog</a>
        
        <div class="navbar-menu">
            <a href="{{ url('/') }}" class="navbar-link {{ request()->is('/') ? 'active' : '' }}">🏠 Accueil</a>
            <a href="{{ route('articles.index') }}" class="navbar-link {{ request()->is('articles*') ? 'active' : '' }}">📝 Articles</a>
            <a href="{{ route('categories.index') }}" class="navbar-link {{ request()->is('categories*') ? 'active' : '' }}">🏷️ Catégories</a>
            <a href="{{ url('/vue') }}" class="navbar-link {{ request()->is('vue') ? 'active' : '' }}">ℹ️ À propos</a>
        </div>

        <div class="navbar-user">
            @auth
                <span class="navbar-username">
                    👤 {{ Auth::user()->name }}
                    @if(Auth::user()->isAdmin())
                        <span class="badge" style="background: #e74c3c; margin-left: 5px;">Admin</span>
                    @elseif(Auth::user()->isModerator())
                        <span class="badge" style="background: #f39c12; margin-left: 5px;">Modérateur</span>
                    @endif
                </span>
                <a href="{{ route('dashboard') }}" class="btn btn-sm">Dashboard</a>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-sm">Déconnexion</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-sm">Connexion</a>
                <a href="{{ route('register') }}" class="btn btn-sm btn-success">Inscription</a>
            @endauth
        </div>
    </nav>

    <!-- Contenu -->
    <main class="container">
        @if(session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-warning">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>🚀 Laravel Blog • Créé par <strong>Fileryn</strong> • {{ date('Y') }}</p>
        <p style="font-size: 0.8rem; margin-top: 5px;">Laravel {{ app()->version() }} • PHP {{ PHP_VERSION }}</p>
    </footer>
</body>
</html>
