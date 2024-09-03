@extends('base')

@section('title', $vehicle->make . ' ' . $vehicle->model)

@section('content')
<div class="container mt-5">
    <h1 class="display-4 mb-4">{{ $vehicle->make }} {{ $vehicle->model }}</h1>
    <p class="lead">{{ $vehicle->description }}</p>

    <!-- Carrousel pour les images -->
    <div id="carouselExample" class="carousel slide shadow-sm rounded" data-bs-ride="carousel">
        <div class="carousel-inner">
            @forelse ($vehicle->pictures as $picture)
            <div class="carousel-item @if ($loop->first) active @endif">
                <img src="{{ asset('storage/' . $picture->filename) }}" class="d-block w-100 rounded" alt="Image de {{ $vehicle->make }} {{ $vehicle->model }}">
            </div>
            @empty
            <div class="carousel-item active">
                <img src="{{ asset('default-image.jpg') }}" class="d-block w-100 rounded" alt="Aucune image disponible pour {{ $vehicle->make }} {{ $vehicle->model }}">
            </div>
            @endforelse
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
            <span class="visually-hidden">Précédent</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
            <span class="visually-hidden">Suivant</span>
        </button>
    </div>

    <!-- Autres informations sur le véhicule -->
    <ul class="list-unstyled mt-4">
        <li><strong>Année:</strong> {{ $vehicle->year }}</li>
        <li><strong>Prix:</strong> <span class="text-danger">{{ number_format($vehicle->price, 2, '.', ' ') }} €</span></li>
        <li><strong>Kilométrage:</strong> {{ $vehicle->mileage }} km</li>
        <li><strong>Couleur:</strong> {{ $vehicle->color }}</li>
    </ul>
</div>

<!-- Styles pour le carrousel et les éléments de la page -->
@section('styles')
<style>
    /* Carrousel styling */
    #carouselExample {
        max-height: 500px; /* Réglage de la hauteur du carrousel */
        overflow: hidden; /* Masque les parties des images qui dépassent */
        border-radius: 10px; /* Coins arrondis */
    }

    #carouselExample .carousel-item img {
        object-fit: cover; /* Assure que les images couvrent la zone du carrousel sans distorsion */
        height: 500px; /* Ajuste la hauteur des images */
    }

    /* Style des boutons du carrousel */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 30px;
        height: 30px;
    }

    /* Typographie et mise en page */
    h1.display-4 {
        font-weight: 700;
        color: #333;
    }

    p.lead {
        font-size: 1.2rem;
        color: #555;
    }

    /* Liste des caractéristiques du véhicule */
    ul.list-unstyled {
        font-size: 1.1rem;
        color: #333;
    }

    ul.list-unstyled li strong {
        font-weight: 600;
        color: #000;
    }

    .text-danger {
        font-weight: bold;
        font-size: 1.5rem;
    }
</style>
@endsection
@endsection
