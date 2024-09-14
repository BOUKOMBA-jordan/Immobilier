@extends('admin.admin')

@section('title', 'Upload Images')

@section('content')
<div class="container mt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Upload Images
                    <a href="{{ route('admin.property.index') }}" class="btn btn-primary float-end">Retour</a>
                </h4>
            </div>
            <div class="card-body">

                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <h5>Nom du Bien: {{ $property->title }}</h5>
                <hr>

                @if($errors->any())
                    <ul class="alert alert-warning">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form action="{{ route('admin.property.upload.store', $property->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Images Upload -->
                    <div class="mb-3">
                        <label for="pictures" class="form-label">Upload Images (Max: 20 images only)</label>
                        <input type="file" name="pictures[]" class="form-control" multiple>
                    </div>

                    <button type="submit" class="btn btn-success">Télécharger</button>
                </form>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            @foreach ($pictures as $propImg)
                <div class="d-inline-block position-relative mr-2">
                    <img src="{{ asset($propImg->image) }}" class="border p-2 m-3" style="width: 100px; height: 100px;" alt="Image">

                    <form action="{{ route('admin.property.image.destroy', $propImg->id) }}" method="POST" class="position-absolute top-0 right-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">X</button>
                    </form>
                </div>
            @endforeach

            <!-- property.index.blade.php -->



        </div>
    </div>
</div>
@endsection
