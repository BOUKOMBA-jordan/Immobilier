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
</head>


<body>

    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container-fluid">

            <a href="/" class="navbar-brand">  <svg viewBox="0 0 400 100" width="240" height="80" xmlns="http://www.w3.org/2000/svg">
                <circle cx="200" cy="50" r="45" fill="#3498db" />
                <text x="50%" y="40%" font-family="Arial, sans-serif" font-size="40" fill="#ffffff" text-anchor="middle" alignment-baseline="middle" font-weight="bold">
                    IV
                </text>
                <text x="50%" y="65%" font-family="Arial, sans-serif" font-size="14" fill="#ffffff" text-anchor="middle" alignment-baseline="middle">
                    ImmoVision
                </text>
            </svg></a>

            <a href="/" class="navbar-brand">Accueil</a>
            <!-- Bouton du menu burger -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            @php
            $route = request()->route()->getName();
            @endphp

            <!-- Menu déroulant -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{ route('property.index') }}" @class(['nav-link', 'active'=> str_contains($route, 'property.')])>Maison</a>
                    </li>
                    <!-- Ajoutez d'autres éléments de menu ici si nécessaire -->
                </ul>
            </div>
        </div>
    </nav>


    @yield('content')



    <!-- jQuery (nécessaire pour Bootstrap JavaScript) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
