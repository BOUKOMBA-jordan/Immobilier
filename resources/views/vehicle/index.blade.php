@extends('base')

@section('title', 'Tous nos véhicules')

@section('content')

<div class="bg-light p-5 mb-5 text-center">
    <form action="" method="get" class="container">
        <div class="row g-2">
            <div class="col-12 col-md-3">
                <input type="text" name="make" placeholder="Marque" class="form-control" value="{{ $input['make'] ?? '' }}">
            </div>
            <div class="col-12 col-md-3">
                <input type="text" name="model" placeholder="Modèle" class="form-control" value="{{ $input['model'] ?? '' }}">
            </div>
            <div class="col-12 col-md-3">
                <input type="number" name="year" placeholder="Année min" class="form-control" value="{{ $input['year'] ?? '' }}">
            </div>
            <div class="col-12 col-md-3">
                <input type="number" name="price" placeholder="Prix max" class="form-control" value="{{ $input['price'] ?? '' }}">
            </div>
            <div class="col-12 mt-3">
                <button class="btn btn-primary w-100">Rechercher</button>
            </div>
        </div>
    </form>
</div>
<div class="container">
    <div class="row">
        @forelse ($vehicles as $vehicle)
            <div class="col-12 col-md-4">
                @include('vehicle.card', ['vehicle' => $vehicle])
            </div>
        @empty
            <div class="col">
                Aucun véhicule ne correspond à votre recherche.
            </div>
        @endforelse
    </div>
</div>

<div class="container my-4">
    {{ $vehicles->links() }}
</div>

@endsection
