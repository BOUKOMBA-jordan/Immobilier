@extends('admin.admin')

@section('title', $property->exists ? "Éditer un bien" : "Créer un bien")

@section('content')
<h1>@yield('title')</h1>

<form class="vstack gap-2" action="{{ route($property->exists ? 'admin.property.update' : 'admin.property.store', $property) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method($property->exists ? 'put' : 'post')

    <div class="row">
        @include('shared.input', ['class' => 'col', 'label' => 'Titre', 'name' => 'title', 'value' => $property->title])

        <div class="col row">
            @include('shared.input', ['class' => 'col', 'name' => 'surface', 'value' => $property->surface])
            @include('shared.input', ['class' => 'col', 'name' => 'price', 'label' => 'Prix', 'value' => $property->price])
        </div>
    </div>

    @include('shared.input', ['type' =>'textarea', 'name' => 'description', 'value' => $property->description])

    <div class="row">
        @include('shared.input', ['class' => 'col', 'name' => 'rooms', 'label' => 'Pièces', 'value' => $property->rooms])
        @include('shared.input', ['class' => 'col', 'name' => 'bedrooms', 'label' => 'Chambres', 'value' => $property->bedrooms])
        @include('shared.input', ['class' => 'col', 'name' => 'floor', 'label' => 'Étage', 'value' => $property->floor])
    </div>

    <div class="row">
        @include('shared.input', ['class' => 'col', 'name' => 'address', 'label' => 'Adresse', 'value' => $property->address])
        @include('shared.input', ['class' => 'col', 'name' => 'city', 'label' => 'Ville', 'value' => $property->city])
        @include('shared.input', ['class' => 'col', 'name' => 'postal_code', 'label' => 'Code postal', 'value' => $property->postal_code])
    </div>

    @include('shared.select', ['name' => 'options', 'label' => 'Options', 'value' => $property->options()->pluck('id'), 'multiple' => true])
    @include('shared.checkbox', ['name' => 'sold', 'label' => 'Vendu', 'value' => $property->sold, 'options' => $options])

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control" id="image" name="image">
        @if ($property->exists && $property->image)
            <img src="{{ asset($property->image) }}" alt="Image de la propriété" class="img-fluid mt-2" style="max-width: 200px;">
        @endif
    </div>

    <div>
        <button class="btn btn-primary">
            @if($property->exists)
                Modifier
            @else
                Créer
            @endif
        </button>
    </div>
</form>
@endsection
