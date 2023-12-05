@props(['name', 'label', 'value' => '', 'error' => null, 'type'])
@php([$arr, $key] = explode('.', $name))
<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror"
        name="{{ $arr }}[{{ $key }}]" value="{{ old($name, $value) }}" id="{{ $name }}"
        value="{{ $value }}">

    {{-- @dd($name) --}}
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

</div>
