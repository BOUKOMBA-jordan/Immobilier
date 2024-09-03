@extends('admin.admin')

@section('title', $vehicle->exists ? "Éditer un véhicule" : "Créer un véhicule")

@section('content')
<h1>@yield('title')</h1>

<form class="vstack gap-2" action="{{ route($vehicle->exists ? 'admin.vehicle.update' : 'admin.vehicle.store', $vehicle) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method($vehicle->exists ? 'put' : 'post')

    <div class="row">
        @include('shared.input', ['class' => 'col', 'label' => 'Marque', 'name' => 'brand', 'value' => $vehicle->brand])
        @include('shared.input', ['class' => 'col', 'label' => 'Modèle', 'name' => 'model', 'value' => $vehicle->model])
    </div>

    <div class="row">
        @include('shared.input', ['class' => 'col', 'label' => 'Année', 'name' => 'year', 'value' => $vehicle->year])
        @include('shared.input', ['class' => 'col', 'label' => 'Prix', 'name' => 'price', 'value' => $vehicle->price])
    </div>

    <div class="row">
        @include('shared.input', ['class' => 'col', 'label' => 'Kilométrage', 'name' => 'mileage', 'value' => $vehicle->mileage])
        @include('shared.input', ['class' => 'col', 'label' => 'Couleur', 'name' => 'color', 'value' => $vehicle->color])
    </div>

    @include('shared.input', ['type' =>'textarea', 'name' => 'description', 'value' => $vehicle->description])

    <div class="row">
        @include('shared.input', ['class' => 'col', 'name' => 'vin', 'label' => 'Numéro de série', 'value' => $vehicle->vin])
    </div>

    <!-- Options -->
    <div class="form-group">
        <label for="options">Options</label>
        <select id="options" name="options[]" class="form-select" multiple>
            @foreach ($options as $id => $name)
                <option value="{{ $id }}" {{ in_array($id, $selectedOptions ?? []) ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control" id="image" name="image">
        @if ($vehicle->exists && $vehicle->image)
            <img src="{{ asset($vehicle->image) }}" alt="Image du véhicule" class="img-fluid mt-2" style="max-width: 200px;">
        @endif
    </div>

    <div>
        <button class="btn btn-primary">
            @if($vehicle->exists)
                Modifier
            @else
                Créer
            @endif
        </button>
    </div>
</form>
@endsection
