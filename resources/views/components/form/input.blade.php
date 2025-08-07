@props([
    'type' => 'text',
    'value' => '',
    'name',
    'element' => '',
])
<div class="form-group">
    <label for="{{ $name }}">{{ $element . ' ' . ucfirst($name) }}</label>
    <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name, $value) }}"
        @class(['form-control', 'is-invalid' => $errors->has($name)]) {{ $attributes }}>
</div>
