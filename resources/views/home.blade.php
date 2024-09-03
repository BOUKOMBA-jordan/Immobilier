@extends('base')
@section('title', 'Accueil')

@section('content')

<style>
    .bg-custom {
        background-color: #003366; /* Bleu sombre */
        color: #ffffff; /* Texte en blanc pour contraster avec le bleu */
        border-radius: 8px; /* Coins arrondis */
        padding: 2rem; /* Padding général pour la section */
        text-align: center; /* Centrage du texte */
    }

    .bg-custom h1 {
        font-size: 2.5rem; /* Taille du titre */
        font-weight: bold; /* Gras pour le titre */
    }

    .bg-custom p {
        font-size: 1.2rem; /* Taille du texte */
    }

    .bg-custom p::before {
        content: "";
        display: block;
        height: 2px;
        width: 100px;
        background-color: #ffffff; /* Ligne décorative */
        margin: 0 auto 1rem; /* Centrer la ligne et ajouter une marge en bas */
    }

    @media (max-width: 991.98px) {
        .bg-custom {
            padding: 1.5rem; /* Réduction du padding sur les écrans moyens */
        }

        .bg-custom h1 {
            font-size: 2rem; /* Réduction de la taille du titre sur les écrans moyens */
        }

        .bg-custom p {
            font-size: 1.1rem; /* Réduction de la taille du texte sur les écrans moyens */
        }
    }

    @media (max-width: 767.98px) {
        .bg-custom {
            padding: 1rem; /* Réduction du padding sur les petits écrans */
        }

        .bg-custom h1 {
            font-size: 1.5rem; /* Réduction de la taille du titre sur les petits écrans */
        }

        .bg-custom p {
            font-size: 1rem; /* Réduction de la taille du texte sur les petits écrans */
        }
    }

    /* Styles pour les véhicules */
    .vehicle-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 1rem;
        background-color: #f9f9f9;
    }

    .vehicle-card img {
        max-width: 100%;
        border-radius: 8px;
    }

    .vehicle-card h3 {
        font-size: 1.25rem;
    }

    .vehicle-card p {
        font-size: 1rem;
    }
</style>

<div class="bg-custom mb-5 mt-5">
    <div class="container">
        <h1 class="display-4 mb-4">Agence ImmoVision</h1>
        <p class="lead mb-4">
            Chez ImmoVision, nous simplifions la recherche de véhicules pour nos clients,
            qu'ils cherchent à acheter ou louer un véhicule. Nous nous engageons à rendre
            ce processus aussi fluide et agréable que possible. Pour les vendeurs, notre objectif est
            de faciliter la mise en relation avec des acheteurs potentiels.
        </p>
    </div>
</div>

<div class="container">
    <h2>Nos derniers véhicules</h2>
    <div class="row">
        @foreach ($vehicles as $vehicle)
        <div class="col-md-4 mb-4">
            @include('vehicle.card', ['vehicle' => $vehicle])
        </div>
        @endforeach
    </div>
</div>

@endsection
