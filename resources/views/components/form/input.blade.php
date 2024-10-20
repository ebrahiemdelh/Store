@props([
    'type' => 'text',
    'value' => '',
    'name',
])

<input
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ old($name, $value) }}" @class(['form-control', 'is-invalid' => $errors->has($name)])
    {{$attributes}}>
