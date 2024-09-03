@extends('admin.admin')

@section('title', 'Tous les véhicules')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3">
    <h1 class="mb-2 mb-md-0">@yield('title')</h1>
    <a href="{{ route('admin.vehicle.create') }}" class="btn btn-primary">Ajouter un véhicule</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Année</th>
                <th>Prix</th>
                <th>Kilométrage</th>
                <th>Image</th>
                <th>Options</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle)
            <tr>
                <td>{{ $vehicle->make }}</td>
                <td>{{ $vehicle->model }}</td>
                <td>{{ $vehicle->year }}</td>
                <td>{{ number_format($vehicle->price, 2, '.', ' ') }} €</td>
                <td>{{ number_format($vehicle->mileage, 0, '.', ' ') }} km</td>
                <td>
                    @if($vehicle->image)
                        <img src="{{ asset($vehicle->image) }}" alt="Image du véhicule" class="img-thumbnail" style="width: 100px; height: auto;">
                    @else
                        Pas d'image
                    @endif
                </td>
                <td>
                    @if($vehicle->options->isNotEmpty())
                        {{ implode(', ', $vehicle->options->pluck('name')->toArray()) }}
                    @else
                        Aucune option
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-2 w-100 justify-content-end">
                        <a href="{{ route('admin.vehicle.edit', $vehicle) }}" class="btn btn-primary btn-sm">Éditer</a>
                        <a href="{{ route('admin.vehicle.upload', $vehicle->id) }}" class="btn btn-info btn-sm">Ajouter / Voir Images</a>
                        <form action="{{ route('admin.vehicle.destroy', $vehicle) }}" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?');">
                            @csrf
                            @method("delete")
                            <button class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ $vehicles->links()}}

@endsection
