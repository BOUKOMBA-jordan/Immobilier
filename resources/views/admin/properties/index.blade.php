@extends('admin.admin')

@section('title', 'Tous les biens')

@section('content')

<div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-3">
    <h1 class="mb-2 mb-md-0">@yield('title')</h1>
    <a href="{{ route('admin.property.create') }}" class="btn btn-primary">Ajouter un bien</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Surface</th>
                <th>Prix</th>
                <th>Ville</th>
                <th>Image</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($properties as $property)
            <tr>
                <td>{{ $property->title }}</td>
                <td>{{ $property->surface }} m²</td>
                <td>{{ number_format($property->price, 2, '.', ' ') }}</td>
                <td>{{ $property->city }}</td>
                <td>
                    <a href="{{ url('admin/property/'.$property->id.'/upload') }}" class="btn btn-info btn-sm">Ajouter / Voir Images</a>
                </td>
                <td>
                    <div class="d-flex gap-2 w-100 justify-content-end">
                        <a href="{{ route('admin.property.edit', $property) }}" class="btn btn-primary btn-sm">Éditer</a>
                        <form action="{{ route('admin.property.destroy', $property) }}" method="post">
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

{{ $properties->links()}}

@endsection
