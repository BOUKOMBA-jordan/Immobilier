@extends('base')

@section('title', 'Tous nos biens')

@section('content')

<div class="bg-light p-5 mb-5 text-center">
    <form action="" method="get" class="container">
        <div class="row g-2">
            <div class="col-12 col-md-3">
                <input type="number" name="surface" placeholder="Surface minimal" class="form-control" value="{{ $input['surface'] ?? '' }}">
            </div>
            <div class="col-12 col-md-3">
                <input type="number" name="rooms" placeholder="Nombre de pièce min" class="form-control" value="{{ $input['rooms'] ?? '' }}">
            </div>
            <div class="col-12 col-md-3">
                <input type="number" name="price" placeholder="Budget max" class="form-control" value="{{ $input['price'] ?? '' }}">
            </div>
            <div class="col-12 col-md-3">
                <input name="title" placeholder="Mot clef" class="form-control" value="{{ $input['title'] ?? '' }}">
            </div>
            <div class="col-12 mt-3">
                <button class="btn btn-primary w-100">Rechercher</button>
            </div>
        </div>
    </form>
</div>
<div class="container">
    <div class="row">
        @forelse ($properties as $property )
            <div class="col">
                @include('property.card')
            </div>
        @empty
            <div class="col">
                Aucun bien ne correspond a votre recherche
            </div>
        @endforelse


    </div>
</div>

<div class="container my-4">
    {{ $properties->links() }}
</div>

@endsection
