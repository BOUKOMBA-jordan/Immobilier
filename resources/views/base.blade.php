<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Favicon SVG -->
    <link rel="icon" type="image/favicon.ico" href="favicon.ico">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>@yield('title') | MonAgence</title>

    <style>
        .navbar-nav .nav-link {
            color: #f8f9fa; /* Augmente la luminosité du texte des onglets */
        }
        
        .navbar-nav .nav-link.active {
            color: #ffffff; /* Couleur du texte de l'onglet actif */
            font-weight: bold; /* Met le texte de l'onglet actif en gras */
        }
        
        .navbar-nav .nav-link:hover {
            color: #e0e0e0; /* Couleur du texte des onglets au survol */
        }



        .login-btn {
            padding: 0.25rem 0.5rem; /* Réduit l'espace intérieur du bouton */
            font-size: 0.75rem; /* Réduit la taille du texte et de l'icône */
            border: 1px solid rgba(255, 255, 255, 0.5); /* Réduit l'opacité de la bordure */
            background-color: transparent; /* Rend le fond du bouton transparent */
            color: rgba(255, 255, 255, 0.75); /* Réduit l'opacité de la couleur du texte */
        }
    
        .login-btn i {
            font-size: 0.75rem; /* Réduit la taille de l'icône */
        }
    
        .login-btn:hover {
            color: #ffffff; /* Couleur du texte au survol */
            border-color: #ffffff; /* Couleur de la bordure au survol */
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container-fluid">
            <!-- Logo SVG responsive -->
            <a href="/" class="navbar-brand">
                <svg viewBox="0 0 400 100" width="240" height="80" xmlns="http://www.w3.org/2000/svg" class="img-fluid">
                    <circle cx="200" cy="50" r="45" fill="#3498db" />
                    <text x="50%" y="40%" font-family="Arial, sans-serif" font-size="40" fill="#ffffff" text-anchor="middle" alignment-baseline="middle" font-weight="bold">
                        IV
                    </text>
                    <text x="50%" y="65%" font-family="Arial, sans-serif" font-size="14" fill="#ffffff" text-anchor="middle" alignment-baseline="middle">
                        ImmoVision
                    </text>
                </svg>
            </a>

            <!-- Bouton du menu burger -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            @php
            $route = request()->route()->getName();
            @endphp

            <!-- Menu déroulant -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="/" class="nav-link {{ str_contains($route, 'home') ? 'active' : '' }}">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('property.index') }}" class="nav-link {{ str_contains($route, 'property.') ? 'active' : '' }}">Maison</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm login-btn">
                            <i class="fas fa-key"></i>
                        </a>
                    </li>
                    @endguest
                    

                    @auth
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light">
                                <i class="fas fa-key"></i>
                            </button>
                        </form>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- jQuery (nécessaire pour Bootstrap JavaScript) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
