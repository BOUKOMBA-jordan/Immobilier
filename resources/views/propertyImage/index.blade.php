@extends('admin.admin')

@section('title', 'Télécharger des Images')

@section('content')
<div class="container mt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Télécharger des Images
                    <a href="{{ route('admin.vehicle.index') }}" class="btn btn-primary float-end">Retour</a>
                </h4>
            </div>
            <div class="card-body">

                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <h5>Nom du Véhicule: {{ $vehicle->title }}</h5>
                <hr>

                @if($errors->any())
                    <ul class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form action="{{ route('admin.vehicle.upload.store', $vehicle->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Images Upload -->
                    <div class="mb-3">
                        <label for="pictures" class="form-label">Télécharger des Images (Max: 20 images seulement)</label>
                        <input type="file" name="pictures[]" class="form-control" multiple>
                    </div>

                    <button type="submit" class="btn btn-success">Télécharger</button>
                </form>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            @foreach ($pictures as $vehImg)
                <div class="d-inline-block position-relative mr-2">
                    <img src="{{ asset($vehImg->image) }}" class="border p-2 m-3" style="width: 100px; height: 100px;" alt="Image">

                    <form action="{{ route('admin.vehicle.image.destroy', $vehImg->id) }}" method="POST" class="position-absolute top-0 right-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">X</button>
                    </form>
                </div>
            @endforeach

            <!-- vehicle.index.blade.php -->

        </div>
    </div>
</div>
@endsection
