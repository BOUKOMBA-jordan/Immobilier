@extends('base')
<!-- Favicon ico -->
<link rel="icon" type="image/favicon.ico" href="favicon.ico">
@section('title', $property->title)

@section('content')

<style>
    /* Styles pour le carousel */
    .carousel-item img {
        width: 100%; /* Assurer que les images prennent toute la largeur du carousel */
        height: 600px; /* Hauteur fixe pour toutes les images */
        object-fit: cover; /* Couvrir le conteneur sans déformer l'image */
    }

    /* Style pour enlever le soulignement des liens */
    .contact-info a {
        text-decoration: none; /* Enlever le soulignement */
    }

    .contact-info .phone-link {
        color: #007bff; /* Couleur pour le téléphone */
    }

    .contact-info .whatsapp-link {
        color: #25D366; /* Couleur pour WhatsApp */
    }

    .contact-info a:hover {
        text-decoration: underline; /* Ajouter un soulignement au survol si désiré */
    }
</style>

<div class="container mt-4">
    <h1 class="display-4">{{ $property->title }}</h1>
    <h2 class="text-muted">{{ $property->rooms }} pièces - {{ $property->surface }} m²</h2>

    <div class="text-primary fw-bold" style="font-size: 2.5rem;">
        {{ number_format($property->price, 0, '', ' ') }} Fcfa
    </div>

    <hr>

    <div class="mt-4">
        <!-- Carrousel -->
        <div id="propertyCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                @foreach ($property->pictures as $picture)
                    <div class="carousel-item @if ($loop->first) active @endif">
                        <img src="{{ asset($picture->image) }}" class="d-block" alt="Image {{ $loop->index + 1 }}">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </button>
        </div>
    </div>

    <div class="mt-4">
        <p>{!! nl2br(e($property->description)) !!}</p>
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <h2>Caractéristiques</h2>
                <table class="table table-striped">
                    <tr>
                        <td>Surface habitable</td>
                        <td>{{ $property->surface }} m²</td>
                    </tr>
                    <tr>
                        <td>Pièces</td>
                        <td>{{ $property->rooms }}</td>
                    </tr>
                    <tr>
                        <td>Chambres</td>
                        <td>{{ $property->bedrooms }}</td>
                    </tr>
                    <tr>
                        <td>Étage</td>
                        <td>{{ $property->floor ?: 'Rez-de-chaussée' }}</td>
                    </tr>
                    <tr>
                        <td>Localisation</td>
                        <td>
                            {{ $property->address }}<br>
                            {{ $property->city }} ({{ $property->postal_code }})
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-4 col-md-12">
                <h2>Spécificités</h2>
                <ul class="list-group">
                    @foreach ($property->options as $option)
                        <li class="list-group-item">{{ $option->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <hr>

    <!-- Informations de Contact -->
    <div class="container mt-5 mb-5 text-center contact-info">
        <h2>Contact</h2>
        <p>Pour plus d'informations, vous pouvez nous contacter directement :</p>
        <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center">
            <ul class="list-unstyled d-flex mb-3 mb-sm-0">
                <li class="d-flex align-items-center me-3 me-sm-4 mb-2 mb-sm-0">
                    <i class="fas fa-phone-alt me-2 phone-link" style="font-size: 1.2rem;"></i>
                    <a class="phone-link" href="tel:+241076218187">+241 076 218 187</a>
                </li>
                <li class="d-flex align-items-center mb-2 mb-sm-0">
                    <i class="fab fa-whatsapp me-2 whatsapp-link" style="font-size: 1.2rem;"></i>
                    <a class="whatsapp-link" href="https://wa.me/06218187" target="_blank">Contactez-nous sur WhatsApp</a>
                </li>
            </ul>
            <button type="button" class="btn btn-primary mt-3 mt-sm-0 ms-sm-3" data-bs-toggle="modal" data-bs-target="#contactModal">
                Intéressé par ce bien ? laissez nous mail
            </button>
        </div>
    </div>
    

    <!-- Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Contactez-nous pour ce bien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('property.contact', $property) }}" method="post" class="vstack gap-3">
                        @csrf
    
                        <div class="row">
                            @include('shared.input', ['class' => 'col-md-6', 'name' => 'firstname', 'label' => 'Prénom'])
                            @include('shared.input', ['class' => 'col-md-6', 'name' => 'lastname', 'label' => 'Nom'])
                        </div>
    
                        <div class="row">
                            @include('shared.input', ['class' => 'col-md-6', 'name' => 'phone', 'label' => 'Téléphone'])
                            @include('shared.input', ['type' => 'email', 'class' => 'col-md-6', 'name' => 'email', 'label' => 'Email'])
                        </div>
    
                        @include('shared.input', ['type' => 'textarea', 'class' => 'col-12', 'name' => 'message', 'label' => 'Votre message'])
    
                        <div>
                            <button class="btn btn-primary">Nous contacter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
