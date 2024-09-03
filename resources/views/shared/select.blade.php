@php
$class ??= null;
$name ??= '';
$value ??= [];
$label ??= ucfirst($name);
@endphp

<div class="form-group {{ $class }}">
    <label for="{{ $name }}">{{ $label }}</label>

    <select name="{{ $name }}[]" id="{{ $name }}" multiple class="form-control @error($name) is-invalid @enderror">
        @foreach ($options as $k => $v)
            <option @selected(in_array($k, $value)) value="{{ $k }}">{{ $v }}</option>
        @endforeach
    </select>

    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
