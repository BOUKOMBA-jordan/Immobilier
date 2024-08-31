<style>
    .card {
        border: none; /* Supprime la bordure par défaut */
        border-radius: 15px; /* Ajoute des coins arrondis */
        overflow: hidden; /* Assure que le contenu ne dépasse pas les bordures de la carte */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ajoute une ombre subtile */
        transition: transform 0.3s, box-shadow 0.3s; /* Ajoute une transition pour les animations */
    }
    .card:hover {
        transform: translateY(-10px); /* Légère élévation au survol */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Ombre plus intense au survol */
    }
    .property-image {
        width: 100%;
        height: 200px; /* Hauteur fixe pour une meilleure uniformité */
        object-fit: cover; /* Assure que l'image couvre le conteneur */
    }
    .card-body {
        padding: 20px; /* Ajoute des marges internes */
        background-color: #f8f9fa; /* Couleur de fond légère pour le contraste */
    }
    .card-title a {
        color: #007bff; /* Couleur du texte pour une bonne lisibilité */
        transition: color 0.3s; /* Transition pour la couleur au survol */
    }
    .card-title a:hover {
        color: #007bff; /* Change la couleur du texte au survol */
    }
    .card-text {
        color: #666; /* Couleur de texte plus douce */
    }
    .text-primary {
        color: #2289ff !important; /* Utilisation d'une couleur vive pour le prix */
    }
</style>

<div class="card">
    <img src="{{ asset($property->pictures->isNotEmpty() ? $property->pictures->first()->image : 'default-image.jpg') }}" class="card-img-top property-image" alt="Image de {{ $property->title }}">
    
    <div class="card-body">
        <h5 class="card-title">
            <a href="{{ route('property.show', ['slug' => $property->getSlug(), 'property' => $property]) }}">{{ $property->title }}</a>
        </h5>
        <p class="card-text">{{ $property->surface }} m² - {{ $property->city }} ({{ $property->postal_code }})</p>
        <div class="text-primary fw-bold" style="font-size: 1.4rem;">
            {{ number_format($property->price, 0, '.', ' ') }} Fcfa
        </div>
    </div>
</div>
