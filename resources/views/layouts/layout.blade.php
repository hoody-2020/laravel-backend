<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title> @yield('title') </title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/event-styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ajoutez Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="header-container">
    <div class="logo-container">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
        <span class="site-title">Platforme Clubs FSBM</span>
    </div>
    <div class="auth-container">
    @auth
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-link text-dark">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </button>
        </form>
    @else
        <a href="{{ route('login') }}" class="login-btn">
            <i class="fas fa-user"></i> Connexion
        </a>
    @endauth
</div>

</div>

    <div class="navbar">
        <a href="{{ route('apropos') }}">À propos</a>
        <a href="{{ route('calendrier') }}">Calendrier Événement</a>
        <a href="{{ route('annuaire') }}">Annuaire Club</a>
        <a href="{{ route('actualite') }}">Actualité</a> 
    </div>

    <div class="content">
        @yield('content')
    </div>

    <div class="footer">
        Pied de page - Mon site Laravel
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
