@props(['disabled' => false])

@php $name = $attributes->get('name'); @endphp

<textarea {!! $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) !!}
    {{ $disabled ? 'disabled' : '' }}>
    {{ $slot }}
</textarea>

@error($name)
    <span class="invalid-feedback">
        {{ $message }}
    </span>
@enderror
