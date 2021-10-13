@props(['disabled' => false])

@php $name = $attributes->get('name'); @endphp

<input
    type="file"
    {!! $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) !!}
    {{ $disabled ? 'disabled' : '' }}
>
@php $key = trim($name, '[]'); @endphp

@error($key)
    <span class="invalid-feedback d-block">
        {{ $message }}
    </span>
@enderror

@error($name)
    <span class="invalid-feedback d-block">
        {{ $message }}
    </span>
@enderror
