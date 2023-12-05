@props(['name', 'value' => '', 'error' => null, 'type'])

<div class="mb-3">
    <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" value="{{ old($name, $value) }}" id="{{ $name }}" value="{{ $value }}">
    @error($name)
    <div class="invalid-feedback">{{ $error->get($name) }}</div>
    @enderror

</div>
