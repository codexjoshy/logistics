@props(['disabled' => false])

@php $name = $attributes->get('name'); @endphp

<div class="form-check">
    <input type="checkbox" {!! $attributes->class(['form-check-input', 'is-invalid' => $errors->has($name)]) !!}
    {{ $disabled ? 'disabled' : '' }} >
    {{ $slot }}
</div>

@error($name)
    <span class="invalid-feedback">
        {{ $message }}
    </span>
@enderror
